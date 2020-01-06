<?php

namespace common\model\parameter;

/**
 * Class Feature4
 * @package common\model\parameter
 * api傳入欄位名[waist]
 */
class Feature4
{
	const TIE_WAIST = 'tiewaist';
	const DRAWSTRING = 'drawstring';
	const BELT = 'belt';
	const ELASTICIZED_WAIST = 'elasticizedwaist';

	const Feature4Type = [
		self::TIE_WAIST => '繫繩',
		self::DRAWSTRING => '抽繩',
		self::BELT => '皮帶',
		self::ELASTICIZED_WAIST => '鬆緊帶'
	];
}