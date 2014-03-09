<?php

namespace Kagency\Kagent\Storage;

use Kagency\Kagent\StorageTest;

require_once __DIR__ . '/../StorageTest.php';

class InMemoryTest extends StorageTest
{
    /**
     * Get storage
     *
     * Get test subject
     *
     * @return Storage
     */
    protected function getStorage()
    {
        return new InMemory();
    }
}
