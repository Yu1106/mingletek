<?php


namespace common\api\mingletek;

use common\PropertyRecord;

/**
 * Class StartProcessRecord
 * @package common\api\mingletek
 * @property string $account
 * @property string $generate_text
 * @property string $session_id
 */
class StartProcessRecord extends PropertyRecord
{
	public function properties(): array
	{
		return [
			'account' => 'account',
			'generate_text' => 'generate_text',
			'session_id' => 'session_id'
		];
	}
}