<?php

namespace Kagency\Kagent\EventSource;

use Kagency\Kagent\EventSource;
use Kagency\Kagent\User;

/**
 * Class: EventSourceFactory
 *
 * Builds event sources for a given user.
 *
 * @version $Revision$
 */
class Factory
{
    /**
     * Event sources
     *
     * @var EventSource[]
     */
    private $eventSources;

    /**
     * __construct
     *
     * @param EventSource[] $eventSources
     * @return void
     */
    public function __construct(array $eventSources = array())
    {
        foreach ($eventSources as $name => $eventSource) {
            $this->registerEventSource($name, $eventSource);
        }
    }

    /**
     * Register event source
     *
     * @param string $name
     * @param EventSource $eventSource
     * @return void
     */
    public function registerEventSource($name, EventSource $eventSource)
    {
        $this->eventSources[$name] = $eventSource;
    }

    /**
     * Get event sources
     *
     * @param User $user
     * @return EventSourceUserWrapper[]
     */
    public function getEventSources(User $user)
    {
        $eventSources = array();
        foreach ($user->eventSources as $configuration) {
            if (!isset($this->eventSources[$configuration->name])) {
                throw new \OutOfBoundsException("Unknown event source type: {$configuration->name}");
            }

            $eventSources[] = new EventSource\UserWrapper(
                $this->eventSources[$configuration->name],
                $configuration
            );
        }

        return $eventSources;
    }
}
