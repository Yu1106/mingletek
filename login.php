<?php

use common\api\mingletek\CheckAccountRecord;
use common\api\mingletek\CreateAccountRecord;
use common\api\mingletek\Mingletek;
use common\login\Login;
use common\model\MingletekApiLog;
use common\sso\LoginInformation;
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

$response = new LoginInformation();
$response->id = '103336381140338';
$response->email = 'lziqovbybc_1574304011@tfbnw.net';
$response->name = 'Sandra Aldciaibhggjh Adeagbostein';

$mingletek = new Mingletek();
$account = $response->email;
$mingletekApiLogId = MingletekApiLog::addLog(0, '', MingletekApiLog::CHECK_ACCOUNT, json_encode($response));
$CheckAccountRecord = new CheckAccountRecord();
$CheckAccountRecord->account = $account;
$check = $mingletek->CheckAccount($CheckAccountRecord);
$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, '', '', json_encode($check));

if (!$check->response) {
	$mingletekApiLogId = MingletekApiLog::addLog(0, '', MingletekApiLog::CREATE_ACCOUNT, json_encode($response));
	$CreateAccountRecord = new CreateAccountRecord();
	$CreateAccountRecord->account = $account;
	$create = $mingletek->CreateAccount($CreateAccountRecord);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, '', '', json_encode($create));
}
if ($check->response || $create->response) {
	$login = new Login($response);
	$login->login();
}

//if (isset($_GET['type']) && CSRF::validate($_GET)) {
//	$sso = new Sso();
//	$sso->login($_GET['type']);
//} else if (isset($_GET['r']) && CSRF::validate($_GET, 'state')) {
//	if ($_GET['r'] == Vendor::FACEBOOK || $_GET['r'] == Vendor::GOOGLE) {
//		if ($_GET['r'] == Vendor::FACEBOOK) {
//			$sso = new Sso();
//			$response = $sso->facebookLoginResponse();
//		} else if ($_GET['r'] == Vendor::GOOGLE) {
//			$sso = new Sso();
//			$response = $sso->GoogleLoginResponse();
//		}
//
//		$mingletek = new Mingletek();
//		$account = $response->email;
//		$mingletekApiLogId = MingletekApiLog::addLog(0, '', MingletekApiLog::CHECK_ACCOUNT, json_encode($response));
//		$CheckAccountRecord = new CheckAccountRecord();
//		$CheckAccountRecord->account = $account;
//		$check = $mingletek->CheckAccount($CheckAccountRecord);
//		$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, '', '', json_encode($check));
//
//		if (!$check->response) {
//			$mingletekApiLogId = MingletekApiLog::addLog(0, '', MingletekApiLog::CREATE_ACCOUNT, json_encode($response));
//			$CreateAccountRecord = new CreateAccountRecord();
//			$CreateAccountRecord->account = $account;
//			$create = $mingletek->CreateAccount($CreateAccountRecord);
//			$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, '', '', json_encode($create));
//		}
//		if ($check->response || $create->response) {
//			$login = new Login($response);
//			$login->login();
//		}else{
//			$log = new LogUtil("login-" . date("Ymd"));
//			$log->warning('social api failed' . json_encode(['check' => $check->response, 'create' => $create->response]));
//			HttpUtil::redirect();
//		}
//	} else {
//		$log = new LogUtil("login-" . date("Ymd"));
//		$log->warning('social failed' . json_encode($_REQUEST));
//		HttpUtil::redirect();
//	}
//} else {
//	HttpUtil::redirect();
//}


