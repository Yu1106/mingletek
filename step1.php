<?php

use common\login\Login;
use common\model\Store;
use common\util\FileUtil;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use common\util\HttpUtil;
use Volnix\CSRF\CSRF;

include 'library.php';

if (!Login::auth()) {
	HttpUtil::redirect();
}

if ($_POST && CSRF::validate($_POST)) {
	$uid = UidUtil::setUid($_SESSION['USER_ID']);
	$store = Store::addStore($_SESSION['USER_ID'], $uid, $_POST['settings_shop'], $_POST['settings_notice'], $_POST['settings_refund'], $_POST['settings_category'], $_POST['settings_onlineStore']);
	FileUtil::mkdir(FileUtil::IMG . $uid);
	FileUtil::mkdir(FileUtil::IMG . $uid . FileUtil::UPLOAD_DRESS);
	FileUtil::mkdir(FileUtil::IMG . $uid . FileUtil::UPLOAD_RELATED_DRESS);
	HttpUtil::redirect('step2.php');
	die();
}

UidUtil::unsetUid();

$view = new View('header');
$view->assign('css', Asset::$stepCss);
$view->assign('js', Asset::$stepJs);
$header = $view->render();
$view = new View('section');
$view->assign('active', 1);
$section = $view->render();
$footer = (new View('footer'))->render();

$view = new View('step1');
$view->assign('header', $header);
$view->assign('section', $section);
$view->assign('footer', $footer);
echo $view->render();