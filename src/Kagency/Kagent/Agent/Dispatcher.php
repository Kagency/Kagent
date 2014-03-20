<?php

namespace Kagency\Kagent\Agent;

use Kagency\Kagent\Agent;
use Kagency\Kagent\User;
use Kagency\Kagent\Versioned\Task;

/**
 * Class: Dispatcher
 *
 * Collects a number of agents and dispatches the task to the first agent it
 * encounters, which can handle the given task.
 *
 * @version $Revision$
 */
class Dispatcher extends Agent
{
    /**
     * Agents
     *
     * @var Agent[]
     */
    private $agents = array();

    /**
     * __construct
     *
     * @param Agent[] $agents
     * @return void
     */
    public function __construct(array $agents = array())
    {
        foreach ($agents as $agent) {
            $this->addAgent($agent);
        }
    }

    /**
     * Add agent
     *
     * @param Agent $agent
     * @return void
     */
    public function addAgent(Agent $agent)
    {
        $this->agents[] = $agent;
    }

    /**
     * CHeck if current agent can handle the given task
     *
     * @param Task $task
     * @return void
     */
    public function canHandle(Task $task)
    {
        foreach ($this->agents as $agent) {
            if ($agent->canHandle($task)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle task
     *
     * @param User $user
     * @param Task $task
     * @return void
     */
    public function handle(User $user, Task $task)
    {
        foreach ($this->agents as $agent) {
            if ($agent->canHandle($task)) {
                return $agent->handle($user, $task);
            }
        }

        throw new \OutOfBoundsException("No agent found, which can handle the given task.");
    }
}
