<?php

namespace Kagency\Kagent\Storage;

/**
 * Class: EventStorage
 *
 * Storage for events.
 *
 * @version $Revision$
 */
interface EventStorage
{
    /**
     * Append event
     *
     * Append an event for the given user to the storage.
     *
     * @param User $user
     * @param Event $event
     * @return void
     */
    public function appendEvent(User $user, Event $event);

    /**
     * Get events since
     *
     * Get all events since the provided revision for the specified user.
     *
     * @param User $user
     * @param string $since
     * @return Event[]
     */
    public function getEventsSince(User $user, $since);
}
