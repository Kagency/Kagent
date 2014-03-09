<?php

namespace Kagency\Kagent\Storage;

use Kagency\Kagent\User;
use Kagency\Kagent\Task;

/**
 * Class: TaskStorage
 *
 * Storage for tasks.
 *
 * @version $Revision$
 */
interface TaskStorage
{
    /**
     * Append task
     *
     * Append a task for the given user to the storage.
     *
     * @param User $user
     * @param Task $task
     * @return void
     */
    public function appendTask(User $user, Task $task);

    /**
     * Get tasks since
     *
     * Get all tasks since the provided revision for the specified user.
     *
     * @param User $user
     * @param string $since
     * @return Task[]
     */
    public function getTasksSince(User $user, $since);
}
