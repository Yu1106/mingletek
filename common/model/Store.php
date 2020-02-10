<?php

namespace common\model;

use common\db\DbExpression;

/**
 * Class Store
 * @package common\model
 */
class Store extends Model
{
	protected static function tableName()
	{
		return "store";
	}

	/**
	 * @param int $userId
	 * @param string $name
	 * @param string $note
	 * @param string $returnNotice
	 * @param int $clothesType
	 * @param string $uploadStoreType
	 * @return bool
	 */
	public static function addStore(int $userId, string $name, string $note, string $returnNotice, int $clothesType, string $uploadStoreType)
	{
		return self::getDb()->save(
			[
				'user_id' => $userId,
				'name' => $name,
				'note' => $note,
				'return_notice' => $returnNotice,
				'clothes_type' => $clothesType,
				'upload_store_type' => $uploadStoreType,
				'create_date' => new DbExpression("now()"),
			], true, static::tableName());
	}

	/**
	 * @param int $id
	 * @param string $uid
	 * @return bool
	 */
	public static function modifyUid(int $id, string $uid)
	{
		return self::getDb()->update(
			[
				'uid' => $uid
			],
			"id = :id",
			[
				'id' => $id
			],
			static::tableName()
		);
	}

	public static function findLastOneByUserId(int $userId)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where user_id = :user_id order by id desc", [":user_id" => $userId]);
	}
}