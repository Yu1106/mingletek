<?php

namespace common\util;

class UidUtil
{
	public static function getUid()
	{
		return $_SESSION['UID'];
	}

	/**
	 * @param int $userId
	 * @return string
	 */
	public static function setUid(int $userId)
	{
		$uid = self::uid($userId);
		$_SESSION['UID'] = $uid;
		return $uid;
	}

	public static function uid(int $userId)
	{
		return md5($userId . uniqid());
	}

	/**
	 * @return bool
	 */
	public static function auth()
	{
		return (isset($_SESSION['UID'])) ? true : false;
	}

	/**
	 * @return bool
	 */
	public static function unsetUid()
	{
		unset($_SESSION['UID']);
	}
}