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
	 * @return bool
	 */
	public static function findByStoreId(int $storeId)
	{
		return self::getDb()->sqlQuery("select * from `" . static::tableName() . "` where store_id = :store_id order by id", [":store_id" => $storeId]);
	}

	/**
	 * @param int $id
	 * @param int $storeId
	 * @return bool
	 */
	public static function findByIdAndStoreId(int $id, int $storeId)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where id = :id and store_id = :store_id order by id", [":id" => $id, ":store_id" => $storeId]);
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
	 * @param int $id
	 * @param array $data
	 * @return bool
	 */
	public static function modifyProductData(int $id, array $data)
	{
		return self::getDb()->update(
			$data,
			"id = :id",
			['id' => $id],
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


	public static function findByStoreIdAndPicture(int $storeId, string $picture)
	{
		return self::getDb()->queryOne("select * from `" . static::tableName() . "` where store_id = :store_id and picture = :picture", [":store_id" => $storeId, ":picture" => $picture]);
	}

	/**
	 * @param int $id
	 * @param string $productDescription
	 * @return bool
	 */
	public static function modifyProductDescription(int $id, string $productDescription)
	{
		return self::getDb()->update(
			['product_description' => $productDescription],
			"id = :id",
			['id' => $id],
			static::tableName()
		);
	}
}