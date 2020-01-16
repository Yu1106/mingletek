<?php

namespace common\csv\vendor\yahoo;

use common\csv\ShopFactory;
use common\model\parameter\Store;

class Yahoo extends ShopFactory
{
	/**
	 * @param YahooRecord $data
	 */
	public function setData(YahooRecord $data)
	{
		$this->data = $data;
	}

	/**
	 * @return int
	 */
	public function shopType(): int
	{
		return Store::YAHOO;
	}

	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'category' => '類別',
			'name' => '商品名稱',
			'keyword' => '標籤',
			'product_description' => '商品描述',
			'site' => '所在地區',
			'stock' => '商品數量',
			'price' => '定價',
			'sell_price' => '促銷價',
			'posting_days' => '刊登天數',
			'is_new' => '商品新舊',
			'color_size' => '第一層規格:名稱',
			'item_name_1' => '規格項目1~20:名稱',
			'item_quantity_1' => '規格項目1~20:數量',
			'item_name_2' => '規格項目1~20:名稱',
			'item_quantity_2' => '規格項目1~20:數量',
			'item_name_3' => '規格項目1~20:名稱',
			'item_quantity_3' => '規格項目1~20:數量',
			'item_name_4' => '規格項目1~20:名稱',
			'item_quantity_4' => '規格項目1~20:數量',
			'item_name_5' => '規格項目1~20:名稱',
			'item_quantity_5' => '規格項目1~20:數量',
			'item_name_6' => '規格項目1~20:名稱',
			'item_quantity_6' => '規格項目1~20:數量',
			'item_name_7' => '規格項目1~20:名稱',
			'item_quantity_7' => '規格項目1~20:數量',
			'item_name_8' => '規格項目1~20:名稱',
			'item_quantity_8' => '規格項目1~20:數量',
			'item_name_9' => '規格項目1~20:名稱',
			'item_quantity_9' => '規格項目1~20:數量',
			'item_name_10' => '規格項目1~20:名稱',
			'item_quantity_10' => '規格項目1~20:數量',
			'item_name_11' => '規格項目1~20:名稱',
			'item_quantity_11' => '規格項目1~20:數量',
			'item_name_12' => '規格項目1~20:名稱',
			'item_quantity_12' => '規格項目1~20:數量',
			'item_name_13' => '規格項目1~20:名稱',
			'item_quantity_13' => '規格項目1~20:數量',
			'item_name_14' => '規格項目1~20:名稱',
			'item_quantity_14' => '規格項目1~20:數量',
			'item_name_15' => '規格項目1~20:名稱',
			'item_quantity_15' => '規格項目1~20:數量',
			'item_name_16' => '規格項目1~20:名稱',
			'item_quantity_16' => '規格項目1~20:數量',
			'item_name_17' => '規格項目1~20:名稱',
			'item_quantity_17' => '規格項目1~20:數量',
			'item_name_18' => '規格項目1~20:名稱',
			'item_quantity_18' => '規格項目1~20:數量',
			'item_name_19' => '規格項目1~20:名稱',
			'item_quantity_19' => '規格項目1~20:數量',
			'item_name_20' => '規格項目1~20:名稱',
			'item_quantity_20' => '規格項目1~20:數量',
			'pay_easily_cash' => '接受輕鬆付現金付款',
			'pay_easily_credit_card' => '接受輕鬆付信用卡一次付清',
			'pay_easily_family_mart' => '接受輕鬆付全家取貨付款',
			'pay_easily_seven_eleven' => '接受輕鬆付7-11取貨付款',
			'pay_easily_cash_on_delivery' => '接受輕鬆付郵局貨到付款',
			'ct_cash' => '接受中信易付現金付款',
			'ct_credit_card' => '接受中信易付信用卡一次付清',
			'ct_seven_eleven' => '接受中信易付7-11取貨付款',
			'ct_contract_account' => '接受中信易付約定帳戶付款',
			'ct_union_pay_cards' => '接受中信易付銀聯卡',
			'family_mart_freight' => '套用全店運費',
			'send' => '郵寄掛號',
			'family_mart_pick_up' => '全家取貨付款',
			'seven_eleven_pick_up' => '7-11取貨付款',
			'post_office_pick_up' => '郵局貨到付款',
			'home_delivery' => '宅配',
			'low_temperature_delivery' => '低溫寄送',
			'outlying_islands' => '離島寄送',
			'international_shipping' => '跨國寄送',
			'self_pick' => '面交/自取/不寄送',
			'overweight_item' => '大型/超重物品寄送',
			'picture' => '圖片1~15',
			'video_url' => '影片網址',
			'open_bargaining' => '開啟議價',
			'automatic_rejection_price' => '自動拒絕價',
			'purchase_limit' => '購買數量限制',
			'lowest_rating' => '最低評價',
			'negative_ratings' => '負評價數',
			'attribute_field' => '屬性欄位1~20'
		];
	}
}