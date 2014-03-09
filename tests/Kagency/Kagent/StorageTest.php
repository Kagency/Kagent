<?php

namespace Kagency\Kagent;

abstract class StorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Get storage
     *
     * Get test subject
     *
     * @return Storage
     */
    abstract protected function getStorage();

    /**
     * Get test user
     *
     * @return User
     */
    protected function getUser()
    {
        return new User(array('name' => 'TestUser'));
    }

    public function testGetNoEvents()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $this->assertEquals(
            array(),
            $storage->getEventsSince($user, null)
        );
    }

    public function testGetNoEventsWithRevision()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $this->assertEquals(
            array(),
            $storage->getEventsSince($user, 42)
        );
    }

    public function testGetEvent()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $event23 = new Event(array('revision' => 23));

        $storage->appendEvent($user, $event23);

        $this->assertEquals(
            array($event23),
            $storage->getEventsSince($user, null)
        );
    }

    public function testGetNoEventOutdated()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $event23 = new Event(array('revision' => 23));

        $storage->appendEvent($user, $event23);

        $this->assertEquals(
            array(),
            $storage->getEventsSince($user, 42)
        );
    }

    public function testGetEventSubset()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $event23 = new Event(array('revision' => 23));
        $event42 = new Event(array('revision' => 42));

        $storage->appendEvent($user, $event23);
        $storage->appendEvent($user, $event42);

        $this->assertEquals(
            array($event42),
            $storage->getEventsSince($user, 23)
        );
    }

    public function testGetNoTasks()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $this->assertEquals(
            array(),
            $storage->getTasksSince($user, null)
        );
    }

    public function testGetNoTasksWithRevision()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $this->assertEquals(
            array(),
            $storage->getTasksSince($user, 42)
        );
    }

    public function testGetTask()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $task23 = new Task(array('revision' => 23));

        $storage->appendTask($user, $task23);

        $this->assertEquals(
            array($task23),
            $storage->getTasksSince($user, null)
        );
    }

    public function testGetNoTaskOutdated()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $task23 = new Task(array('revision' => 23));

        $storage->appendTask($user, $task23);

        $this->assertEquals(
            array(),
            $storage->getTasksSince($user, 42)
        );
    }

    public function testGetTaskSubset()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $task23 = new Task(array('revision' => 23));
        $task42 = new Task(array('revision' => 42));

        $storage->appendTask($user, $task23);
        $storage->appendTask($user, $task42);

        $this->assertEquals(
            array($task42),
            $storage->getTasksSince($user, 23)
        );
    }

    public function testGetNoData()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $this->assertEquals(
            array(),
            $storage->getDataSince($user, null)
        );
    }

    public function testGetNoDataWithRevision()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $this->assertEquals(
            array(),
            $storage->getDataSince($user, 42)
        );
    }

    public function testGetData()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $data23 = new Data(array('revision' => 23));

        $storage->storeDataSet($user, '23', $data23);

        $this->assertEquals(
            array(23 => $data23),
            $storage->getDataSince($user, null)
        );
    }

    public function testGetNoDataOutdated()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $data23 = new Data(array('revision' => 23));

        $storage->storeDataSet($user, '23', $data23);

        $this->assertEquals(
            array(),
            $storage->getDataSince($user, 42)
        );
    }

    public function testGetDataSubset()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $data23 = new Data(array('revision' => 23));
        $data42 = new Data(array('revision' => 42));

        $storage->storeDataSet($user, '23', $data23);
        $storage->storeDataSet($user, '42', $data42);

        $this->assertEquals(
            array(42 => $data42),
            $storage->getDataSince($user, 23)
        );
    }

    public function testGetUpdatedData()
    {
        $storage = $this->getStorage();
        $user = $this->getUser();

        $data23_1 = new Data(array('revision' => 23));
        $data23_2 = new Data(array('revision' => 42));

        $storage->storeDataSet($user, '23', $data23_1);
        $storage->storeDataSet($user, '23', $data23_2);

        $this->assertEquals(
            array(23 => $data23_2),
            $storage->getDataSince($user, 23)
        );
    }
}
