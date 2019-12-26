<?php

namespace common\api\mingletek;

use common\api\HttpResponse;

/**
 * @property string $desc
 * @property string $response
 */
class HelloResponse extends HttpResponse
{
	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'desc' => 'desc',
			'response' => 'response'
		];
	}
}