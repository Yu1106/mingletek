<?php

use common\api\mingletek\Mingletek;
use common\api\mingletek\RenewSentenceRecord;
use common\login\Login;
use common\model\MingletekApiLog;
use common\model\Product;
use common\model\Store;
use common\model\SubPicture;
use common\util\FileUtil;
use common\util\UidUtil;

include 'library.php';

if ($_POST['action'] === 'check') {
	echo (Login::auth() && UidUtil::auth()) ? true : false;
} else if ($_POST['action'] === 'startProcessData' && Login::auth() && UidUtil::auth()) {
	$uid = UidUtil::uid($_SESSION['USER_ID']);
	$return = Store::modifyUid($_SESSION['STORE_ID'], $uid);
	if ($return)
		echo json_encode(['status' => 1, 'data' => ['account' => $_SESSION['USER_EMAIL'], 'generate_text' => 'yes', 'session_id' => $uid]]);
	else
		echo json_encode(['status' => 0]);
} else if ($_POST['action'] === 'getProductData' && Login::auth() && UidUtil::auth()) {
	if (empty($_POST['id']) && (int)$_POST['id'] <= 0)
		die();
	$id = (int)$_POST['id'];
	$product = Product::findById($id);
	$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION['STORE_ID'], $id);
	if (empty($product))
		die();
	$picture = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $product['picture']);
	$productArr = array();
	$subPictureArr = array();

	foreach ($product as $key => $val) {
		if (!is_numeric($key))
			$productArr[$key] = $val;
	}
	foreach ($subPicture as $key => $val) {
		$subPictureArr[$val['picture']] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val['picture']);
	}
	if ($product)
		echo json_encode(['status' => 1, 'data' => ['product' => $productArr, 'picture' => $picture, 'sub_picture' => $subPictureArr]]);
	else
		echo json_encode(['status' => 0]);
} else if ($_POST['action'] === 'buildProductDescription' && Login::auth() && UidUtil::auth()) {
	if (empty($_POST['string']) || $_POST['string'] == '')
		die();
	$mingletek = new Mingletek();
	$RenewSentenceRecord = new RenewSentenceRecord();
	$RenewSentenceRecord->strings = $_POST['string'];
	$mingletekApiLogId = MingletekApiLog::addLog($_SESSION['USER_ID'], $_SESSION["STORE_ID"], MingletekApiLog::GET_PROCESS_DATA, json_encode($RenewSentenceRecord));
	$renewSentence = $mingletek->RenewSentence($RenewSentenceRecord);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, $_SESSION["STORE_ID"], '', json_encode($renewSentence));
	var_dump($renewSentence);
//	if ($return)
//		echo json_encode(['status' => 1, 'data' => ['account' => $_SESSION['USER_EMAIL'], 'generate_text' => 'yes', 'session_id' => $uid]]);
//	else
//		echo json_encode(['status' => 0]);
} else {
	echo 'No Data';
}

