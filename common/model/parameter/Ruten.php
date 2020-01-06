<?php

namespace common\model\parameter;

class Ruten
{
	const SPORTS_AND_LEISURE_DRESS = '200200008';
	const V_NECK = '200200011';
	const NECK_STRAP_DRESS = '200200012';
	const U_DRESS = '200200013';
	const OTHER = '200200006';
	const DRESSES = '200180008';
	const HIGH_WAIST_DRESS = '200200015';

	const RutenType = [
		self::SPORTS_AND_LEISURE_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 運動休閒洋裝',
		self::V_NECK => '流行女裝、內睡衣 -> 洋裝 -> V領/深V洋裝',
		self::NECK_STRAP_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 繞頸綁帶洋裝',
		self::U_DRESS => '流行女裝、內睡衣 -> 洋裝 -> U領/深U洋裝',
		self::OTHER => '流行女裝、內睡衣 -> 洋裝 -> 其他',
		self::DRESSES => '流行女裝、內睡衣 -> 裙子 -> 連身裙、吊帶裙',
		self::HIGH_WAIST_DRESS => '流行女裝、內睡衣 -> 洋裝 -> 高腰洋裝',
	];
}