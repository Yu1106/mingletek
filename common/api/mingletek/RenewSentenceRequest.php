<?php

namespace common\api\mingletek;

use common\util\HttpUtil;

/**
 * Class RenewSentenceRequest
 * @package common\api\mingletek
 * @property string $strings
 */
class RenewSentenceRequest extends MingletekFactory
{
	public $method = HttpUtil::METHOD_RAW;

	public function __construct(RenewSentenceRecord $data)
	{
		parent::__construct();
		$this->strings = $data->strings;
	}

	public function properties(): array
	{
		return [
			'strings' => 'strings'
		];
	}

	protected function endpoint(): string
	{
		return 'renew_sentences';
	}

	protected function getResponseClassName(): string
	{
		return 'common\api\mingletek\RenewSentenceResponse';
	}
}