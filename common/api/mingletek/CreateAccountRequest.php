<?php


namespace common\api\mingletek;

use common\util\HttpUtil;

/**
 * Class CreateAccountRequest
 * @package common\api\mingletek
 * @property string account
 */
class CreateAccountRequest extends MingletekFactory
{
	public $method = HttpUtil::METHOD_RAW;

	public function __construct(CreateAccountRecord $data)
	{
		parent::__construct();
		$this->account = $data->account;
	}

	public function properties(): array
	{
		return ['account' => 'account'];
	}

	protected function endpoint(): string
	{
		return 'create_account';
	}

	protected function getResponseClassName(): string
	{
		return 'common\api\mingletek\CreateAccountResponse';
	}
}