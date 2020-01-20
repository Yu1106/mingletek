<?php

namespace common\csv\vendor\yahoo;

use common\PropertyRecord;

/**
 * Class Yahoo
 * @property string $category
 * @property string $name
 * @property string $keyword
 * @property string $product_description
 * @property string $site
 * @property string $stock
 * @property string $price
 * @property string $sell_price
 * @property string $posting_days
 * @property string $is_new
 * @property string $standard_name
 * @property string $standard_1_name
 * @property string $standard_1_quantity
 * @property string $standard_2_name
 * @property string $standard_2_quantity
 * @property string $standard_3_name
 * @property string $standard_3_quantity
 * @property string $standard_4_name
 * @property string $standard_4_quantity
 * @property string $standard_5_name
 * @property string $standard_5_quantity
 * @property string $standard_6_name
 * @property string $standard_6_quantity
 * @property string $standard_7_name
 * @property string $standard_7_quantity
 * @property string $standard_8_name
 * @property string $standard_8_quantity
 * @property string $standard_9_name
 * @property string $standard_9_quantity
 * @property string $standard_10_name
 * @property string $standard_10_quantity
 * @property string $standard_11_name
 * @property string $standard_11_quantity
 * @property string $standard_12_name
 * @property string $standard_12_quantity
 * @property string $standard_13_name
 * @property string $standard_13_quantity
 * @property string $standard_14_name
 * @property string $standard_14_quantity
 * @property string $standard_15_name
 * @property string $standard_15_quantity
 * @property string $standard_16_name
 * @property string $standard_16_quantity
 * @property string $standard_17_name
 * @property string $standard_17_quantity
 * @property string $standard_18_name
 * @property string $standard_18_quantity
 * @property string $standard_19_name
 * @property string $standard_19_quantity
 * @property string $standard_20_name
 * @property string $standard_20_quantity
 * @property string $pay_easily_cash
 * @property string $pay_easily_credit_card
 * @property string $pay_easily_family_mart
 * @property string $pay_easily_seven_eleven
 * @property string $pay_easily_cash_on_delivery
 * @property string $ct_cash
 * @property string $ct_credit_card
 * @property string $ct_seven_eleven
 * @property string $ct_contract_account
 * @property string $ct_union_pay_cards
 * @property string $family_mart_freight
 * @property string $package
 * @property string $family_mart_pick_up
 * @property string $seven_eleven_pick_up
 * @property string $post_office_pick_up
 * @property string $home_delivery
 * @property string $low_temperature_delivery
 * @property string $outlying_islands
 * @property string $international_shipping
 * @property string $self_pick
 * @property string $overweight_item
 * @property string $video_url
 * @property string $picture_1
 * @property string $picture_2
 * @property string $picture_3
 * @property string $picture_4
 * @property string $picture_5
 * @property string $picture_6
 * @property string $picture_7
 * @property string $picture_8
 * @property string $picture_9
 * @property string $picture_10
 * @property string $picture_11
 * @property string $picture_12
 * @property string $picture_13
 * @property string $picture_14
 * @property string $picture_15
 * @property string $purchase_limit
 * @property string $lowest_rating
 * @property string $negative_ratings
 * @property string $attribute_1
 * @property string $attribute_2
 * @property string $attribute_3
 * @property string $attribute_4
 * @property string $attribute_5
 * @property string $attribute_6
 * @property string $attribute_7
 * @property string $attribute_8
 * @property string $attribute_9
 * @property string $attribute_10
 * @property string $attribute_11
 * @property string $attribute_12
 * @property string $attribute_13
 * @property string $attribute_14
 * @property string $attribute_15
 * @property string $attribute_16
 * @property string $attribute_17
 * @property string $attribute_18
 * @property string $attribute_19
 * @property string $attribute_20
 */
class YahooRecord extends PropertyRecord
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'category',
			'name',
			'keyword',
			'product_description',
			'site',
			'stock',
			'price',
			'sell_price',
			'posting_days',
			'is_new',
			'standard_name',
			'standard_1_name',
			'standard_1_quantity',
			'standard_2_name',
			'standard_2_quantity',
			'standard_3_name',
			'standard_3_quantity',
			'standard_4_name',
			'standard_4_quantity',
			'standard_5_name',
			'standard_5_quantity',
			'standard_6_name',
			'standard_6_quantity',
			'standard_7_name',
			'standard_7_quantity',
			'standard_8_name',
			'standard_8_quantity',
			'standard_9_name',
			'standard_9_quantity',
			'standard_10_name',
			'standard_10_quantity',
			'standard_11_name',
			'standard_11_quantity',
			'standard_12_name',
			'standard_12_quantity',
			'standard_13_name',
			'standard_13_quantity',
			'standard_14_name',
			'standard_14_quantity',
			'standard_15_name',
			'standard_15_quantity',
			'standard_16_name',
			'standard_16_quantity',
			'standard_17_name',
			'standard_17_quantity',
			'standard_18_name',
			'standard_18_quantity',
			'standard_19_name',
			'standard_19_quantity',
			'standard_20_name',
			'standard_20_quantity',
			'pay_easily_cash',
			'pay_easily_credit_card',
			'pay_easily_family_mart',
			'pay_easily_seven_eleven',
			'pay_easily_cash_on_delivery',
			'ct_cash',
			'ct_credit_card',
			'ct_seven_eleven',
			'ct_contract_account',
			'ct_union_pay_cards',
			'family_mart_freight',
			'package',
			'family_mart_pick_up',
			'seven_eleven_pick_up',
			'post_office_pick_up',
			'home_delivery',
			'low_temperature_delivery',
			'outlying_islands',
			'international_shipping',
			'self_pick',
			'overweight_item',
			'video_url',
			'picture_1',
			'picture_2',
			'picture_3',
			'picture_4',
			'picture_5',
			'picture_6',
			'picture_7',
			'picture_8',
			'picture_9',
			'picture_10',
			'picture_11',
			'picture_12',
			'picture_13',
			'picture_14',
			'picture_15',
			'purchase_limit',
			'lowest_rating',
			'negative_ratings',
			'attribute_1',
			'attribute_2',
			'attribute_3',
			'attribute_4',
			'attribute_5',
			'attribute_6',
			'attribute_7',
			'attribute_8',
			'attribute_9',
			'attribute_10',
			'attribute_11',
			'attribute_12',
			'attribute_13',
			'attribute_14',
			'attribute_15',
			'attribute_16',
			'attribute_17',
			'attribute_18',
			'attribute_19',
			'attribute_20',
		];
	}
}