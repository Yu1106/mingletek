<!DOCTYPE html>
<html>
<head>
    <title>MINGLETEK</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">

    <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo RESOURCE_IMAGES_DIR ?>/favicon.ico">
    <!-- CSS -->
    <?= $css ?>
    <!-- Script -->
	<?= $js ?>
</head>
<body>
<div class="wrapper">
    <header class="fixed">
        <a href="index.php"><img id="logo" src="<?php echo RESOURCE_IMAGES_DIR ?>/logo.png" alt="logo"></a>
        <nav class="mainNav">
            <ul class="navList clearfix">
				<?php if (\common\login\Login::auth()) { ?>
                    <li class="navItem">
                        <a class="navLink logout" href="index.php">
                            <span class="nickname"><?php echo $_SESSION["USER_NAME"] ?> 您好</span>
                            <i class="icon-user"></i>
                        </a>
                    </li>
				<?php } else { ?>
                    <li class="navItem">
                        <a class="navLink" href="#loginBox" data-fancybox>快速上架</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink scrollTrigger" href="javascript:;" data-target="anchorServiceIntro">服務介紹</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink scrollTrigger" href="javascript:;"
                           data-target="anchorAssistUploading">使用說明</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink login" href="#loginBox" data-fancybox>
                            <i class="icon-user"></i>
                        </a>
                    </li>
				<?php } ?>
            </ul>
        </nav>
        <div id="loginBox" class="fancybox-content lightBox">
            <h4>請選擇登入方式</h4>
            <a href="login.php?type=facebook&<?= \Volnix\CSRF\CSRF::getQueryString() ?>" class="btnLoginFb"></a>
            <a href="login.php?type=google&<?= \Volnix\CSRF\CSRF::getQueryString() ?>" class="btnLoginGoogle"></a>
        </div>
    </header>