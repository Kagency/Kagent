<?php

namespace Kagency\Kagent;

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;

use PHPUnit_Framework_Assert as Assert;

/**
 * Kagent specific context
 */
class KagentContext extends BehatContext
{
    /**
     * App
     *
     * @var App
     */
    private $app;

    /**
     * Kagent
     *
     * @var Kagent
     */
    private $kagent;

    /**
     * Current user
     *
     * @var User
     */
    private $user;

    /**
     * __construct
     *
     * @param array $parameters
     * @return void
     */
    public function __construct(array $parameters)
    {
        $this->app = new App(
            __DIR__ . '/../../src/config/',
            __DIR__ . '/../../var/',
            array(
                new \Kagency\Module\RSS\Module(),
            ),
            true
        );
        $this->kagent = $this->app->getContainer()->get('kagency.kagent');
    }

    /**
     * @Given /^A User "([^"]*)" exists and is logged in$/
     */
    public function aUserExistsAndIsLoggedIn($name)
    {
        $this->user = new User(array("name" => $name));

        $userStorage = $this->app->getContainer()->get('kagency.kagent.storage.user');
        $userStorage->save($this->user);
    }

    /**
     * @When /^I create a task "([^"]*)" with "([^"]*)"$/
     */
    public function iCreateATaskWith($name, $parameter)
    {
        $this->kagent->appendTask(
            $this->user,
            new $name($parameter)
        );
    }

    /**
     * @Given /^The processing is completed$/
     */
    public function theProcessingIsCompleted()
    {
        $this->kagent->process();
    }

    /**
     * @Then /^I receive "([^"]*)" events$/
     */
    public function iReceiveEvents($name)
    {
        $events = $this->kagent->getEvents($this->user, null);

        Assert::assertTrue(count($events) > 1, "At minimum one event has been recieved.");
        Assert::assertSame($name, $events[0]->type);
    }
}
