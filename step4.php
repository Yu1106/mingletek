<?php

use common\login\Login;
use common\model\Product;
use common\model\Store;
use common\model\SubPicture;
use common\util\FileUtil;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use Volnix\CSRF\CSRF;
use common\util\HttpUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	HttpUtil::redirect();
}

if ($_POST && CSRF::validate($_POST)) {
	die();
}

$store = Store::findById($_SESSION["STORE_ID"]);
$product = Product::findByStoreId($_SESSION["STORE_ID"]);

$pictureArr = array();
$subPictureArr = array();

foreach($product as $val){
	$pictureArr[$val['picture']]['id'] = $val['id'];
	$pictureArr[$val['picture']]['img'] = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $val['picture']);
	$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $val['id']);
	foreach($subPicture as $val2){
		$subPictureArr[$val2['picture']]['id'] = $val['id'];
		$subPictureArr[$val2['picture']]['img'] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val2['picture']);
	}
}

$data = [
	'picture' => $pictureArr,
	'subPicture' => $subPictureArr
];

$view = new View('header');
$view->assign('css', Asset::$step4Css);
$view->assign('js', Asset::$step4Js);
$header = $view->render();
$view = new View('section');
$view->assign('active', 4);
$section = $view->render();
$footer = (new View('footer'))->render();

$view = new View('step4');
$view->assign('header', $header);
$view->assign('section', $section);
$view->assign('footer', $footer);
$view->assign('data', $data);
echo $view->render();