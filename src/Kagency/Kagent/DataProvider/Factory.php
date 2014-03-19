<?php

namespace Kagency\Kagent\DataProvider;

use Kagency\Kagent\DataProvider;
use Kagency\Kagent\User;

/**
 * Class: DataProviderFactory
 *
 * Builds data providers for a given user.
 *
 * @version $Revision$
 */
class Factory
{
    /**
     * Data providers
     *
     * @var DataProvider[]
     */
    private $dataProviders;

    /**
     * __construct
     *
     * @param DataProvider[] $dataProviders
     * @return void
     */
    public function __construct(array $dataProviders = array())
    {
        foreach ($dataProviders as $name => $dataProvider) {
            $this->registerDataProvider($name, $dataProvider);
        }
    }

    /**
     * Register data provider
     *
     * @param string $name
     * @param DataProvider $dataProvider
     * @return void
     */
    public function registerDataProvider($name, DataProvider $dataProvider)
    {
        $this->dataProviders[$name] = $dataProvider;
    }

    /**
     * Get data providers
     *
     * @param User $user
     * @return DataProvider\UserWrapper[]
     */
    public function getDataProviders(User $user)
    {
        $dataProviders = array();
        foreach ($user->dataProviders as $name => $configuration) {
            if (!isset($this->dataProviders[$name])) {
                throw new \OutOfBoundsException("Unknown data provider type: $name");
            }

            $dataProviders[] = new DataProvider\UserWrapper(
                $this->dataProviders[$name],
                $configuration
            );
        }

        return $dataProviders;
    }
}
