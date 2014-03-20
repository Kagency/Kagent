<?php

namespace Kagency\Kagent\User;

use Kagency\Kagent\User;
use Kagency\Kagent\EventSource\Configuration;

/**
 * Class: EventSourceContext
 *
 * Context class for event source related operations on the use object
 *
 * @version $Revision$
 */
class EventSourceContext
{
    /**
     * Add event source
     *
     * Returns the ID of the newly added event source
     *
     * @param User $user
     * @param Configuration $configuration
     * @return string
     */
    public function addEventSource(User $user, Configuration $configuration)
    {
        do {
            $id = substr(md5(microtime()), 0, 12);
        } while (isset($user->eventSources[$id]));

        $user->eventSources[$id] = $configuration;
        return $id;
    }

    /**
     * Get last event source revision
     *
     * Returns null if no revision is yet set
     *
     * @param User $user
     * @param string $id
     * @return string
     */
    public function getLastEventSourceRevision(User $user, $id)
    {
        if (!isset($user->lastEventSourceRevision[$id])) {
            return null;
        }

        return $user->lastEventSourceRevision[$id];
    }

    /**
     * Set last event source revision
     *
     * @param User $user
     * @param string $id
     * @param string $revision
     * @return void
     */
    public function setLastEventSourceRevision(User $user, $id, $revision)
    {
         $user->lastEventSourceRevision[$id] = $revision;
    }
}
