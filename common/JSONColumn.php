<?php

namespace common;


use Exception;
use JsonSerializable;
use ReflectionClass;

abstract class JSONColumn extends PropertyRecord implements JsonSerializable
{
    /**
     * @param bool $filterEmpty
     * @return array|mixed
     */
    public function jsonSerialize(bool $filterEmpty = false)
    {
        $json = [];
        foreach ($this->properties() as $f) {
            if ($filterEmpty && $this->$f == "") {
                // filter empty
            } else {
                $json[$f] = $this->$f;
            }
        }
        return $json;
    }

    /**
     * @param string $json
     * @return static[]
     */
    public static function toArray($json)
    {
        if (empty($json)) return [];
        $data = [];
        $jsonArray = json_decode($json);
        foreach ($jsonArray as $array) {
            $o = new static();
            foreach ($o->properties() as $f) {
                if (isset($array->$f)) {
                    $o->$f = $array->$f;
                }
            }
            array_push($data, $o);
        }
        return $data;
    }


    /**
     * @param string $json
     * @return static
     */
    public static function toObject(string $json)
    {
        $jsonArray = json_decode($json);
        $o = new static();
        foreach ($o->properties() as $f) {
            if (isset($jsonArray->$f)) {
                $o->$f = $jsonArray->$f;
            }
        }
        return $o;
    }

    public function apply(string $json)
    {
        $jsonArray = json_decode($json);
        foreach ($this->properties() as $f) {
            if (isset($jsonArray->$f)) {
                $this->$f = $jsonArray->$f;
            }
        }
    }

    public function loadData($data, $formName = null)
    {
        $loaded = false;
        if ($formName === null) {
            if(isset($data[$this->formName()])) {
                $data = $data[$this->formName()];
            }
        } else if ($formName !== "") {
            $data = $data[$formName];
        }
        foreach ($this->properties() as $f) {
            if (isset($data[$f]) && !is_null($data[$f])) {
                $this->$f = $data[$f];
                $loaded = true;
            }
        }
        return $loaded;
    }

    /**
     * @return string
     * @throws InvalidConfigException
     * @throws \ReflectionException
     */
    public function formName()
    {
        $reflector = new ReflectionClass($this);
        if (PHP_VERSION_ID >= 70000 && $reflector->isAnonymous()) {
            throw new Exception('The "formName()" method should be explicitly defined for anonymous models');
        }
        return $reflector->getShortName();
    }

}