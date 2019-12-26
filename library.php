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

