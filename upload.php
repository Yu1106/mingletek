<?php

use common\file\MultiFileUpload;
use common\login\Login;
use common\model\Product;
use common\model\Subpicture;
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
	Subpicture::delByStoreId($storeId);
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	foreach ($return as $k => $v) {
		if ($v['status'] == 1) {
			$product = Subpicture::findByStoreIdAndPicture($storeId, $v['name']);
			if (isset($product))
				Subpicture::delByStoreIdAndPicture($storeId, $v['name']);
			Subpicture::addSubpicture($storeId, $v['name']);
		}
	}
	echo json_encode($return);
}
