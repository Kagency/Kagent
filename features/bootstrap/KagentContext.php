<?php

namespace Kagency\Kagent;

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;

/**
 * Kagent specific context
 */
class KagentContext extends BehatContext
{
    /**
     * @When /^I create a task "([^"]*)" with "([^"]*)"$/
     */
    public function iCreateATaskWith($name, $arguments)
    {
        throw new PendingException();
    }

    /**
     * @Given /^The processing is completed$/
     */
    public function theProcessingIsCompleted()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I receive "([^"]*)" events$/
     */
    public function iReceiveEvents($name)
    {
        throw new PendingException();
    }
}
