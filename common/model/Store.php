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
	 * @param string $uid
	 * @param string $name
	 * @param string $note
	 * @param string $returnNotice
	 * @param int $clothesType
	 * @param string $uploadStoreType
	 * @return bool
	 */
	public static function addStore(int $userId, string $uid, string $name, string $note, string $returnNotice, int $clothesType, string $uploadStoreType)
	{
		return self::getDb()->save(
			[
				'user_id' => $userId,
				'uid' => $uid,
				'name' => $name,
				'note' => $note,
				'return_notice' => $returnNotice,
				'clothes_type' => $clothesType,
				'upload_store_type' => $uploadStoreType,
				'create_date' => new DbExpression("now()"),
			], true, static::tableName());
	}

	/**
	 * @param int $userId
	 * @param string $uid
	 * @param string $token
	 * @return bool
	 */
	public static function modifyStoreToken(int $userId, string $uid, string $token)
	{
		return self::getDb()->update(
			[
				'token' => $token
			],
			"user_id = :user_id and uid = :uid",
			[
				'user_id' => $userId,
				'uid' => $uid
			],
			static::tableName()
		);
	}

	/**
	 * @param int $userId
	 * @param string $uid
	 * @return mixed|null
	 */
	public static function findStoreByUserIdAndUid(int $userId, string $uid)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where user_id = :user_id and uid = :uid", [":user_id" => $userId, ":uid" => $uid]);
	}
}