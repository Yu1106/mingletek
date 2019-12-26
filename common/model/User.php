<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/17
 * Time: 下午 11:00
 */

namespace common\model;


use common\db\DbExpression;

class User extends Model
{
	protected static function tableName()
	{
		return "user";
	}

	public static function findUserBySocialId(string $socialId)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where social_id = :social_id", [":social_id" => $socialId]);
	}

	public static function addUser(string $socialId, string $email, string $name)
	{
		return self::getDb()->save(
			[
				'social_id' => $socialId,
				'email' => $email,
				'name' => $name,
				'modify_date' => new DbExpression("now()"),
				'create_date' => new DbExpression("now()")
			], true, static::tableName());
	}

	public static function modifyUser(string $socialId, string $email, string $name)
	{
		return self::getDb()->update(
			[
				'email' => $email,
				'name' => $name,
				'modify_date' => new DbExpression("now()")
			],
			"social_id = :social_id",
			['social_id' => $socialId],
			static::tableName()
		);
	}
}
