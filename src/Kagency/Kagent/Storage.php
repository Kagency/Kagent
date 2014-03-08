<?php

namespace Kagency\Kagent;

/**
 * Class: Storage
 *
 * Simple facade for storing events and data. Class can be used to request
 * current data and current events since a given revision.
 *
 * @version $Revision$
 */
abstract class Storage implements
    Storage\EventStorage,
    Storage\TaskStorage,
    Storage\DataStorage
{
}
