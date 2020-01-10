<?php

use common\login\Login;
use common\util\HttpUtil;
use Volnix\CSRF\CSRF;

include 'library.php';

if (!Login::auth()) {
	HttpUtil::redirect();
}

if (CSRF::validate($_GET)) {
	Login::logout();
	HttpUtil::redirect();
}

