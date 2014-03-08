<?php

namespace Kagency\Kagent\Storage;

/**
 * Class: Data storage
 *
 * Storage for data sets
 *
 * @version $Revision$
 */
interface DataStorage
{
    /**
     * Update data set
     *
     * Update a data set for the given user in the storage.
     *
     * @param User $user
     * @param string $name
     * @param Data $data
     * @return void
     */
    public function storeDataSet(User $user, $name, Data $data);

    /**
     * Get all data sets since
     *
     * Get all updated data sets since the provided revision for the specified
     * user.
     *
     * @param User $user
     * @param string $since
     * @return Data[]
     */
    public function getDataSince(User $user, $since);
}
