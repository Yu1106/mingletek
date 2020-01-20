<?php

namespace common\csv\vendor\ruten;

use common\PropertyRecord;

/**
 * Class Ruten
 * @property string $category
 * @property string $name
 * @property string $sell_price
 * @property string $stock
 * @property string $custom_category
 * @property string $product_description
 * @property string $is_new
 * @property string $picture_1
 * @property string $picture_2
 * @property string $picture_3
 * @property string $site
 * @property string $score_greater_than
 * @property string $score_less_than
 * @property string $abandoned
 * @property string $handcraft
 * @property string $bag
 * @property string $original_warranty
 * @property string $seller_warranty
 * @property string $house
 * @property string $diy
 * @property string $counter_genuine
 * @property string $company_goods
 * @property string $parallel_input
 * @property string $billable
 * @property string $receipt
 * @property string $with_guarantee
 * @property string $with_appraisal
 * @property string $size
 * @property string $color
 */
class RutenRecord extends PropertyRecord
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'category',
			'name',
			'sell_price',
			'stock',
			'custom_category',
			'product_description',
			'is_new',
			'picture_1',
			'picture_2',
			'picture_3',
			'site',
			'score_greater_than',
			'score_less_than',
			'abandoned',
			'handcraft',
			'bag',
			'original_warranty',
			'seller_warranty',
			'house',
			'diy',
			'counter_genuine',
			'company_goods',
			'parallel_input',
			'billable',
			'receipt',
			'with_guarantee',
			'with_appraisal',
			'size',
			'color'
		];
	}
}