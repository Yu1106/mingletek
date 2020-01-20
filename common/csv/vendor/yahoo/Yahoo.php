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
			'standard_name' => '第一層規格:名稱',
			'standard_1_name' => '規格項目1:名稱',
			'standard_1_quantity' => '規格項目1:數量',
			'standard_2_name' => '規格項目2:名稱',
			'standard_2_quantity' => '規格項目2:數量',
			'standard_3_name' => '規格項目3:名稱',
			'standard_3_quantity' => '規格項目3:數量',
			'standard_4_name' => '規格項目4:名稱',
			'standard_4_quantity' => '規格項目4:數量',
			'standard_5_name' => '規格項目5:名稱',
			'standard_5_quantity' => '規格項目5:數量',
			'standard_6_name' => '規格項目6:名稱',
			'standard_6_quantity' => '規格項目6:數量',
			'standard_7_name' => '規格項目7:名稱',
			'standard_7_quantity' => '規格項目7:數量',
			'standard_8_name' => '規格項目8:名稱',
			'standard_8_quantity' => '規格項目8:數量',
			'standard_9_name' => '規格項目9:名稱',
			'standard_9_quantity' => '規格項目9:數量',
			'standard_10_name' => '規格項目10:名稱',
			'standard_10_quantity' => '規格項目10:數量',
			'standard_11_name' => '規格項目11:名稱',
			'standard_11_quantity' => '規格項目11:數量',
			'standard_12_name' => '規格項目12:名稱',
			'standard_12_quantity' => '規格項目12:數量',
			'standard_13_name' => '規格項目13:名稱',
			'standard_13_quantity' => '規格項目13:數量',
			'standard_14_name' => '規格項目14:名稱',
			'standard_14_quantity' => '規格項目14:數量',
			'standard_15_name' => '規格項目15:名稱',
			'standard_15_quantity' => '規格項目15:數量',
			'standard_16_name' => '規格項目16:名稱',
			'standard_16_quantity' => '規格項目16:數量',
			'standard_17_name' => '規格項目17:名稱',
			'standard_17_quantity' => '規格項目17:數量',
			'standard_18_name' => '規格項目18:名稱',
			'standard_18_quantity' => '規格項目18:數量',
			'standard_19_name' => '規格項目19:名稱',
			'standard_19_quantity' => '規格項目19:數量',
			'standard_20_name' => '規格項目20:名稱',
			'standard_20_quantity' => '規格項目20:數量',
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
			'package' => '郵寄掛號',
			'family_mart_pick_up' => '全家取貨付款',
			'seven_eleven_pick_up' => '7-11取貨付款',
			'post_office_pick_up' => '郵局貨到付款',
			'home_delivery' => '宅配',
			'low_temperature_delivery' => '低溫寄送',
			'outlying_islands' => '離島寄送',
			'international_shipping' => '跨國寄送',
			'self_pick' => '面交/自取/不寄送',
			'overweight_item' => '大型/超重物品寄送',
			'video_url' => '影片網址',
			'picture_1' => '圖片1',
			'picture_2' => '圖片2',
			'picture_3' => '圖片3',
			'picture_4' => '圖片4',
			'picture_5' => '圖片5',
			'picture_6' => '圖片6',
			'picture_7' => '圖片7',
			'picture_8' => '圖片8',
			'picture_9' => '圖片9',
			'picture_10' => '圖片10',
			'picture_11' => '圖片11',
			'picture_12' => '圖片12',
			'picture_13' => '圖片13',
			'picture_14' => '圖片14',
			'picture_15' => '圖片15',
			'purchase_limit' => '購買數量限制',
			'lowest_rating' => '最低評價',
			'negative_ratings' => '負評價數',
			'attribute_1' => '屬性欄位1',
			'attribute_2' => '屬性欄位2',
			'attribute_3' => '屬性欄位3',
			'attribute_4' => '屬性欄位4',
			'attribute_5' => '屬性欄位5',
			'attribute_6' => '屬性欄位6',
			'attribute_7' => '屬性欄位7',
			'attribute_8' => '屬性欄位8',
			'attribute_9' => '屬性欄位9',
			'attribute_10' => '屬性欄位10',
			'attribute_11' => '屬性欄位11',
			'attribute_12' => '屬性欄位12',
			'attribute_13' => '屬性欄位13',
			'attribute_14' => '屬性欄位14',
			'attribute_15' => '屬性欄位15',
			'attribute_16' => '屬性欄位16',
			'attribute_17' => '屬性欄位17',
			'attribute_18' => '屬性欄位18',
			'attribute_19' => '屬性欄位19',
			'attribute_20' => '屬性欄位20',
		];
	}
}