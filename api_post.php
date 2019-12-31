<?php

use common\login\Login;
use common\model\Store;
use common\util\UidUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	exit;
}

if ($_POST['action'] === 'startProcessData') {
	$token = UidUtil::uid($_SESSION['USER_ID']);
	$return = Store::modifyStoreToken($_SESSION['USER_ID'], $_SESSION['UID'], $token);
	if ($return)
		echo json_encode(['status' => 1, 'data' => ['account' => $_SESSION['USER_EMAIL'], 'generate_text' => 'yes', 'session_id' => $token]]);
	else
		echo json_encode(['status' => 0]);
}

