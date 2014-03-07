<?php

namespace Kagency\Kagent;

class TestStruct extends Struct
{
    public $property;
}

class StructTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValue()
    {
        $struct = new TestStruct();

        $this->assertNull($struct->property);
    }

    public function testConstructor()
    {
        $struct = new TestStruct(
            array(
                'property' => 42,
            )
        );

        $this->assertSame(42, $struct->property);
    }

    public function testSetValue()
    {
        $struct = new TestStruct();
        $struct->property = 42;

        $this->assertSame(42, $struct->property);
    }

    public function testUnsetValue()
    {
        $struct = new TestStruct();
        $struct->property = 42;
        unset($struct->property);
    }

    public function testIssetValue()
    {
        $struct = new TestStruct();
        $struct->property = 42;
        $this->assertTrue(isset($struct->property));
    }

    public function testIssetUnknownValue()
    {
        $struct = new TestStruct();
        $this->assertFalse(isset($struct->unknown));
    }

    /**
     * @expectedException \OutOfRangeException
     */
    public function testGetUnknownValue()
    {
        $struct = new TestStruct();

        $this->assertNull($struct->unknown);
    }

    /**
     * @expectedException \OutOfRangeException
     */
    public function testConstructorUnknwonValue()
    {
        $struct = new TestStruct(
            array(
                'unknown' => 42,
            )
        );
    }

    /**
     * @expectedException \OutOfRangeException
     */
    public function testSetUnknownValue()
    {
        $struct = new TestStruct();
        $struct->unknown = 42;
    }

    /**
     * @expectedException \OutOfRangeException
     */
    public function testUnsetUnknownValue()
    {
        $struct = new TestStruct();
        unset($struct->unknown);
    }

    public function testClone()
    {
        $struct = new TestStruct();
        $clonedStruct = clone $struct;
        $this->assertNotSame($clonedStruct, $struct);
    }

    public function testCloneProperty()
    {
        $struct = new TestStruct(
            array(
                'property' => new TestStruct(),
            )
        );
        $clonedStruct = clone $struct;
        $this->assertNotSame($clonedStruct->property, $struct->property);
    }

    public function testCloneArrayProperty()
    {
        $struct = new TestStruct(
            array(
                'property' => array(new TestStruct()),
            )
        );
        $clonedStruct = clone $struct;
        $this->assertNotSame($clonedStruct->property[0], $struct->property[0]);
    }

    public function testCloneRecursiveArrayProperty()
    {
        $struct = new TestStruct(
            array(
                'property' => array(array(new TestStruct())),
            )
        );
        $clonedStruct = clone $struct;
        $this->assertNotSame($clonedStruct->property[0][0], $struct->property[0][0]);
    }
}
