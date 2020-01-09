<?php

use common\login\Login;
use common\model\parameter\Category;
use common\model\parameter\Collar;
use common\model\parameter\Color;
use common\model\parameter\Fabric;
use common\model\parameter\Feature1;
use common\model\parameter\Feature2;
use common\model\parameter\Feature3;
use common\model\parameter\Feature4;
use common\model\parameter\Feature5;
use common\model\parameter\Keyword;
use common\model\parameter\Neckline;
use common\model\parameter\Size;
use common\model\parameter\Sleeve;
use common\model\parameter\SubCategory;
use common\model\Product;
use common\model\SubPicture;
use common\util\FileUtil;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use Volnix\CSRF\CSRF;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	HttpUtil::redirect();
}

$firstArr = array();
$pictureArr = array();
$subPictureArr = array();
$swiperArr = array();

if ($_POST && CSRF::validate($_POST)) {
	$check = Product::findByIdAndStoreId($_POST['id'], $_SESSION["STORE_ID"]);
	if ($check) {
		$array = array();
		if (isset($_POST['product_description']))
			$array['product_description'] = $_POST['product_description'];
		if (isset($_POST['pchome_category']))
			$array['pchome_category'] = $_POST['pchome_category'];
		if (isset($_POST['ruten_category']))
			$array['ruten_category'] = $_POST['ruten_category'];
		if (isset($_POST['yahoo_category']))
			$array['yahoo_category'] = $_POST['yahoo_category'];
		if (isset($_POST['name']))
			$array['name'] = $_POST['name'];
		if (isset($_POST['price']))
			$array['price'] = $_POST['price'];
		if (isset($_POST['sell_price']))
			$array['sell_price'] = $_POST['sell_price'];
		if (isset($_POST['stock']))
			$array['stock'] = $_POST['stock'];
		if (isset($_POST['is_new']))
			$array['is_new'] = $_POST['is_new'];
		if (isset($_POST['site']))
			$array['site'] = $_POST['site'];
		if (isset($_POST['posting_days']))
			$array['posting_days'] = $_POST['posting_days'];
		if (isset($_POST['sub_category']) && in_array($_POST['sub_category'], SubCategory::SubCategoryType))
			$array['sub_category'] = $_POST['sub_category'];
		if (isset($_POST['sub_category']) && $_POST['sub_category'] == 'custom') {
			$array['sub_category'] = $_POST['sub_category'];
			$array['sub_category_custom_field'] = $_POST['sub_category_custom_field'];
		}
		if (isset($_POST['category']) && in_array($_POST['category'], Category::CategoryType))
			$array['category'] = $_POST['category'];
		if (isset($_POST['fabric'])) {
			$fabricArr = array();
			foreach ($_POST['fabric'] as $key => $val) {
				if (in_array($val, Fabric::FabricType)) {
					$fabricArr[] = $val;
				}
			}
			$array['fabric'] = arrayToString($fabricArr);
		}
		if (isset($_POST['category']) && in_array($_POST['category'], Category::CategoryType))
			$array['category'] = $_POST['category'];
		if (isset($_POST['color'])) {
			$colorArr = array();
			foreach ($_POST['color'] as $key => $val) {
				if (in_array($val, Color::ColorType)) {
					$colorArr[] = $val;
				} else if ($val == 'custom') {
					$colorArr[] = $val;
					if ($_POST['color_custom_field'])
						$array['color_custom_field'] = $_POST['color_custom_field'];
				}
			}
			$array['color'] = arrayToString($colorArr);
		}
		if (isset($_POST['size']) && in_array($_POST['size'], Size::SizeType))
			$array['size'] = $_POST['size'];
		if (isset($_POST['collar']) && in_array($_POST['collar'], Collar::CollarType))
			$array['collar'] = $_POST['collar'];
		if (isset($_POST['collar']) && $_POST['collar'] == 'custom') {
			$array['collar'] = $_POST['collar'];
			$array['collar_custom_field'] = $_POST['collar_custom_field'];
		}
		if (isset($_POST['neckline']) && in_array($_POST['neckline'], Neckline::NecklineType))
			$array['neckline'] = $_POST['neckline'];
		if (isset($_POST['neckline']) && $_POST['neckline'] == 'custom') {
			$array['neckline'] = $_POST['neckline'];
			$array['neckline_custom_field'] = $_POST['neckline_custom_field'];
		}
		if (isset($_POST['sleeve']) && in_array($_POST['sleeve'], Sleeve::SleeveType))
			$array['sleeve'] = $_POST['sleeve'];
		if (isset($_POST['sleeve']) && $_POST['sleeve'] == 'custom') {
			$array['sleeve'] = $_POST['sleeve'];
			$array['sleeve_custom_field'] = $_POST['sleeve_custom_field'];
		}
		if (isset($_POST['feature1'])) {
			$feature1Arr = array();
			foreach ($_POST['feature1'] as $key => $val) {
				if (in_array($val, Feature1::Feature1Type)) {
					$feature1Arr[] = $val;
				} else if ($val == 'custom') {
					$feature1Arr[] = $val;
					if ($_POST['feature1_custom_field'])
						$array['feature_1_custom_field'] = $_POST['feature1_custom_field'];
				}
			}
			$array['feature_1'] = arrayToString($feature1Arr);
		}
		if (isset($_POST['feature2'])) {
			$feature2Arr = array();
			foreach ($_POST['feature2'] as $key => $val) {
				if (in_array($val, Feature2::Feature2Type)) {
					$feature2Arr[] = $val;
				} else if ($val == 'custom') {
					$feature2Arr[] = $val;
					if ($_POST['feature2_custom_field'])
						$array['feature_2_custom_field'] = $_POST['feature2_custom_field'];
				}
			}
			$array['feature_2'] = arrayToString($feature2Arr);
		}
		if (isset($_POST['feature3'])) {
			$feature3Arr = array();
			foreach ($_POST['feature3'] as $key => $val) {
				if (in_array($val, Feature3::Feature3Type)) {
					$feature3Arr[] = $val;
				} else if ($val == 'custom') {
					$feature3Arr[] = $val;
					if ($_POST['feature3_custom_field'])
						$array['feature_3_custom_field'] = $_POST['feature3_custom_field'];
				}
			}
			$array['feature_3'] = arrayToString($feature3Arr);
		}
		if (isset($_POST['feature4']) && in_array($_POST['feature4'], Feature4::Feature4Type))
			$array['feature_4'] = $_POST['feature4'];
		if (isset($_POST['feature4']) && $_POST['feature4'] == 'custom') {
			$array['feature_4'] = $_POST['feature4'];
			$array['feature_4_custom_field'] = $_POST['feature4_custom_field'];
		}
		if (isset($_POST['feature5'])) {
			$feature5Arr = array();
			foreach ($_POST['feature5'] as $key => $val) {
				if (in_array($val, Feature5::Feature5Type)) {
					$feature5Arr[] = $val;
				} else if ($val == 'custom') {
					$feature5Arr[] = $val;
					if ($_POST['feature5_custom_field'])
						$array['feature_5_custom_field'] = $_POST['feature5_custom_field'];
				}
			}
			$array['feature_5'] = arrayToString($feature5Arr);
		}
		if (isset($_POST['keyword'])) {
			$keywordArr = array();
			foreach ($_POST['keyword'] as $key => $val) {
				if (in_array($val, Keyword::KeywordType)) {
					$keywordArr[] = $val;
				} else if ($val == 'custom') {
					$keywordArr[] = $val;
					if ($_POST['keyword_custom_field'])
						$array['keyword_custom_field'] = $_POST['keyword_custom_field'];
				}
			}
			$array['keyword'] = arrayToString($keywordArr);
		}
		Product::modifyProductData($_POST['id'], $array);

		$firstArr = Product::findByIdAndStoreId($_POST['id'], $_SESSION["STORE_ID"]);
		$savePictureArr = array();
		$saveSubPictureArr = array();
		$savePictureArr[$firstArr['picture']]['id'] = $firstArr['id'];
		$savePictureArr[$firstArr['picture']]['img'] = $firstArr['picture'];
		$savePictureArr[$firstArr['picture']]['path'] = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $firstArr['picture']);
		$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $firstArr['id']);
		foreach ($subPicture as $val2) {
			$saveSubPictureArr[$val2['picture']]['id'] = $firstArr['id'];
			$saveSubPictureArr[$val2['picture']]['img'] = $val2['picture'];
			$saveSubPictureArr[$val2['picture']]['path'] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val2['picture']);
		}
		$swiperArr = [
			'picture' => $savePictureArr,
			'subPicture' => $saveSubPictureArr,
		];
	}
}

$product = Product::findByStoreId($_SESSION["STORE_ID"]);

foreach ($product as $val) {
	if (empty($firstArr))
		$firstArr = $val;
	$pictureArr[$val['picture']]['id'] = $val['id'];
	$pictureArr[$val['picture']]['img'] = $val['picture'];
	$pictureArr[$val['picture']]['path'] = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $val['picture']);
	$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $val['id']);
	foreach ($subPicture as $val2) {
		$subPictureArr[$val2['picture']]['id'] = $val['id'];
		$subPictureArr[$val2['picture']]['img'] = $val2['picture'];
		$subPictureArr[$val2['picture']]['path'] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val2['picture']);
	}
	if (empty($swiperArr))
		$swiperArr = [
			'picture' => $pictureArr,
			'subPicture' => $subPictureArr,
		];
}

$data = [
	'first' => $firstArr,
	'picture' => $pictureArr,
	'subPicture' => $subPictureArr,
	'swiper' => $swiperArr
];

var_dump($_SESSION["STORE_ID"], $product);
exit;

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