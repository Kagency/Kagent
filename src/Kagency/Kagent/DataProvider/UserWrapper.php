<?php

namespace Kagency\Kagent\DataProvider;

use Kagency\Kagent\DataProvider;

/**
 * Class: UserWrapper
 *
 * Wraps around an existing event source to call it with the corresponding user
 * configuration.
 *
 * Basically works like a Y combinator, but without the strange syntax and as
 * an object to clarify for people without a functional programming background.
 *
 * @version $Revision$
 */
class UserWrapper
{
    /**
     * __construct
     *
     * @param DataProvider $dataProvider
     * @param Configuration $configuration
     * @return void
     */
    public function __construct(DataProvider $dataProvider, Configuration $configuration)
    {
        $this->dataProvider = $dataProvider;
        $this->configuration = $configuration;
    }

    /**
     * Get new events
     *
     * Get all new events since the provided revision
     *
     * @param string $since
     * @return Event[]
     */
    public function getNewEvents($since)
    {
        return $this->dataProvider->getNewEvents($this->configuration, $since);
    }
}
