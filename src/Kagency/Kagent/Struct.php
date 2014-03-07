<?php

namespace Kagency\Kagent;

/**
 * Class: Struct
 *
 * Base class for all data structs / "value objects".
 *
 * @version $Revision$
 */
abstract class Struct
{
    /**
     * Universal constructor
     *
     * All array properties are set as values inside the struct
     *
     * @param array $values
     * @return void
     */
    public function __construct(array $values = array())
    {
        foreach ($values as $name => $value) {
            $this->$name = $value;
        }
    }

    /**
     * __get
     *
     * Always throws an exception for unknown properties
     *
     * @param string $name
     * @return void
     */
    public function __get($name)
    {
        throw new \OutOfRangeException("Unknown property \${$name} in " . get_class($this) . ".");
    }

    /**
     * __set
     *
     * Always throws an exception for unknown properties
     *
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function __set($name, $value)
    {
        throw new \OutOfRangeException("Unknown property \${$name} in " . get_class($this) . ".");
    }

    /**
     * __unset
     *
     * Always throws an exception for unknown properties
     *
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function __unset($name)
    {
        throw new \OutOfRangeException("Unknown property \${$name} in " . get_class($this) . ".");
    }

    /**
     * __isset
     *
     * Always returns false
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return false;
    }

    /**
     * Recursively clone object
     *
     * @return void
     */
    public function __clone()
    {
        foreach ($this as $property => $value) {
            if (is_object($value)) {
                $this->$property = clone $value;
            }

            if (is_array($value)) {
                $this->cloneArray($this->$property);
            }
        }
    }

    /**
     * Recursively clone array property
     *
     * @param array $array
     */
    private function cloneArray(array &$array)
    {
        foreach ($array as $key => $value) {
            if (is_object($value)) {
                $array[$key] = clone $value;
            }

            if (is_array($value)) {
                $this->cloneArray($array[$key]);
            }
        }
    }
}
