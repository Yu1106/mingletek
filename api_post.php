<?php

use common\api\mingletek\GetProcessDataRecord;
use common\api\mingletek\Mingletek;
use common\api\mingletek\StartProcessRecord;
use common\login\Login;
use common\model\MingletekApiLog;
use common\util\UidUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	exit;
}

ini_set('memory_limit', '2048M');

if ($_POST['action'] == MingletekApiLog::START_PROCESS) {
	var_dump($_POST['action']);
	$mingletek = new Mingletek();
	$StartProcessRecord = new StartProcessRecord();
	$StartProcessRecord->account = $_SESSION['USER_EMAIL'];
	$StartProcessRecord->generate_text = 'yes';
	$StartProcessRecord->session_id = $_SESSION['USER_ID'];
	var_dump($StartProcessRecord);
	$mingletekApiLogId = MingletekApiLog::addLog($_SESSION['USER_ID'], $_SESSION['UID'], MingletekApiLog::START_PROCESS, json_encode($StartProcessRecord));
	$startProcess = $mingletek->StartProcess($StartProcessRecord);
	var_dump($startProcess);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, '', '', json_encode($startProcess));
} else if ($_POST['action'] == MingletekApiLog::GET_PROCESS_DATA) {
	$mingletek = new Mingletek();
	$GetProcessDataRecord = new GetProcessDataRecord();
	$GetProcessDataRecord->account = $_SESSION['USER_EMAIL'];
	$GetProcessDataRecord->session_id = $_SESSION['USER_ID'];
	$mingletekApiLogId = MingletekApiLog::addLog($_SESSION['USER_ID'], $_SESSION['UID'], MingletekApiLog::START_PROCESS, json_encode($GetProcessDataRecord));
	$getProcessData = $mingletek->GetProcessData($GetProcessDataRecord);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, '', '', json_encode($getProcessData));
}

