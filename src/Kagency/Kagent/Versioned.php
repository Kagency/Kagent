<?php

namespace Kagency\Kagent;

/**
 * Class: Versioned
 *
 * Base class representing versioned entities
 *
 * @version $Revision$
 */
abstract class Versioned extends Struct
{
    /**
     * Revision
     *
     * @var string
     */
    public $revision;

    /**
     * Revision in source system
     *
     * @var string
     */
    public $sourceRevision;
}
