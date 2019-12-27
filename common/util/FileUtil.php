<?php

namespace common\util;

use Exception;

class FileUtil
{
	const IMG = '/home/mingletek/users/';
	const CSV = '/var/www/mingletek/storage/download/';

	const UPLOAD_DRESS = '/upload_dress';
	const UPLOAD_RELATED_DRESS = '/upload_related_dress';

	public static function mkdir(string $dir)
	{
		try {
			mkdir($dir, 0777, true);
		} catch (Exception $e) {
			$log = new LogUtil("mkdir-" . date("Ymd"));
			$log->error('mkdir failed' . $e);
		}
	}

	public static function rmdir(string $dir)
	{
		try {
			rmdir($dir, true);
		} catch (Exception $e) {
			$log = new LogUtil("rmdir-" . date("Ymd"));
			$log->error('mkdir failed' . $e);
		}
	}
}