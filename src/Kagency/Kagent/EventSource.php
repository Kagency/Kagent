<?php

namespace Kagency\Kagent;

/**
 * Class: EventSource
 *
 * Event sources provide a stream of events. Events can be new tweets or new
 * entries in a RSS feed or basically anything you can think of. There is now
 * way to update an event though, so they are create-only.
 *
 * @version $Revision$
 */
abstract class EventSource
{
    /**
     * Get new events
     *
     * Get all new events since the provided revision
     *
     * @param EventSource\Configuration $configuration
     * @param string $since
     * @return Event[]
     */
    abstract public function getNewEvents(EventSource\Configuration $configuration, $since);
}
