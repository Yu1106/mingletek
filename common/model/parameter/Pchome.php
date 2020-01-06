<?php

namespace common\model\parameter;

class Pchome
{
	const BABY_DOLL = 'H211513';
	const STRAPLESS_DRESS = 'H000410';
	const HALTER_DRESS = 'H100966';
	const THIN_SHOULDER_STRAP_DRESS = 'H100961';
	const SLEEVELESS_DRESS = 'H100962';
	const SHORT_SLEEVE_DRESS = 'H100963';
	const LONG_SLEEVE_DRESS = 'H100964';
	const V_NECK_DRESS = 'H211514';
	const SPORTS_AND_LEISURE_DRESS = 'H100965';
	const OTHER_STYLE_DRESSES = 'H100967';

	const PchomeType = [
		self::BABY_DOLL => '01.女性服飾 02.洋裝 03.娃娃裝',
		self::STRAPLESS_DRESS => '01.女性服飾 02.洋裝 03.露肩洋裝',
		self::HALTER_DRESS => '01.女性服飾 02.洋裝 03.露背洋裝',
		self::THIN_SHOULDER_STRAP_DRESS => '01.女性服飾 02.洋裝 03.細肩帶洋裝',
		self::SLEEVELESS_DRESS => '01.女性服飾 02.洋裝 03.無袖洋裝',
		self::SHORT_SLEEVE_DRESS => '01.女性服飾 02.洋裝 03.短袖洋裝 ',
		self::LONG_SLEEVE_DRESS => '01.女性服飾 02.洋裝 03.長袖洋裝 ',
		self::V_NECK_DRESS => '01.女性服飾 02.洋裝 03.V領洋裝',
		self::SPORTS_AND_LEISURE_DRESS => '01.女性服飾 02.洋裝 03.運動休閒洋裝',
		self::OTHER_STYLE_DRESSES => '01.女性服飾 02.洋裝 03.其他款式洋裝'
	];
}