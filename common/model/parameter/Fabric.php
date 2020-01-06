<?php

namespace common\model\parameter;

class Fabric
{
	const POLYESTER = 'polyester';
	const COTTON = 'cotton';
	const LINEN = 'linen';
	const ELASTIC_FIBER = 'elastic_fiber';
	const WOOL = 'wool';

	const FabricType = [
		self::POLYESTER => '聚酯纖維',
		self::COTTON => '棉',
		self::LINEN => '麻',
		self::ELASTIC_FIBER => '彈性纖維',
		self::WOOL => '羊毛'
	];
}