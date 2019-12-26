<?php

namespace common\api\mingletek;

use common\util\HttpUtil;

/**
 * Class HousekeepingRequest
 * @package common\api\mingletek
 * @property string $account
 */
class HousekeepingRequest extends MingletekFactory
{
	public $method = HttpUtil::METHOD_RAW;

	public function __construct(HousekeepingRecord $data)
	{
		parent::__construct();
		$this->account = $data->account;
	}

	public function properties(): array
	{
		return [
			'account' => 'account'
		];
	}

	protected function endpoint(): string
	{
		return 'housekeeping';
	}

	protected function getResponseClassName(): string
	{
		return 'common\api\mingletek\HousekeepingResponse';
	}
}