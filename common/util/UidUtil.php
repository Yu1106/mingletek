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
		$uid = md5($userId . uniqid());
		$_SESSION['UID'] = $uid;
		return $uid;
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