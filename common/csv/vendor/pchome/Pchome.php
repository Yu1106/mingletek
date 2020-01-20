<?php

namespace common\csv\vendor\pchome;

use common\csv\ShopFactory;
use common\model\parameter\Store;

class Pchome extends ShopFactory
{
	/**
	 * @param PchomeRecord $data
	 */
	public function setData(PchomeRecord $data)
	{
		$this->data = $data;
	}

	/**
	 * @return int
	 */
	public function shopType(): int
	{
		return Store::PCHOME;
	}

	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'name' => '商品名稱',
			'category' => '館別設定',
			'price' => '商品售價',
			'sell_price' => '商品建議售價',
			'standard' => '規格名稱',
			'size_color' => '商品規格',
			'stock' => '商品庫存量',
			'description' => '商品簡介',
			'product_description' => '商品介紹',
			'is_new' => '物品新舊',
			'picture' => '圖檔名稱',
			'site' => '商品所在地'
		];
	}
}