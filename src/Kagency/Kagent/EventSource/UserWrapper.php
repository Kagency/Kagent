<?php

namespace Kagency\Kagent\EventSource;

use Kagency\Kagent\EventSource;

/**
 * Class: UserWrapper
 *
 * Wraps around an existing event source to call it with the corresponding user
 * configuration.
 *
 * Basically works like a Y combinator, but without the strange syntax and as
 * an object to clarify for people without a functional programming background.
 *
 * @version $Revision$
 */
class UserWrapper
{
    /**
     * __construct
     *
     * @param mixed EventSource
     * @return void
     */
    public function __construct(EventSource $eventSource, Configuration $configuration)
    {
        $this->eventSource = $eventSource;
        $this->configuration = $configuration;
    }

    /**
     * Get new events
     *
     * Get all new events since the provided revision
     *
     * @param string $since
     * @return Event[]
     */
    public function getNewEvents($since)
    {
        return $this->eventSource->getNewEvents($this->configuration, $since);
    }
}
