<?php

namespace common;


use Exception;

abstract class PropertyRecord implements PropertyInterface
{

    /**
     * @param $name
     * @return null|mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        if (in_array($name, $this->properties()) || isset($this->properties()[$name])) {
            if (property_exists($this, $name)) {
                return $this->$name;
            } else {
                return null;
            }
        } else {
            throw new Exception('Getting unknown property: ' . get_class($this) . '::' . $name);
        }
    }
}