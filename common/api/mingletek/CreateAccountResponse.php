<?php


namespace common\api\mingletek;


use common\api\HttpResponse;

/**
 * Class CreateAccountResponse
 * @package common\api\mingletek
 * @property string $account
 * @property string $response
 */
class CreateAccountResponse extends HttpResponse
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