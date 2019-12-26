<?php

namespace common\util;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogUtil
{
	private $log;

	public function __construct($file)
	{
		$this->log = new Logger($file);
		$this->log->pushHandler(new StreamHandler(STORAGE_LOG_DIR . "/" . $file . ".txt", Logger::WARNING));
	}

	public function warning($message)
	{
		$this->log->warning($message);
	}

	public function error($message)
	{
		$this->log->error($message);
	}
}