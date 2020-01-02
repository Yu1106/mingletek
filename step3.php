<?php

use common\api\mingletek\GetProcessDataRecord;
use common\api\mingletek\Mingletek;
use common\login\Login;
use common\model\MingletekApiLog;
use common\model\Store;
use common\view\Asset;
use common\view\View;
use Volnix\CSRF\CSRF;
use common\util\HttpUtil;

include 'library.php';

if(!Login::auth()){
	HttpUtil::redirect();
}

$store = Store::findById($_SESSION["STORE_ID"]);

if($_POST && CSRF::validate($_POST)){
	$uid = $store['uid'];
	$mingletek = new Mingletek();
	$GetProcessDataRecord = new GetProcessDataRecord();
	$GetProcessDataRecord->account = $_SESSION['USER_EMAIL'];
	$GetProcessDataRecord->session_id = $uid;
	$mingletekApiLogId = MingletekApiLog::addLog($_SESSION['USER_ID'], $_SESSION["STORE_ID"], MingletekApiLog::GET_PROCESS_DATA, json_encode($GetProcessDataRecord));
	$getProcessData = $mingletek->GetProcessData($GetProcessDataRecord);
	var_dump($getProcessData);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, $_SESSION["STORE_ID"], '', json_encode($getProcessData));
	if ($mingletekApiLog) {
//		HttpUtil::redirect('step4.php');
//		die();
	}
}

$view = new View('header');
$view->assign('css', Asset::$stepCss);
$view->assign('js', Asset::$stepJs);
$header = $view->render();
$view = new View('section');
$view->assign('active', 3);
$section = $view->render();
$footer = (new View('footer'))->render();

$view = new View('step3');
$view->assign('header', $header);
$view->assign('section', $section);
$view->assign('footer', $footer);
$view->assign('store', $store);
echo $view->render();