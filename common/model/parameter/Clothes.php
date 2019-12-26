<?php

namespace common\model\parameter;

class Clothes
{
	const DRESS = 0;
	const CLOTHES = 1;
	const PANTS = 2;
	const SKIRT = 3;

	const ClothesType = [
		self::DRESS => '洋裝',
		self::CLOTHES => '衣服',
		self::PANTS => '褲子',
		self::SKIRT => '裙子'
	];
}