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
	 * @param int $storeId
	 * @param string $picture
	 * @return bool
	 */
	public static function addProduct(int $storeId, string $picture)
	{
		return self::getDb()->save(
			[
				'store_id' => $storeId,
				'picture' => $picture
			], true, static::tableName());
	}

	/**
	 * @param int $storeId
	 * @param string $picture
	 * @return bool
	 */
	public static function delByStoreIdAndPicture(int $storeId, string $picture)
	{
		return self::getDb()->delete(
			"store_id = :store_id and picture = :picture",
			[
				'store_id' => $storeId,
				'picture' => $picture
			],
			static::tableName());
	}

	/**
	 * @param int $storeId
	 * @return bool
	 */
	public static function delByStoreId(int $storeId)
	{
		return self::getDb()->delete(
			"store_id = :store_id",
			[
				'store_id' => $storeId,
			],
			static::tableName());
	}


	public static function findByStoreIdAndPicture(int $storeId, string $picture)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where store_id = :store_id and picture = :picture", [":store_id" => $storeId, ":picture" => $picture]);
	}
}