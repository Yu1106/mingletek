<?php

namespace common\model\parameter;

class Store
{
	const RUTEN = 0;
	const PCHOME = 1;
	const YAHOO = 2;

	const StoreType = [
		self::RUTEN => 'RUTEN',
		self::PCHOME => 'PCHOME',
		self::YAHOO => 'YAHOO'
	];
}