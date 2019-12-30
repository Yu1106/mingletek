<?php

use common\login\Login;
use common\util\UidUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	exit;
}

if ($_POST['action'] === 'startProcessData') {
	echo json_encode(['account' => $_SESSION['USER_EMAIL'], 'generate_text' => 'yes', 'session_id' => $_SESSION['UID']]);
}

