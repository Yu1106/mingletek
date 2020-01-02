<?php


namespace common\model\parameter;

/**
 * Class Characteristic3
 * @package common\model\parameter
 * api傳入欄位名[accessory_1]
 */
class Characteristic3
{
	const RUFFLE_SLEEVE = 'rufflesleeve';
	const RUFFLE_SKIRT = 'ruffleskirt';
	const RUFFLE = 'ruffle';

	const Characteristic3Type = [
		self::RUFFLE_SLEEVE => '荷葉袖',
		self::RUFFLE_SKIRT => '荷葉裙',
		self::RUFFLE => '荷葉邊'
	];
}