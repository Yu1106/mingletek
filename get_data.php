<?php

use common\login\Login;
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
	$subPicture = SubPicture::findByStoreIdAndProductId((int)$_SESSION['STORE_ID'], $id);
	if (empty($product))
		die();
	$picture = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $product['picture']);
	$productArr = array();
	$subPictureArr = array();

	foreach ($product as $key => $val) {
		if (!is_numeric($key))
			$productArr[$key] = $val;
	}
	if (is_array($subPicture) || is_object($subPicture)) {
		foreach ($subPicture as $key => $val) {
			$subPictureArr[$val['picture']] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val['picture']);
		}
	}
	if ($product)
		echo json_encode(['status' => 1, 'data' => ['product' => $productArr, 'picture' => $picture, 'sub_picture' => $subPictureArr]]);
	else
		echo json_encode(['status' => 0]);
} else if ($_POST['action'] === 'buildProductDescription' && Login::auth() && UidUtil::auth()) {
	if (empty($_POST['id']) && (int)$_POST['id'] <= 0)
		die();
	$id = (int)$_POST['id'];
	$product = Product::findById($id);
	$analysis = json_decode($product['product_description_analysis'], true);
	$strings = '';
	$data = array();
	foreach ($_POST['data'] as $key => $val) {
		if (array_key_exists($val, $analysis))
			$data[$val] = $analysis[$val];
		else
			$strings .= $val . " ";
	}
	$strings = trim($strings);

	if ($product)
		echo json_encode(['status' => 1, 'data' => ['strings' => $strings, 'data' => $data]]);
	else
		echo json_encode(['status' => 0]);
} else if ($_POST['action'] === 'saveProductDescription' && Login::auth() && UidUtil::auth()) {
	if (empty($_POST['id']) && (int)$_POST['id'] <= 0)
		die();
	$id = (int)$_POST['id'];
	$product = Product::findById($id);
	$string = $_POST['id'];
	var_dump($id, $string);
	if ($product)
		echo json_encode(['status' => 1]);
	else
		echo json_encode(['status' => 0]);
} else {
	echo 'No Data';
}

