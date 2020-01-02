<?php

namespace common\model\parameter;

/**
 * Class Characteristic1
 * @package common\model\parameter
 * api傳入欄位名[texture_1, texture_2, texture_3, pattern]
 */
class Characteristic1
{
	const PRINTING = 'printing';
	const PLEATED = 'pleated';
	const LACE = 'lace';
	const TULLE = 'tulle';
	const DENIM = 'denim';
	const CHIFFON = 'chiffon';

	const Characteristic1Type = [
		self::PRINTING => '印花',
		self::PLEATED => '打摺',
		self::LACE => '蕾絲',
		self::TULLE => '薄紗',
		self::DENIM => '單寧',
		self::CHIFFON => '雪紡'
	];
}