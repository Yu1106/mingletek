<?php

namespace common\model\parameter;

/**
 * Class Collar
 * @package common\model\parameter
 * api傳入欄位名[collar]
 */
class Collar
{
	const SPREAD_COLLAR = 'spreadcollar';
	const CHINESE_COLLAR = 'chinesecollar';
	const HOOD = 'hood';

	const CollarType = [
		self::SPREAD_COLLAR => '立領',
		self::CHINESE_COLLAR => '立領',
		self::HOOD => '連身帽',
	];
}