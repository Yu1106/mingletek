<?php


namespace common\model;


use common\db\DbExpression;

class ExportFileLog extends Model
{
	protected static function tableName()
	{
		return "export_file_log";
	}

	public static function addLog(int $userId, int $type, string $fileName)
	{
		return self::getDb()->save(
			[
				'user_id' => $userId,
				'upload_store_type' => $type,
				'file_name' => $fileName,
				'create_date' => new DbExpression("now()")
			], true, static::tableName());
	}

	public static function findOneByUserId(int $userId, int $type)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where user_id = :user_id and upload_store_type = :upload_store_type order by id desc limit 1", [":user_id" => $userId, ":upload_store_type" => $type]);
	}
}