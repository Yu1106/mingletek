<?php

namespace common\model\parameter;

/**
 * Class Feature2
 * @package common\model\parameter
 * api傳入欄位名[neckshoulder]
 */
class Feature2
{
	const OFF_THE_SHOULDER = 'Off-the-shoulder';
	const OPEN_SHOULDER = 'openshoulder';
	const STRAPLESS = 'Strapless';
	const CAMISOLE = 'Camisole';

	const Feature2Type = [
		self::OFF_THE_SHOULDER => '一字領',
		self::OPEN_SHOULDER => '挖肩',
		self::STRAPLESS => '無肩帶',
		self::CAMISOLE => '細肩帶'
	];
}