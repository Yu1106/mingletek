<?php

namespace common\model\parameter;

/**
 * Class Neckline
 * @package common\model\parameter
 * api傳入欄位名[neckline]
 */
class Neckline
{
	const V_NECK = 'VNeck';
	const SCOOP = 'Scoop';
	const CREW = 'crew';
	const SQUARE = 'Square';
	const BOAT = 'Boat';

	const NecklineType = [
		self::V_NECK => 'V型領',
		self::SCOOP => '圓領',
		self::CREW => '圓領',
		self::SQUARE => '方型領',
		self::BOAT => '船型領'
	];
}