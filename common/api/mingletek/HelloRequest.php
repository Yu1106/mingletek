<?php

namespace common\api\mingletek;

class HelloRequest extends MingletekFactory
{
	public function properties(): array
	{
		return [];
	}

	public function endpointBase(): string
	{
		return 'http://219.91.63.48/';
	}

	protected function endpoint(): string
	{
		return '/mingletek/api/v1.0/hello';
	}

	protected function getResponseClassName(): string
	{
		return 'common\api\mingletek\HelloResponse';
	}
}