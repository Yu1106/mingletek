<?php

namespace common\model\parameter;

/**
 * Class Category
 * @package common\model\parameter
 * api傳入欄位名[category]
 */
class Category
{
	const COAT = 'coat';
	const FULL_BODY = 'fullbody';
	const SKIRT = 'skirt';
	const PANTS = 'pants';

	const CategoryType = [
		self::COAT => '上衣',
		self::FULL_BODY => '洋裝',
		self::SKIRT => '裙子',
		self::PANTS => '褲子'
	];
}