<?php

namespace common\csv\vendor\pchome;

use common\PropertyRecord;

/**
 * Class Pchome
 * @property string $name
 * @property string $category
 * @property string $price
 * @property string $sell_price
 * @property string $standard
 * @property string $size_color
 * @property string $stock
 * @property string $description
 * @property string $product_description
 * @property string $is_new
 * @property string $picture
 * @property string $site
 */
class PchomeRecord extends PropertyRecord
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'name',
			'category',
			'price',
			'sell_price',
			'standard',
			'size_color',
			'stock',
			'description',
			'product_description',
			'is_new',
			'picture',
			'site'
		];
	}
}