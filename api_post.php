<?php

use common\login\Login;
use common\model\Store;
use common\util\UidUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	exit;
}

if ($_POST['action'] === 'startProcessData') {
	$uid = UidUtil::uid($_SESSION['USER_ID']);
	$return = Store::modifyUid($_SESSION['STORE_ID'], $uid);
	if ($return)
		echo json_encode(['status' => 1, 'data' => ['account' => $_SESSION['USER_EMAIL'], 'generate_text' => 'yes', 'session_id' => $uid]]);
	else
		echo json_encode(['status' => 0]);
}

