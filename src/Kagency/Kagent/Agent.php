<?php

namespace Kagency\Kagent;

/**
 * Class: Agent
 *
 * Agents are supposed to handle a given task. This could be something like
 * creating or removing a given EventSource or performing some random action
 * like sending mails, text messages, or alike.
 *
 * @version $Revision$
 */
abstract class Agent
{
    /**
     * CHeck if current agent can handle the given task
     *
     * @param Task $task
     * @return void
     */
    abstract public function canHandle(Task $task);

    /**
     * Handle task
     *
     * @param Task $task
     * @return void
     */
    abstract public function handle(Task $task);
}
