<?php

namespace common\csv\vendor\ruten;

use common\PropertyRecord;

/**
 * Class Ruten
 * @property $category
 * @property $name
 * @property $sell_price
 * @property $stock
 * @property $custom_category
 * @property $product_description
 * @property $is_new
 * @property $picture1
 * @property $picture2
 * @property $picture3
 * @property $site
 * @property $score_greater_than
 * @property $score_less_than
 * @property $abandoned
 * @property $handcraft
 * @property $bag
 * @property $original_warranty
 * @property $seller_warranty
 * @property $house
 * @property $diy
 * @property $counter_genuine
 * @property $company_goods
 * @property $parallel_input
 * @property $billable
 * @property $receipt
 * @property $with_guarantee
 * @property $with_appraisal
 * @property $size
 * @property $color
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
			'picture1',
			'picture2',
			'picture3',
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