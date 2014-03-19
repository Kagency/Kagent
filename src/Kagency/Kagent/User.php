<?php

namespace Kagency\Kagent;

/**
 * Class: User
 *
 * Struct representing a user
 *
 * @version $Revision$
 */
class User extends Struct
{
    /**
     * name
     *
     * @var string
     */
    public $name;

    /**
     * Last task revisions
     *
     * @var array
     */
    public $lastTaskRevision;

    /**
     * Event source configurations
     *
     * @var EventSource\Configuration[]
     */
    public $eventSources = array();

    /**
     * Last event source revision
     *
     * @var array
     */
    public $lastEventSourceRevision = array();

    /**
     * Data provider configurations
     *
     * @var DataProvider\Configuration[]
     */
    public $dataProviders = array();
}
