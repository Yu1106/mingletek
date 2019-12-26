<?php


namespace common\api\mingletek;

/**
 * Class CheckAccountResponse
 * @package common\api\mingletek
 * @property string $account
 * @property string $response
 */
class CheckAccountResponse
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