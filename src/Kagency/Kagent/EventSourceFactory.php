<?php

namespace Kagency\Kagent;

/**
 * Class: EventSourceFactory
 *
 * Builds event sources for a given user.
 *
 * @version $Revision$
 */
class EventSourceFactory
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
        foreach ($user->eventSources as $name => $configuration) {
            if (!isset($this->eventSources[$name])) {
                throw new \OutOfBoundsException("Unknown event source type: $name");
            }

            $eventSources[] = new EventSource\UserWrapper(
                $this->eventSources[$name],
                $configuration
            );
        }

        return $eventSources;
    }
}
