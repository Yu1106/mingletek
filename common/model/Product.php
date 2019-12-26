<?php


namespace common\model;


use common\db\DbExpression;

class Product extends Model
{
	protected static function tableName()
	{
		return "product";
	}

	/**
	 * @param string $uid
	 * @param string $picture
	 * @return bool
	 */
	public static function addProduct(string $uid, string $picture)
	{
		return self::getDb()->save(
			[
				'uid' => $uid,
				'picture' => $picture
			], true, static::tableName());
	}

	/**
	 * @param string $uid
	 * @param string $picture
	 * @return bool
	 */
	public static function delByUidAndPicture(string $uid, string $picture)
	{
		return self::getDb()->delete(
			"uid = :uid and picture = :picture",
			[
				'uid' => $uid,
				'picture' => $picture
			],
			static::tableName());
	}

	/**
	 * @param string $uid
	 * @return bool
	 */
	public static function delByUid(string $uid)
	{
		return self::getDb()->delete(
			"uid = :uid",
			[
				'uid' => $uid,
			],
			static::tableName());
	}

	/**
	 * @param string $uid
	 * @param string $picture
	 * @return bool
	 */
	public static function findByUidAndPicture(string $uid, string $picture)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where uid = :uid and picture = :picture", [":uid" => $uid, ":picture" => $picture]);
	}
}