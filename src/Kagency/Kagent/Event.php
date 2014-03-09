<?php

namespace Kagency\Kagent;

/**
 * Class: Event
 *
 * Struct representing an event
 *
 * @version $Revision$
 */
class Event extends Struct
{
    /**
     * Revision
     *
     * @var string
     */
    public $revision;

    /**
     * Type
     *
     * @var string
     */
    public $type;

    /**
     * Event data
     *
     * @var array
     */
    public $data;
}
