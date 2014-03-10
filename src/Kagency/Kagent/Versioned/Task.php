<?php

namespace Kagency\Kagent\Versioned;

use Kagency\Kagent\Versioned;

/**
 * Class: Task
 *
 * Struct representing a task
 *
 * @version $Revision$
 */
class Task extends Versioned
{
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
