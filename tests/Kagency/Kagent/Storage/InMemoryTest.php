<?php

namespace Kagency\Kagent\Storage;

use Kagency\Kagent\StorageTest;

require_once __DIR__ . '/../StorageTest.php';

/**
 * @covers \Kagency\Kagent\Storage\InMemory
 * @uses Kagency\Kagent\Struct
 */
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
