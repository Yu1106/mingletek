<?php

use common\view\Asset;
use common\view\View;

include 'library.php';
//session_destroy();
$view = new View('header');
$view->assign('css', Asset::$indexCss);
$view->assign('js', Asset::$indexJs);
$header = $view->render();
$footer = (new View('footer'))->render();

$view = new View('index');
$view->assign('header', $header);
$view->assign('footer', $footer);
echo $view->render();
