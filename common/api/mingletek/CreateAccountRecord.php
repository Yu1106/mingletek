<?php


namespace common\api\mingletek;

use common\PropertyRecord;

/**
 * Class CreateAccountRecord
 * @package common\api\mingletek
 * @property string $account
 */
class CreateAccountRecord extends PropertyRecord
{
	public function properties(): array
	{
		return ['account' => 'account'];
	}
}