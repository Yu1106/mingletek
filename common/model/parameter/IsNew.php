<?php

namespace common\model\parameter;

class IsNew
{
	const NEW = 'new';
	const OLD = 'old';

	const isNewType = [
		self::NEW => '新品',
		self::OLD => '二手'
	];
}