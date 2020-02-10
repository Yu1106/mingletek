<?php

use common\api\mingletek\HousekeepingRecord;
use common\api\mingletek\Mingletek;
use common\login\Login;
use common\model\MingletekApiLog;
use common\model\parameter\Clothes;
use common\model\Store;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use common\util\HttpUtil;
use Volnix\CSRF\CSRF;

include 'library.php';

if (!Login::auth()) {
	HttpUtil::redirect();
}

if ($_POST && CSRF::validate($_POST)) {
	if (isset($_POST['settings_onlineStore'])) {
		$settingsOnlineStoreArr = array();
		foreach ($_POST['settings_onlineStore'] as $key => $val) {
			if (array_key_exists ($val, Clothes::ClothesType)) {
				$settingsOnlineStoreArr[] = $val;
			}
		}
		$settingsOnlineStore = arrayToString($settingsOnlineStoreArr);
	}
	$store = Store::addStore($_SESSION['USER_ID'], $_POST['settings_shop'], $_POST['settings_notice'], $_POST['settings_refund'], $_POST['settings_category'], $settingsOnlineStore);
	UidUtil::setStoreId($store);
	$mingletek = new Mingletek();
	$HousekeepingRecord = new HousekeepingRecord();
	$HousekeepingRecord->account = $_SESSION['USER_EMAIL'];
	$mingletekApiLogId = MingletekApiLog::addLog($_SESSION['USER_ID'], $store, MingletekApiLog::HOUSE_KEEPING, json_encode($HousekeepingRecord));
	$housekeeping = $mingletek->Housekeeping($HousekeepingRecord);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, $store, '', json_encode($housekeeping));
	if ($housekeeping->response) {
		HttpUtil::redirect('step2.php');
		die();
	}
}

UidUtil::unsetStoreId();

$store = Store::findLastOneByUserId($_SESSION["USER_ID"]);

$data = [
	'store' => $store,
];

$view = new View('header');
$view->assign('css', Asset::$stepCss);
$view->assign('js', Asset::$stepJs);
$header = $view->render();
$view = new View('section');
$view->assign('active', 1);
$section = $view->render();
$footer = (new View('footer'))->render();

$view = new View('step1');
$view->assign('header', $header);
$view->assign('section', $section);
$view->assign('footer', $footer);
$view->assign('data', $data);
echo $view->render();