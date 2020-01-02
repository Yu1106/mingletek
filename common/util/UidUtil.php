<?php

namespace common\util;

class UidUtil
{
	public static function getStoreId()
	{
		return $_SESSION['STORE_ID'];
	}

	/**
	 * @param int $storeId
	 */
	public static function setStoreId(int $storeId)
	{
		$_SESSION['STORE_ID'] = $storeId;
	}

	public static function unsetStoreId()
	{
		unset($_SESSION['STORE_ID']);
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
		return (isset($_SESSION['STORE_ID'])) ? true : false;
	}
}