<?php

use common\login\Login;
use common\model\Store;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use common\util\HttpUtil;
use Volnix\CSRF\CSRF;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	HttpUtil::redirect();
}

if ($_POST && CSRF::validate($_POST)) {
//	HttpUtil::redirect('step3.php');
	die();
}

$store = Store::findById($_SESSION["STORE_ID"]);

$view = new View('header');
$view->assign('css', Asset::$stepCss);
$view->assign('js', Asset::$stepJs);
$header = $view->render();
$view = new View('section');
$view->assign('active', 2);
$section = $view->render();
$footer = (new View('footer'))->render();

$view = new View('step2');
$view->assign('header', $header);
$view->assign('section', $section);
$view->assign('footer', $footer);
$view->assign('store', $store);

echo $view->render();