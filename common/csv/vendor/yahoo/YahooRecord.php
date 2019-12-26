<?php

namespace common\csv\vendor\yahoo;

use common\PropertyRecord;

/**
 * Class Yahoo
 * @property $title
 * @property $Field1
 * @property $Field2
 * @property $Field3
 * @property $Field4
 * @property $Field5
 */
class YahooRecord extends PropertyRecord
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'title',
			'Field1',
			'Field2',
			'Field3',
			'Field4',
			'Field5'
		];
	}
}