<?php

namespace common\model\parameter;

class Store
{
	const RUTEN = 0;
	const YAHOO = 1;
	const PCHOME = 2;

	const StoreType = [
		self::RUTEN => 'RUTEN',
		self::YAHOO => 'YAHOO',
		self::PCHOME => 'PCHOME'
	];
}