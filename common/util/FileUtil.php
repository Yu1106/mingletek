<?php

namespace common\util;

use Exception;

class FileUtil
{
	const IMG = '/var/www/users/';
	const CSV = '/var/www/mingletek/storage/download/';
	const WEB_PATH = 'https://219.91.63.48/mingletek/storage/upload/users/';

	const UPLOAD_DRESS = '/upload_dress';
	const UPLOAD_RELATED_DRESS = '/upload_related_dress';

	/**
	 * @param string $account
	 * @param string $fileName
	 * @return string
	 */
	public static function getPicturePath(string $account, string $fileName)
	{
		return self::WEB_PATH . $account . self::UPLOAD_DRESS . "/" . $fileName;
	}

	/**
	 * @param string $account
	 * @param string $fileName
	 * @return string
	 */
	public static function getSubPicturePath(string $account, string $fileName)
	{
		return self::WEB_PATH . $account . self::UPLOAD_RELATED_DRESS . "/" . $fileName;
	}

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