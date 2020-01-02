<?php

namespace common\model\parameter;

/**
 * Class SubCategory
 * @package common\model\parameter
 * api傳入欄位名[sub_category]
 */
class SubCategory
{
	const OVERALL = 'overall';
	const SHIR_DRESS = 'shirdress';
	const SLIP_DRESS = 'slipdress';
	const T_SHIRT_DRESS = 't-shirtdress';

	const SubCategoryType = [
		self::OVERALL => '連身裙',
		self::SHIR_DRESS => '襯衫洋裝',
		self::SLIP_DRESS => '背心裙',
		self::T_SHIRT_DRESS => 'T-Shirt'
	];
}