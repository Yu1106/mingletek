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
$uid = UidUtil::getUid();

if ($_POST['action'] === 'validate') {
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->validate();
	echo json_encode($return);
} else if ($_POST['action'] === 'upload' && $_POST['sub'] === '') {
	Product::delByUid($uid);
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	foreach ($return as $k => $v) {
		if ($v['status'] == 1) {
			$product = Product::findByUidAndPicture($uid, $v['name']);
			if (isset($product))
				Product::delByUidAndPicture($uid, $v['name']);
			Product::addProduct($uid, $v['name']);
		}
	}
	echo json_encode($return);
} else if ($_POST['action'] === 'upload' && $_POST['sub'] === 'sub') {
	Subpicture::delByUid($uid);
	$fileUpload = new MultiFileUpload($filePath, $_FILES['file']);
	$return = $fileUpload->upload();
	foreach ($return as $k => $v) {
		if ($v['status'] == 1) {
			$product = Subpicture::findByUidAndPicture($uid, $v['name']);
			if (isset($product))
				Subpicture::delProductByUidAndPicture($uid, $v['name']);
			Subpicture::addSubpicture($uid, $v['name']);
		}
	}
	echo json_encode($return);
}
