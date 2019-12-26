<?php


namespace common\api\mingletek;

use common\PropertyRecord;

/**
 * Class RenewSentenceResponse
 * @package common\api\mingletek
 * @property string $current
 * @property string $status
 * @property string $total
 * @property string $done
 * @property string $result
 */
class RenewSentenceResponse extends PropertyRecord
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'current' => 'current',
			'status' => 'status',
			'total' => 'total',
			'done' => 'done',
			'result' => 'result'
		];
	}
}