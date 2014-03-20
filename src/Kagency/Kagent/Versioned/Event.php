<?php

namespace Kagency\Kagent\Versioned;

use Kagency\Kagent\Versioned;

/**
 * Class: Event
 *
 * Struct representing an event
 *
 * @version $Revision$
 */
class Event extends Versioned
{
    /**
     * Type
     *
     * @var string
     */
    public $type;

    /**
     * Priority
     *
     * @var float
     */
    public $priority = 1.0;

    /**
     * Event data
     *
     * @var Struct
     */
    public $data;
}
