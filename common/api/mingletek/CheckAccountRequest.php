<?php

namespace common\api\mingletek;

use common\util\HttpUtil;

/**
 * Class CheckAccountRequest
 * @package common\api\mingletek
 * @property string account
 */
class CheckAccountRequest extends MingletekFactory
{
	public $method = HttpUtil::METHOD_RAW;

	public function __construct(CheckAccountRecord $data)
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
		return 'is_account_existed';
	}

	protected function getResponseClassName(): string
	{
		return 'common\api\mingletek\CheckAccountResponse';
	}
}