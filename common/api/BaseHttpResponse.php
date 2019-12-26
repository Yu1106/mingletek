<?php

namespace common\api;


use common\PropertyRecord;
use JsonSerializable;

abstract class BaseHttpResponse extends PropertyRecord implements JsonSerializable
{
    public function __construct(string $result)
    {
        $result = json_decode($result);
        foreach ($this->properties() as $f) {
            if (isset($result->$f)) {
                $this->$f = $result->$f;
            }
        }
    }

    public function toArray(): array
    {
        $data = [];
        foreach ($this->properties() as $f) {
            if (isset($this->$f)) {
                $data[$f] = $this->$f;
            }
        }
        return $data;
    }

    public function load(array $data)
    {
        $loaded = false;
        foreach ($this->properties() as $f) {
            if (isset($data[$f])) {
                $this->$f = $data[$f];
                $loaded = true;
            }
        }
        return $loaded;
    }

    public function jsonSerialize()
    {
        $json = [];
        foreach ($this->properties() as $f) {
            if ($this->$f !== "") {
                $json[$f] = $this->$f;
            }
        }
        return $json;
    }
}