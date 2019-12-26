<?php

namespace common\api\mingletek;

use common\api\HttpRequest;

abstract class MingletekFactory extends HttpRequest
{
	public function endpointBase(): string
	{
		return 'https://219.91.63.48/';
	}
}