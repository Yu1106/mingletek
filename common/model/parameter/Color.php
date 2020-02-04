<?php

namespace common\model\parameter;

/**
 * Class Color
 * @package common\model\parameter
 * api傳入欄位名[color_name]
 */
class Color
{
	const RED = 'red';
	const ORANGE = 'orange';
	const YELLOW = 'yellow';
	const GREEN = 'green';
	const BLUE = 'blue';
	const VIOLET = 'violet';
	const WHITE = 'white';
	const BLACK = 'black';
	const NUDE = 'nude';
	const GREY = 'grey';
	const PINK = 'pink';
	const BROWN = 'brown';
	const CYAN = 'cyan';

	const ColorType = [
		self::RED => '紅色',
		self::ORANGE => '橘色',
		self::YELLOW => '黄色',
		self::GREEN => '绿色',
		self::BLUE => '藍色',
		self::VIOLET => '紫色',
		self::WHITE => '白色',
		self::BLACK => '黑色',
		self::NUDE => '膚色',
		self::GREY => '灰色',
		self::PINK => '粉色',
		self::BROWN => '棕色',
		self::CYAN => '青色'
	];

	const ColorLBClass = [
		self::RED => 'lbRed',
		self::ORANGE => 'lbOrange',
		self::YELLOW => 'lbYellow',
		self::GREEN => 'lbGreen',
		self::BLUE => 'lbBlue',
		self::VIOLET => 'lbPurple',
		self::WHITE => 'lbWhite',
		self::BLACK => 'lbBlack',
		self::NUDE => 'lbNude',
		self::GREY => 'lbGrey',
		self::PINK => 'lbPink',
		self::BROWN => 'lbBrown',
		self::CYAN => 'lbCyan'
	];
}