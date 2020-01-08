<?php

use common\file\MultiFileUpload;
use common\login\Login;
use common\model\Product;
use common\model\SubPicture;
use common\util\FileUtil;
use common\util\UidUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth() || empty($_FILES['file'])) {
	exit;
}

$filePath = (empty($_POST['sub'])) ? Login::getUserEmail() . FileUtil::UPLOAD_DRESS : Login::getUserEmail() . FileUtil::UPLOAD_RELATED_DRESS;
$storeId = UidUtil::getStoreId();

if ($_POST['action'] === 'validate') {
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->validate();
	echo json_encode($return);
} else if ($_POST['action'] === 'upload' && $_POST['sub'] === '') {
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
} else if ($_POST['action'] === 'upload' && $_POST['sub'] === 'sub') {
	SubPicture::delByStoreId($storeId);
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	foreach ($return as $k => $v) {
		if ($v['status'] == 1) {
			$product = SubPicture::findByStoreIdAndPicture($storeId, $v['name']);
			if (isset($product))
				SubPicture::delByStoreIdAndPicture($storeId, $v['name']);
			SubPicture::addSubPicture($storeId, $v['name']);
		}
	}
	echo json_encode($return);
} else if ($_POST['action'] === 'upload' && $_POST['sub'] === 'swiper') {
	if (empty($_POST['product_id']) && (int)$_POST['product_id'] <= 0)
		die();
	$id = (int)$_POST['product_id'];
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	foreach ($return as $k => $v) {
		if ($v['status'] == 1) {
			$product = SubPicture::findByStoreIdAndPicture($storeId, $v['name']);
			if (isset($product))
				SubPicture::delByStoreIdAndPicture($storeId, $v['name']);
			SubPicture::addSubPicture($storeId, $v['name'], $id);
		}
	}
	echo json_encode($return);
}
