<?php


namespace common\model;


class SubPicture extends Model
{
	protected static function tableName()
	{
		return "sub_picture";
	}

	/**
	 * @param int $storeId
	 * @param string $picture
	 * @return bool
	 */
	public static function addSubPicture(int $storeId, string $picture)
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
	 * @param int $productId
	 * @return bool
	 */
	public static function modifyByStoreIdAndPicture(int $storeId, string $picture, int $productId)
	{
		return self::getDb()->update(
			[
				'product_id' => $productId
			],
			"store_id = :store_id and picture = :picture",
			['store_id' => $storeId, ':picture' => $picture],
			static::tableName()
		);
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

	/**
	 * @param int $storeId
	 * @param int $productId
	 * @return bool
	 */
	public static function findByStoreIdAndProductId(int $storeId, int $productId)
	{
		return self::getDb()->sqlQuery("select * from `" . static::tableName() . "` where store_id = :store_id and product_id = :product_id order by id", [":store_id" => $storeId, ":product_id" => $productId]);
	}

	/**
	 * @param int $storeId
	 * @param string $picture
	 * @return mixed|null
	 */
	public static function findByStoreIdAndPicture(int $storeId, string $picture)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where store_id = :store_id and picture = :picture", [":store_id" => $storeId, ":picture" => $picture]);
	}
}