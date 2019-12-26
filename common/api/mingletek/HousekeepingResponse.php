<?php


namespace common\api\mingletek;


use common\PropertyRecord;

/**
 * Class HousekeepingResponse
 * @package common\api\mingletek
 * @property string $account
 * @property string $response
 */
class HousekeepingResponse extends PropertyRecord
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'account' => 'account',
			'response' => 'response'
		];
	}
}