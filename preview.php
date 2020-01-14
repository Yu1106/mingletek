<?php

use common\login\Login;
use common\model\parameter\Store as StoreType;
use common\model\Product;
use common\model\Store;
use common\model\SubPicture;
use common\util\FileUtil;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use common\util\HttpUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	HttpUtil::redirect();
}
if (!isset($_GET['type']) || !is_numeric($_GET['type']))
	die;
if (!isset($_GET['product_id']) || (int)$_GET['product_id'] <= 0)
	die;

$type = (int)$_GET['type'];
$product_id = (int)$_GET['product_id'];

$store = Store::findById($_SESSION["STORE_ID"]);
$product = Product::findById($product_id);

if (empty($store) || empty($product))
	die;

$pictureArr = array();
$subPictureArr = array();
$swiperArr = array();

if (is_array($product) || is_object($product)) {
	$pictureArr[$product['picture']]['id'] = $product['id'];
	$pictureArr[$product['picture']]['img'] = $product['picture'];
	$pictureArr[$product['picture']]['path'] = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $product['picture']);
	$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $product['id']);
	if (is_array($subPicture) || is_object($subPicture)) {
		foreach ($subPicture as $val2) {
			$subPictureArr[$val2['picture']]['id'] = $product['id'];
			$subPictureArr[$val2['picture']]['img'] = $val2['picture'];
			$subPictureArr[$val2['picture']]['path'] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val2['picture']);
		}
	}
}

$swiperArr = [
	'picture' => $pictureArr,
	'subPicture' => $subPictureArr,
];

$data = [
	'store' => $store,
	'product' => $product,
	'swiper' => $swiperArr,
];

switch ($type) {
	case StoreType::RUTEN:
		$view = new View('ruten');
		$view->assign('css', Asset::$rutenCss);
		$view->assign('js', Asset::$rutenJs);
		$view->assign('data', $data);
		echo $view->render();
		break;
	case StoreType::PCHOME:
		$view = new View('pchome');
		$view->assign('css', Asset::$pchomeCss);
		$view->assign('js', Asset::$pchomeJs);
		$view->assign('data', $data);
		echo $view->render();
		break;
	case StoreType::YAHOO:
		$view = new View('yahoo');
		$view->assign('css', Asset::$yahooCss);
		$view->assign('js', Asset::$yahooJs);
		$view->assign('data', $data);
		echo $view->render();
		break;
	default:
		break;
}

