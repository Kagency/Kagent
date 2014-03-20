<?php

namespace Kagency\Kagent;

use Kagency\Kagent\Storage\UserStorage;
use Kagency\Kagent\Versioned\Task;

/**
 * Class: Kagent
 *
 * Kagent main class. Acts as a service which provides the main calls for the
 * public interface. Can be called by REST controllers, on the shell, or by
 * integration tests.
 *
 * @version $Revision$
 */
class Kagent
{
    /**
     * Storage
     *
     * @var Storage
     */
    private $storage;

    /**
     * User storage
     *
     * @var UserStorage
     */
    private $userStorage;

    /**
     * Revision provider
     *
     * @var RevisionProvider
     */
    private $revisionProvider;

    /**
     * Event source factory
     *
     * @var EventSourceFactory
     */
    private $eventSourceFactory;

    /**
     * Data provider factory
     *
     * @var DataProviderFactory
     */
    private $dataProviderFactory;

    /**
     * Agent dispatcher
     *
     * @var Agent\Dispatcher
     */
    private $agentDispatcher;

    /**
     * __construct
     *
     * @param mixed Storage $storage
     * @return void
     */
    public function __construct(
        Storage $storage,
        UserStorage $userStorage,
        RevisionProvider $revisionProvider,
        EventSource\Factory $eventSourceFactory,
        DataProvider\Factory $dataProviderFactory,
        Agent\Dispatcher $agentDispatcher
    ) {
        $this->storage = $storage;
        $this->userStorage = $userStorage;
        $this->revisionProvider = $revisionProvider;
        $this->eventSourceFactory = $eventSourceFactory;
        $this->dataProviderFactory = $dataProviderFactory;
        $this->agentDispatcher = $agentDispatcher;
    }

    /**
     * Append task
     *
     * @param User $user
     * @param Task $task
     * @return void
     */
    public function appendTask(User $user, Task $task)
    {
        $task->revision = $this->revisionProvider->next();
        $this->storage->appendTask($user, $task);
    }

    /**
     * Process
     *
     * Main method of the project. Executes all actions, which are meant to be
     * performed from time to time. In theory those tasks could be split up
     * into several processes, since they do not depend on each other.
     *
     * @TODO: This method requires some error / exception handling.
     *
     * @TODO: This method should probably be split up into several methods.
     *
     * @return void
     */
    public function process()
    {
        // @TODO: Inject dependency
        $eventSourceContext = new User\EventSourceContext();

        foreach ($this->userStorage->getUsers() as $user) {
            foreach ($this->storage->getTasksSince($user, $user->lastTaskRevision) as $task) {
                $this->agentDispatcher->handle($user, $task);

                $user->lastTaskRevision = $task->revision;
                $this->userStorage->save($user);
            }

            foreach ($this->eventSourceFactory->getEventSources($user) as $id => $eventSource) {
                $lastRevision = $eventSourceContext->getLastEventSourceRevision($user, $id);
                foreach ($eventSource->getNewEvents($lastRevision) as $event) {
                    $event->revision = $this->revisionProvider->next();

                    $user->lastEventSourceRevision[$id] = $event->sourceRevision;
                    $this->userStorage->save($user);

                    $this->storage->appendEvent($user, $event);
                }
            }

            foreach ($this->dataProviderFactory->getDataProviders($user) as $name => $dataProvider) {
                $data = $dataProvider->getCurrentData($user->lastDataProviderRevision[$name]);
                $data->revision = $this->revisionProvider->next();

                $user->lastDataProviderRevision[$name] = $data->sourceRevision;
                $this->userStorage->save($user);

                $this->storage->storeDataSet($user, $name, $data);
            }
        }
    }

    /**
     * Get events
     *
     * @param User $user
     * @param string $since
     * @return Event[]
     */
    public function getEvents(User $user, $since)
    {
        return $this->storage->getEventsSince($user, $since);
    }
}
