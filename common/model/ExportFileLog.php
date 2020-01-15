<?php


namespace common\model;


use common\db\DbExpression;

class ExportFileLog extends Model
{
	protected static function tableName()
	{
		return "export_file_log";
	}

	public static function addLog(int $userId, int $storeId, string $uid, int $type, string $fileName)
	{
		return self::getDb()->save(
			[
				'user_id' => $userId,
				'store_id' => $storeId,
				'uid' => $uid,
				'store_id' => $storeId,
				'upload_store_type' => $type,
				'file_name' => $fileName,
				'create_date' => new DbExpression("now()")
			], true, static::tableName());
	}

	public static function findAllByUserIdAndStoreIdAndUid(int $userId, int $storeId, string $uid)
	{
		return self::getDb()->sqlQuery("select * from `" . static::tableName() . "` where user_id = :user_id and store_id = :store_id and uid = :uid order by id desc", [":user_id" => $userId, ":store_id" => $storeId, ":uid" => $uid]);
	}
}