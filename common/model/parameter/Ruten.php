<?php

namespace common\model\parameter;

class Ruten
{
	const THIN_SHOULDER_STRAP = '000200200001';
	const STRAPLESS_DRESS = '000200200002';
	const SLEEVELESS_DRESS = '000200200003';
	const SHORT_SLEEVE_DRESS = '000200200004';
	const LONG_SLEEVE_DRESS = '000200200005';
	const OTHER = '000200200006';
	const SPORTS_AND_LEISURE_DRESS = '000200200008';
	const HALTER_DRESS = '000200200009';
	const BABYDOLL = '000200200010';
	const DEEP_V_DRESS = '000200200011';
	const NECK_STRAP_DRESS = '000200200012';
	const DEEP_U_DRESS = '000200200013';
	const HIGH_WAIST_DRESS = '000200200015';

	const RutenType = [

		self::THIN_SHOULDER_STRAP => '流行女裝、內睡衣 -> 洋裝 -> 細肩帶',
		self::STRAPLESS_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 露肩洋裝',
		self::SLEEVELESS_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 無袖洋裝',
		self::SHORT_SLEEVE_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 短袖洋裝',
		self::LONG_SLEEVE_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 長袖洋裝',
		self::OTHER => '流行女裝、內睡衣 -> 洋裝 -> 其他',

		self::SPORTS_AND_LEISURE_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 運動休閒洋裝',
		self::HALTER_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 露背洋裝',
		self::BABYDOLL => '流行女裝、內睡衣 -> 洋裝 -> 娃娃裝',
		self::DEEP_V_DRESS => '流行女裝、內睡衣 -> 洋裝 -> V領/深V洋裝',
		self::NECK_STRAP_DRESS => '	流行女裝、內睡衣 -> 洋裝 -> 繞頸綁帶洋裝',
		self::DEEP_U_DRESS => '流行女裝、內睡衣 -> 洋裝 -> U領/深U洋裝',

		self::HIGH_WAIST_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 高腰洋裝'
	];
}