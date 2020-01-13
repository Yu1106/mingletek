<?php

use common\api\mingletek\HousekeepingRecord;
use common\api\mingletek\Mingletek;
use common\login\Login;
use common\model\MingletekApiLog;
use common\util\HttpUtil;
use Volnix\CSRF\CSRF;

include 'library.php';

if (!Login::auth()) {
	HttpUtil::redirect();
}

if (CSRF::validate($_GET)) {
	$mingletek = new Mingletek();
	$HousekeepingRecord = new HousekeepingRecord();
	$HousekeepingRecord->account = $_SESSION['USER_EMAIL'];
	$mingletekApiLogId = MingletekApiLog::addLog($_SESSION['USER_ID'], (int)$_SESSION['STORE_ID'], MingletekApiLog::HOUSE_KEEPING, json_encode($HousekeepingRecord));
	$housekeeping = $mingletek->Housekeeping($HousekeepingRecord);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, (int)$_SESSION['STORE_ID'], '', json_encode($housekeeping));
	Login::logout();
	HttpUtil::redirect();
}

