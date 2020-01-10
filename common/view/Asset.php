<?php

namespace common\view;

class Asset
{
	public static $indexCss = <<<EOF
<link rel="stylesheet" type="text/css" href="resource/css/reset.css">
<link rel="stylesheet" type="text/css" href="resource/css/style.css">
<link rel="stylesheet" type="text/css" href="resource/css/form.css">
<link rel="stylesheet" type="text/css" href="resource/css/jquery.fancybox.min.css">
EOF;

	public static $indexJs = <<<EOF
<script type="text/javascript" src="resource/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="resource/js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="resource/js/script.js"></script>
EOF;

	public static $stepCss = <<<EOF
<link rel="stylesheet" type="text/css" href="resource/css/reset.css">
<link rel="stylesheet" type="text/css" href="resource/css/style.css">
<link rel="stylesheet" type="text/css" href="resource/css/form.css">
<link rel="stylesheet" type="text/css" href="resource/css/jquery.fancybox.min.css">
<link rel="stylesheet" type="text/css" href="resource/css/validationEngine.jquery.css">
EOF;

	public static $stepJs = <<<EOF
<script type="text/javascript" src="resource/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="resource/js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="resource/js/jquery.validationEngine-zh_TW.js"></script>
<script type="text/javascript" src="resource/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="resource/js/script.js"></script>
EOF;

	public static $step4Css = <<<EOF
<link rel="stylesheet" type="text/css" href="resource/css/reset.css">
<link rel="stylesheet" type="text/css" href="resource/css/style.css">
<link rel="stylesheet" type="text/css" href="resource/css/form.css">
<link rel="stylesheet" type="text/css" href="resource/css/jquery.fancybox.min.css">
<link rel="stylesheet" type="text/css" href="resource/css/validationEngine.jquery.css">
<link rel="stylesheet" type="text/css" href="resource/css/swiper.min.css">
EOF;

	static public $step4Js = <<<EOF
<script type="text/javascript" src="resource/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="resource/js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="resource/js/jquery.validationEngine-zh_TW.js"></script>
<script type="text/javascript" src="resource/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="resource/js/swiper.min.js"></script>
<script type="text/javascript" src="resource/js/script.js"></script>
EOF;
}