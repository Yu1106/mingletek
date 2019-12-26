<?php

namespace common\api\mingletek;

use common\PropertyRecord;

/**
 * Class GetProcessDataRecord
 * @package common\api\mingletek
 * @property string $account
 * @property string $session_id
 */
class GetProcessDataRecord extends PropertyRecord
{
	public function properties(): array
	{
		return [
			'account' => 'account',
			'session_id' => 'session_id'
		];
	}
}