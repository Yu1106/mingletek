<?php

namespace common\util;

use Exception;

class FileUtil
{
	const CSV_DOWNLOAD_PATH = '/var/www/users/';
	const IMG_UPLOAD_PATH = '/var/www/users/';
	const IMG_HTTP_PATH = 'mingletek/storage/upload/users/';

	const UPLOAD_DRESS = '/upload_dress';
	const UPLOAD_RELATED_DRESS = '/upload_related_dress';
	const CSV = '/csv';

	/**
	 * @param string $account
	 * @param string $fileName
	 * @return string
	 */
	public static function getPicturePath(string $account, string $fileName)
	{
		return HttpUtil::WEB_BASIC . self::IMG_HTTP_PATH . $account . self::UPLOAD_DRESS . "/" . $fileName;
	}

	/**
	 * @param string $account
	 * @param string $fileName
	 * @return string
	 */
	public static function getSubPicturePath(string $account, string $fileName)
	{
		return HttpUtil::WEB_BASIC . self::IMG_HTTP_PATH . $account . self::UPLOAD_RELATED_DRESS . "/" . $fileName;
	}

	/**
	 * @param string $account
	 * @param string $fileName
	 * @return string
	 */
	public static function getCsvPath(string $account, string $fileName)
	{
		return HttpUtil::WEB_BASIC . self::CSV_DOWNLOAD_PATH . $account . self::CSV . "/" . $fileName;
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