<?php


namespace common\api\mingletek;


use common\PropertyRecord;

/**
 * Class HousekeepingRecord
 * @package common\api\mingletek
 * @property string $account
 */
class HousekeepingRecord extends PropertyRecord
{
	public function properties(): array
	{
		return [
			'account' => 'account'
		];
	}
}