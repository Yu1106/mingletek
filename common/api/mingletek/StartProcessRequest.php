<?php
namespace common\api\mingletek;

use common\util\HttpUtil;

/**
 * Class StartProcessRequest
 * @package common\api\mingletek
 * @property string $account
 * @property string $generate_text
 * @property string $session_id
 */
class StartProcessRequest extends MingletekFactory
{
	public $method = HttpUtil::METHOD_RAW;

	public function __construct(StartProcessRecord $data)
	{
		parent::__construct();
		$this->account = $data->account;
		$this->generate_text = $data->generate_text;
		$this->session_id = $data->session_id;
	}

	public function properties(): array
	{
		return [
			'account' => 'account',
			'generate_text' => 'generate_text',
			'session_id' => 'session_id'
		];
	}

	protected function endpoint(): string
	{
		return 'longtask';
	}

	protected function getResponseClassName(): string
	{
		return 'common\api\mingletek\StartProcessResponse';
	}
}