<?php

namespace common\model\parameter;

/**
 * Class SubCategory
 * @package common\model\parameter
 * api傳入欄位名[sub_category]
 */
class SubCategory
{
	const T_SHIRT_DRESS = 't-shirtdress';
	const SLIP_DRESS = 'slipdress';
	const SHIRT_DRESS = 'shirtdress';
	const OVERALL = 'overall';
	const CAP_T = 'cap-t';

	const SubCategoryType = [
		self::T_SHIRT_DRESS => 'T-Shirt',
		self::SLIP_DRESS => '背心裙',
		self::SHIRT_DRESS => '襯衫洋裝',
		self::OVERALL => '連身裙',
		self::CAP_T => '帽T'
	];
}