<?php

namespace common\model\parameter;

/**
 * Class Sleeve
 * @package common\model\parameter
 * api傳入欄位名[Sleeve]
 */
class Sleeve
{
	const LONG = 'Long';
	const BRACELET = 'Bracelet';
	const ELBOW = 'Elbow';
	const SLEEVELESS = 'Sleeveless';
	const SHORT = 'Short';
	const CAP = 'Cap';

	const SleeveType = [
		self::LONG => '長袖',
		self::BRACELET => '七分袖',
		self::ELBOW => '五分袖',
		self::SLEEVELESS => '無袖',
		self::SHORT => '短袖',
		self::CAP => '蓋袖'
	];
}