<?php

namespace Kagency\Kagent;

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
     * __constuct
     *
     * @param mixed Storage $storage
     * @return void
     */
    public function __constuct(Storage $storage)
    {
        $this->storage = $storage;
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
     * @return void
     */
    public function process()
    {
        foreach ($this->userStorage->getUsers() as $user) {
            foreach ($this->storage->getTasksSince($user, $user->lastTaskRevision) as $task) {
                $this->agentDispatcher->handle($user, $task);

                $user->lastTaskRevision = $task->revision;
                $this->userStorage->save($user);
            }

            foreach ($this->eventSourceFactory->getEventSources($user) as $id => $eventSource) {
                foreach ($eventSource->getNewEvents($user->lastEventSourceRevision[$id]) as $event) {
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
