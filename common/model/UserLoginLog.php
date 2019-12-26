<?php


namespace common\model;

use common\db\DbExpression;

class UserLoginLog extends Model
{
	protected static function tableName()
	{
		return "user_login_log";
	}

	public static function addUserLoginLog(int $userId, int $action, string $ip)
	{
		self::getDb()->save(
			[
				'user_id' => $userId,
				'action' => $action,
				'ip' => $ip,
				'create_date' => new DbExpression("now()")
			], true, static::tableName());
	}

	public static function findByUserIdAndAction(int $userId, int $action)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where user_id = :user_id and action = :action order by id desc", [":user_id" => $userId, ":action" => $action]);
	}
}