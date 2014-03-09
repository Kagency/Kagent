<?php

namespace Kagency\Kagent;

/**
 * Class: Task
 *
 * Struct representing an event
 *
 * @version $Revision$
 */
class Task extends Struct
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
     * Task data
     *
     * @var array
     */
    public $data;
}
