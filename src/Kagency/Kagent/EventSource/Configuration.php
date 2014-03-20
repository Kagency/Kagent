<?php

namespace Kagency\Kagent\EventSource;

use Kagency\Kagent\Struct;

/**
 * Class: Configuration
 *
 * Base configuration class for event sources
 *
 * @version $Revision$
 */
class Configuration extends Struct
{
    /**
     * Name of corresponding event source. Must always be set.
     *
     * @var string
     */
    public $name = 'unknown';
}
