<?php

namespace Kagency\Kagent;

/**
 * Class: Filter
 *
 * Filter an event based on the current context. This usually just changes the
 * priority of the event.
 *
 * @version $Revision$
 */
abstract class Filter
{
    /**
     * Filters an event
     *
     * @param Context $context
     * @param Event $event
     * @return void
     */
    abstract public function filter(Context $context, Event $event);
}
