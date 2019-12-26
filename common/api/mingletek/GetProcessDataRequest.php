<?php
namespace common\api\mingletek;

use common\util\HttpUtil;

/**
 * Class GetProcessDataRequest
 * @package common\api\mingletek
 * @property string $account
 * @property string $session_id
 */
class GetProcessDataRequest extends MingletekFactory
{
	public $method = HttpUtil::METHOD_RAW;

	public function __construct(GetProcessDataRecord $data)
	{
		parent::__construct();
		$this->account = $data->account;
		$this->session_id = $data->session_id;
	}

	public function properties(): array
	{
		return [
			'account' => 'account',
			'session_id' => 'session_id',
		];
	}

	protected function endpoint(): string
	{
		return 'get_results';
	}

	protected function getResponseClassName(): string
	{
		return 'common\api\mingletek\GetProcessDataResponse';
	}
}