<?php


namespace common\api;

use FilterIterator;
use Iterator;

class IPFilter extends FilterIterator
{
	private $ipFilter = ['127.0.0.1'];

	public function __construct(Iterator $iterator)
	{
		parent::__construct($iterator);
	}

	public function accept()
	{
		$ip = $this->getInnerIterator()->current();
		if (in_array($ip, $this->ipFilter) == 0) {
			return false;
		}
		return true;
	}
}