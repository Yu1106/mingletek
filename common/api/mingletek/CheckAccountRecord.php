<?php


namespace common\api\mingletek;

use common\PropertyRecord;

/**
 * Class CheckAccountRecord
 * @package common\api\mingletek
 * @property string $account
 */
class CheckAccountRecord extends PropertyRecord
{
	public function properties(): array
	{
		return ['account' => 'account'];
	}
}