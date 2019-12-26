<?php

namespace common\csv\vendor\pchome;

use common\csv\ShopFactory;
use common\model\parameter\Store;

class Pchome extends ShopFactory
{
	/**
	 * @param PchomeRecord $data
	 */
	public function setData(PchomeRecord $data)
	{
		$this->data = $data;
	}

	/**
	 * @return int
	 */
	public function shopType(): int
	{
		return Store::PCHOME;
	}

	/**
	 * @return array
	 */
	public function properties(): array
	{
		return [
			'title' => '標頭',
			'Field1' => '欄位1',
			'Field2' => '欄位2',
			'Field3' => '欄位3',
			'Field4' => '欄位4',
			'Field5' => '欄位5',
		];
	}
}