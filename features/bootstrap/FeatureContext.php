<?php

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     *
     * Initializes context from parameters in behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->useContext(
            'kagent',
            new Kagency\Kagent\KagentContext($parameters)
        );
    }
}
