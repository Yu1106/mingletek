<?php

use common\login\Login;
use common\sso\Sso;
use common\sso\Vendor;
use common\util\LogUtil;
use common\util\HttpUtil;
use Volnix\CSRF\CSRF;

include 'library.php';

if (empty($_GET['type']) && empty($_GET['r'])) {
	die();
}

if ((isset($_GET['type']) && !in_array($_GET['type'], Vendor::VENDOR_LIST))
	&& (isset($_GET['r']) && !in_array($_GET['r'], Vendor::VENDOR_LIST))) {
	die();
}

if (isset($_GET['type']) && CSRF::validate($_GET)) {
	$sso = new Sso();
	$sso->login($_GET['type']);
} else if (isset($_GET['r']) && CSRF::validate($_GET, 'state')) {
	if ($_GET['r'] == Vendor::FACEBOOK) {
		$sso = new Sso();
		$response = $sso->facebookLoginResponse();
		$login = new Login($response);
		$login->login();
	} else if ($_GET['r'] == Vendor::GOOGLE) {
		$sso = new Sso();
		$response = $sso->GoogleLoginResponse();
		$login = new Login($response);
		$login->login();
	} else {
		$log = new LogUtil("login-" . date("Ymd"));
		$log->warning('social failed' . json_encode($_REQUEST));
		HttpUtil::redirect();
	}
} else {
	HttpUtil::redirect();
}


