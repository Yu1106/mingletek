<?php

namespace common\model\parameter;

/**
 * Class Color
 * @package common\model\parameter
 * api傳入欄位名[Colorname]
 */
class Colorspreadcollar
{
	const RED = 'red';
	const YELLOW = 'yellow';
	const GREEN = 'green';
	const ORANGE = 'orange';
	const WHITE = 'white';
	const BLACK = 'black';
	const BLUE = 'blue';
	const VIOLET = 'violet';
	const BROWN = 'brown';
	const CYAN = 'cyan';
	const GREY = 'grey';
	const PINK = 'pink';

	const ColorType = [
		self::RED => '紅色',
		self::YELLOW => '黄色',
		self::GREEN => '绿色',
		self::ORANGE => '橙色',
		self::WHITE => '白色',
		self::BLACK => '黑色',
		self::BLUE => '藍色',
		self::VIOLET => '紫色',
		self::BROWN => '棕色',
		self::CYAN => '青色',
		self::GREY => '灰色',
		self::PINK => '粉红色'
	];
}