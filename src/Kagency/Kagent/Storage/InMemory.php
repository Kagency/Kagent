<?php

namespace Kagency\Kagent\Storage;

use Kagency\Kagent\Storage;
use Kagency\Kagent\User;
use Kagency\Kagent\Versioned\Event;
use Kagency\Kagent\Versioned\Task;
use Kagency\Kagent\Versioned\Data;

/**
 * Class: InMemory
 *
 * In-memory storage implementation. Mainly for integration tests. Does not
 * make sense to use in production.
 *
 * @private
 * @version $Revision$
 */
class InMemory extends Storage
{
    /**
     * Events
     *
     * @var Event[]
     */
    protected $events = array();

    /**
     * Tasks
     *
     * @var Task[]
     */
    protected $tasks = array();

    /**
     * Data sets
     *
     * @var Data[]
     */
    protected $dataSets = array();

    /**
     * Append event
     *
     * Append an event for the given user to the storage.
     *
     * @param User $user
     * @param Event $event
     * @return void
     */
    public function appendEvent(User $user, Event $event)
    {
        $this->events[] = $event;
    }

    /**
     * Get events since
     *
     * Get all events since the provided revision for the specified user.
     *
     * @param User $user
     * @param string $since
     * @return Event[]
     */
    public function getEventsSince(User $user, $since)
    {
        return array_values(
            array_filter(
                $this->events,
                function (Event $event) use ($since) {
                    return $event->revision > $since;
                }
            )
        );
    }

    /**
     * Append task
     *
     * Append a task for the given user to the storage.
     *
     * @param User $user
     * @param Task $task
     * @return void
     */
    public function appendTask(User $user, Task $task)
    {
        $this->tasks[] = $task;
    }

    /**
     * Get tasks since
     *
     * Get all tasks since the provided revision for the specified user.
     *
     * @param User $user
     * @param string $since
     * @return Task[]
     */
    public function getTasksSince(User $user, $since)
    {
        return array_values(
            array_filter(
                $this->tasks,
                function (Task $task) use ($since) {
                    return $task->revision > $since;
                }
            )
        );
    }

    /**
     * Update data set
     *
     * Update a data set for the given user in the storage.
     *
     * @param User $user
     * @param string $name
     * @param Data $data
     * @return void
     */
    public function storeDataSet(User $user, $name, Data $data)
    {
        $this->dataSets[$name] = $data;
    }

    /**
     * Get all data sets since
     *
     * Get all updated data sets since the provided revision for the specified
     * user.
     *
     * @param User $user
     * @param string $since
     * @return Data[]
     */
    public function getDataSince(User $user, $since)
    {
        return array_filter(
            $this->dataSets,
            function (Data $data) use ($since) {
                return $data->revision > $since;
            }
        );
    }
}
