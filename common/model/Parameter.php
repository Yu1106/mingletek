<?php

namespace common\model;

use common\PropertyInterface;
use Exception;
use ReflectionClass;

abstract class Parameter implements PropertyInterface, \JsonSerializable
{
	public $defaultBehavior = false;

	public function __isset($name)
	{
		return in_array($name, $this->properties());
	}

	public function __get($name)
	{
		if ($this->defaultBehavior) {
			if (isset($this->$name)) {
				return $this->$name;
			} else {
				return "";
			}
		}
		if (in_array($name, $this->properties())) {
			return ParameterModel::getValue($name);
		} else {
			throw new Exception('Getting unknown property: ' . get_class($this) . '::' . $name);
		}
	}

	public function __set($name, $value)
	{
		if ($this->defaultBehavior) {
			$this->$name = $value;
		}

		if (in_array($name, $this->properties())) {
			ParameterModel::setValue($name, $value);
		} else {
			throw new Exception('Setting unknown property: ' . get_class($this) . '::' . $name);
		}
	}

	public function load($data, $formName = null)
	{
		$loaded = false;
		if ($formName === null) {
			if (isset($data[$this->formName()])) {
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
	 * @param array $request
	 * @return bool
	 */
	public function update(array $request)
	{
		$updated = false;
		foreach ($this->properties() as $f) {
			if (isset($request[$f])) {
				$this->$f = $request[$f];
				$updated = true;
			}
		}
		return $updated;
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

	public function save()
	{
		foreach ($this->properties() as $f) {
			if (isset($this->$f)) {
				ParameterModel::setValue($f, $this->$f);
			}
		}
	}

	public function jsonSerialize()
	{
		$data = [];
		foreach ($this->properties() as $p) {
			if (!is_null($this->$p)) {
				$data[$p] = $this->$p;
			} else {
				$data[$p] = null;
			}
		}

		return $data;
	}
}