<?php

namespace common\api\mingletek;

use common\api\HttpRequest;

abstract class MingletekFactory extends HttpRequest
{
	public function endpointBase(): string
	{
		return 'https://www.mingletek.com/';
	}
}