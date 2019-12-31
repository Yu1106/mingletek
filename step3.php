<?php

use common\login\Login;
use common\model\Store;
use common\view\Asset;
use common\view\View;
use Volnix\CSRF\CSRF;
use common\util\HttpUtil;

include 'library.php';

if(!Login::auth()){
	HttpUtil::redirect();
}

if($_POST && CSRF::validate($_POST)){
//	HttpUtil::redirect('step4.php');
	die();
}

$store = Store::findStoreByUserIdAndUid($_SESSION["USER_ID"], $_SESSION["UID"]);

$view = new View('header');
$view->assign('css', Asset::$stepCss);
$view->assign('js', Asset::$stepJs);
$header = $view->render();
$view = new View('section');
$view->assign('active', 3);
$section = $view->render();
$footer = (new View('footer'))->render();

$view = new View('step3');
$view->assign('header', $header);
$view->assign('section', $section);
$view->assign('footer', $footer);
$view->assign('store', $store);
echo $view->render();