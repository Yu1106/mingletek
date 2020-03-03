<?php

use common\file\FileUpload;
use common\file\MultiFileUpload;
use common\login\Login;
use common\model\Product;
use common\model\SubPicture;
use common\util\FileUtil;
use common\util\UidUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	exit;
}

$filePath = (isset($_POST['step']) && $_POST['step'] === 'step2') ? Login::getUserEmail() . FileUtil::UPLOAD_DRESS : Login::getUserEmail() . FileUtil::UPLOAD_RELATED_DRESS;
$storeId = UidUtil::getStoreId();

if ($_POST['action'] === 'validate' && isset($_FILES['file'])) {
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->validate();
	echo json_encode($return);
} else if ($_POST['action'] === 'upload' && $_POST['step'] === 'step2' && isset($_FILES['file'])) {
	Product::delByStoreId($storeId);
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	foreach ($return as $k => $v) {
		if ($v['status'] == 1) {
			$product = Product::findByStoreIdAndPicture($storeId, $v['name']);
			if (isset($product))
				Product::delByStoreIdAndPicture($storeId, $v['name']);
			Product::addProduct($storeId, $v['name']);
		}
	}
	echo json_encode($return);
} else if ($_POST['action'] === 'upload' && $_POST['step'] === 'step3' && isset($_FILES['file'])) {
	SubPicture::delByStoreId($storeId);
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	echo json_encode($return);
} else if ($_POST['action'] === 'upload' && $_POST['step'] === 'step4' && isset($_FILES['file'])) {
	if (empty($_POST['product_id']) && (int)$_POST['product_id'] <= 0)
		die();
	$id = (int)$_POST['product_id'];
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	foreach ($return as $k => $v) {
		if ($v['status'] == 1) {
			$product = SubPicture::findByStoreIdAndProductIdAndPicture($storeId, $id, $v['name']);
			if (isset($product))
				SubPicture::delByStoreIdAndProductIdAndPicture($storeId, $id, $v['name']);
			SubPicture::addSubPicture($storeId, $v['name'], $id, 1);
		}
	}
	echo json_encode($return);
} else if ($_POST['action'] === 'delete' && $_POST['step'] === 'step4' && $_POST['product_id'] != '' && $_POST['image'] != '') {
	SubPicture::delByStoreIdAndProductIdAndPicture($storeId, $_POST['product_id'], $_POST['image']);
	$return = ['status' => 1, 'name' => $_POST['image']];
	echo json_encode($return);
}
