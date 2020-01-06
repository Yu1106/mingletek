<?php

use common\db\GenericDAO;
use common\login\Login;
use common\model\User;

require __DIR__ . '/vendor/autoload.php';

require_once('config/config.php');

$pdo = GenericDAO::getInstance();

session_start();

if (isset($_SESSION['USER_ID'])) {
	$user = User::exists($_SESSION['USER_ID']);
	if (!$user)
		Login::logout();
}

/**
 * @param array $array
 * @return string
 */
function arrayToString(array $array):string
{
	$returnData = array();
	foreach ($array as $val) {
		if (isset($val))
			$returnData[] = $val;
	}
	$returnData = array_unique($returnData);
	return implode(",", $returnData);
}

