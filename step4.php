<?php

use common\login\Login;
use common\model\Product;
use common\model\Store;
use common\model\SubPicture;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use Volnix\CSRF\CSRF;
use common\util\HttpUtil;

include 'library.php';

if(!Login::auth() || !UidUtil::auth()){
	HttpUtil::redirect();
}

if($_POST && CSRF::validate($_POST)){
	die();
}

$store = Store::findById($_SESSION["STORE_ID"]);
$product = Product::findByStoreId($_SESSION["STORE_ID"]);
$subPicture = SubPicture::findByStoreId($_SESSION["STORE_ID"]);

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
echo $view->render();