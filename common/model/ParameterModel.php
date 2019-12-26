<?php

namespace common\model;

use common\db\DbExpression;

class ParameterModel extends Model
{
	protected static function tableName()
	{
		return "parameter";
	}

	public function getValue($name)
	{
		$query = self::getDb()->queryOne("select * from `" . static::tableName() . "` where key_id = :key_id", [":key_id" => $name]);
		return $query['value'];
	}

	public function setValue($name, $value)
	{
		return self::getDb()->save(
			[
				'key_id' => $name,
				'value' => $value,
				'create_date' => new DbExpression("now()")
			], true, static::tableName());
	}
}
