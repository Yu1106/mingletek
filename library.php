<?php

use common\db\GenericDAO;
use common\login\Login;
use common\model\User;
use common\model\UserLoginLog;

require __DIR__ . '/vendor/autoload.php';

require_once('config/config.php');

$pdo = GenericDAO::getInstance();

session_start();

if (isset($_SESSION['USER_ID'])) {
	$user = User::exists($_SESSION['USER_ID']);
	$userLoginLog = UserLoginLog::findByUserIdAndAction($_SESSION['USER_ID'], Login::LOGIN);
	if (!$user || !$userLoginLog)
		Login::logout();
}

