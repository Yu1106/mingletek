<?php

namespace common\csv\vendor\pchome;

use common\PropertyRecord;

/**
 * Class Pchome
 * @property $title
 * @property $Field1
 * @property $Field2
 * @property $Field3
 * @property $Field4
 * @property $Field5
 */
class PchomeRecord extends PropertyRecord
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