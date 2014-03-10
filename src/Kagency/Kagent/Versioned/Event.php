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
     * Event data
     *
     * @var array
     */
    public $data;
}
