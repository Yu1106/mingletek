<?php

namespace common\csv;

use common\csv\vendor\pchome\Pchome;
use common\csv\vendor\ruten\Ruten;
use common\csv\vendor\yahoo\Yahoo;
use common\model\parameter\Store;

class Csv
{
	/**
	 * @param string $type
	 * @return Pchome|Ruten|Yahoo|mixed
	 */
	public static function factory(string $type)
	{
		switch ($type) {
			case Store::RUTEN:
				return new Ruten();
				break;
			case Store::PCHOME:
				return new Pchome();
				break;
			case Store::YAHOO:
				return new Yahoo();
				break;
			default:
				exit();
		}
	}
}