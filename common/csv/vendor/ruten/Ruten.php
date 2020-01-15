<?php

namespace common\csv\vendor\ruten;

use common\csv\ShopFactory;
use common\model\parameter\Store;

class Ruten extends ShopFactory
{
	/**
	 * @param RutenRecord $data
	 */
	public function setData(RutenRecord $data)
	{
		$this->data = $data;
	}

	/**
	 * @return int
	 */
	public function shopType(): int
	{
		return Store::RUTEN;
	}

	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'category' => '類別',
			'name' => '物品名稱',
			'sell_price' => '直接購買價',
			'stock' => '數量',
			'custom_category' => '自訂賣場分類',
			'product_description' => '物品說明',
			'is_new' => '物品新舊',
			'picture1' => '圖片1',
			'picture2' => '圖片2',
			'picture3' => '圖片3',
			'site' => '物品所在地',
			'score_greater_than' => '評價總分需大於',
			'score_less_than' => '差勁評價需小於',
			'abandoned' => '棄標不可超過次數',
			'handcraft' => '手工製品',
			'bag' => '附禮盒/提袋',
			'original_warranty' => '原廠保固',
			'seller_warranty' => '賣家保固',
			'house' => '到府安裝',
			'diy' => 'DIY安裝',
			'counter_genuine' => '專櫃正品',
			'company_goods' => '公司貨',
			'parallel_input' => '平行輸入',
			'billable' => '可開發票',
			'receipt' => '可開收據',
			'with_guarantee' => '附保證書',
			'with_appraisal' => '附鑑定書',
			'size' => '有多種尺寸',
			'color' => '有多種顏色'
		];
	}
}