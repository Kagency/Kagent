<?php

namespace Kagency\Kagent;

/**
 * Class: DataProvider
 *
 * Data provider provide a certain data sets. Examples could be contacts the
 * user has on twitter, facebook or somewhere else. Data providers are supposed
 * to provide sets of data which are updated from time to time.
 *
 * Usually nothing noteworthy happens when a data set is updated, but it will
 * be used by filters or for context annotations.
 *
 * @version $Revision$
 */
abstract class DataProvider
{
    /**
     * Get current data from data provider
     *
     * @return Data
     */
    abstract public function getCurrentData();
}
