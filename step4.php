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

$firstArr = array();
$pictureArr = array();
$subPictureArr = array();
$swiperArr = array();

$store = Store::findById($_SESSION["STORE_ID"]);

if ($_POST && CSRF::validate($_POST)) {
	$check = Product::findByIdAndStoreId($_POST['id'], $_SESSION["STORE_ID"]);
	if ($check) {
		$array = array();
		$array['is_edit'] = 1;
		if (isset($_POST['product_description']))
			$array['product_description'] = $_POST['product_description'] . "\n";
		if (isset($_POST['pchome_category'])) {
			$array['pchome_category'] = $_POST['pchome_category'];
		} else {
			$array['pchome_category'] = '';
		}
		if (isset($_POST['ruten_category'])) {
			$array['ruten_category'] = $_POST['ruten_category'];
		} else {
			$array['ruten_category'] = '';
		}
		if (isset($_POST['yahoo_category'])) {
			$array['yahoo_category'] = $_POST['yahoo_category'];
		} else {
			$array['yahoo_category'] = '';
		}
		if (isset($_POST['price']))
			$array['price'] = $_POST['price'];
		if (isset($_POST['sell_price']))
			$array['sell_price'] = $_POST['sell_price'];
		if (isset($_POST['stock'])) {
			$stockArr = explode(",", $_POST['stock']);
			$stock = intArrayToString($stockArr);
			$array['stock'] = $stock;
		}
		if (isset($_POST['is_new']))
			$array['is_new'] = $_POST['is_new'];
		if (isset($_POST['site']))
			$array['site'] = $_POST['site'];
		if (isset($_POST['posting_days']))
			$array['posting_days'] = $_POST['posting_days'];
		if (isset($_POST['fabric'])) {
			$fabricArr = array();
			foreach ($_POST['fabric'] as $key => $val) {
				if (in_array($val, Fabric::FabricType)) {
					$fabricArr[] = $val;
				}
			}
			$array['fabric'] = arrayToString($fabricArr);
		} else {
			$array['fabric'] = '';
		}
		if (isset($_POST['size'])) {
			$sizeArr = array();
			foreach ($_POST['size'] as $key => $val) {
				if (in_array($val, Size::SizeType)) {
					$sizeArr[] = $val;
				} else if ($val == 'custom') {
					$sizeArr[] = $val;
					if ($_POST['size_custom_field'])
						$array['size_custom_field'] = $_POST['size_custom_field'];
				}
			}
			$array['size'] = arrayToString($sizeArr);
		}
		/**
		 * name[start]
		 * 賣場名稱→關鍵字→衣領→領口→特色二→袖長→特色一→特色三→特色四→特色五→ 顏色→[次分類|主分類]
		 */
		$name = '';
		// 賣場名稱
		$name .= $store['name'] . "  ";
		// 關鍵字
		if (isset($_POST['keyword'])) {
			$keywordArr = array();
			foreach ($_POST['keyword'] as $key => $val) {
				if (in_array($val, Keyword::KeywordType)) {
					$keywordArr[] = $val;
					$name .= $val;
				} else if ($val == 'custom') {
					$keywordArr[] = $val;
					if ($_POST['keyword_custom_field']) {
						$array['keyword_custom_field'] = $_POST['keyword_custom_field'];
						$name .= $_POST['keyword_custom_field'];
					}
				}
			}
			$array['keyword'] = arrayToString($keywordArr);
		} else {
			$array['keyword'] = '';
			$array['keyword_custom_field'] = '';
		}
		// 衣領
		if (isset($_POST['collar']) && in_array($_POST['collar'], Collar::CollarType)) {
			$array['collar'] = $_POST['collar'];
			$name .= $_POST['collar'];
		} else if (isset($_POST['collar']) && $_POST['collar'] == 'custom') {
			$array['collar'] = $_POST['collar'];
			$array['collar_custom_field'] = $_POST['collar_custom_field'];
			$name .= $_POST['collar_custom_field'];
		} else {
			$array['collar'] = '';
			$array['collar_custom_field'] = '';
		}
		// 領口
		if (isset($_POST['neckline']) && in_array($_POST['neckline'], Neckline::NecklineType)) {
			$array['neckline'] = $_POST['neckline'];
			$name .= $_POST['neckline'];
		} else if (isset($_POST['neckline']) && $_POST['neckline'] == 'custom') {
			$array['neckline'] = $_POST['neckline'];
			$array['neckline_custom_field'] = $_POST['neckline_custom_field'];
			$name .= $_POST['neckline_custom_field'];
		} else {
			$array['neckline'] = '';
			$array['neckline_custom_field'] = '';
		}
		// 特色二
		if (isset($_POST['feature2'])) {
			$feature2Arr = array();
			foreach ($_POST['feature2'] as $key => $val) {
				if (in_array($val, Feature2::Feature2Type)) {
					$feature2Arr[] = $val;
					$name .= $val;
				} else if ($val == 'custom') {
					$feature2Arr[] = $val;
					if ($_POST['feature2_custom_field']) {
						$array['feature_2_custom_field'] = $_POST['feature2_custom_field'];
						$name .= $_POST['feature2_custom_field'];
					}
				}
			}
			$array['feature_2'] = arrayToString($feature2Arr);
		} else {
			$array['feature_2'] = '';
			$array['feature_2_custom_field'] = '';
		}
		// 袖長
		if (isset($_POST['sleeve']) && in_array($_POST['sleeve'], Sleeve::SleeveType)) {
			$array['sleeve'] = $_POST['sleeve'];
			$name .= $_POST['sleeve'];
		}
		if (isset($_POST['sleeve']) && $_POST['sleeve'] == 'custom') {
			$array['sleeve'] = $_POST['sleeve'];
			$array['sleeve_custom_field'] = $_POST['sleeve_custom_field'];
			$name .= $_POST['sleeve_custom_field'];
		}
		// 特色一
		if (isset($_POST['feature1'])) {
			$feature1Arr = array();
			foreach ($_POST['feature1'] as $key => $val) {
				if (in_array($val, Feature1::Feature1Type)) {
					$feature1Arr[] = $val;
					$name .= $val;
				} else if ($val == 'custom') {
					$feature1Arr[] = $val;
					if ($_POST['feature1_custom_field']) {
						$array['feature_1_custom_field'] = $_POST['feature1_custom_field'];
						$name .= $_POST['feature1_custom_field'];
					}
				}
			}
			$array['feature_1'] = arrayToString($feature1Arr);
		} else {
			$array['feature_1'] = '';
			$array['feature_1_custom_field'] = '';
		}
		// 特色三
		if (isset($_POST['feature3'])) {
			$feature3Arr = array();
			foreach ($_POST['feature3'] as $key => $val) {
				if (in_array($val, Feature3::Feature3Type)) {
					$feature3Arr[] = $val;
					$name .= $val;
				} else if ($val == 'custom') {
					$feature3Arr[] = $val;
					if ($_POST['feature3_custom_field']) {
						$array['feature_3_custom_field'] = $_POST['feature3_custom_field'];
						$name .= $_POST['feature3_custom_field'];
					}
				}
			}
			$array['feature_3'] = arrayToString($feature3Arr);
		} else {
			$array['feature_3'] = '';
			$array['feature_3_custom_field'] = '';
		}
		// 特色四
		if (isset($_POST['feature4']) && in_array($_POST['feature4'], Feature4::Feature4Type)) {
			$array['feature_4'] = $_POST['feature4'];
			$name .= $_POST['feature4'];
		} else if (isset($_POST['feature4']) && $_POST['feature4'] == 'custom') {
			$array['feature_4'] = $_POST['feature4'];
			$array['feature_4_custom_field'] = $_POST['feature4_custom_field'];
			$name .= $_POST['feature4_custom_field'];
		} else {
			$array['feature_4'] = '';
			$array['feature_4_custom_field'] = '';
		}
		// 特色五
		if (isset($_POST['feature5'])) {
			$feature5Arr = array();
			foreach ($_POST['feature5'] as $key => $val) {
				if (in_array($val, Feature5::Feature5Type)) {
					$feature5Arr[] = $val;
					$name .= $val;
				} else if ($val == 'custom') {
					$feature5Arr[] = $val;
					if ($_POST['feature5_custom_field']) {
						$array['feature_5_custom_field'] = $_POST['feature5_custom_field'];
						$name .= $_POST['feature5_custom_field'];
					}
				}
			}
			$array['feature_5'] = arrayToString($feature5Arr);
		} else {
			$array['feature_5'] = '';
			$array['feature_5_custom_field'] = '';
		}
		// 顏色
		if (isset($_POST['color']) && in_array($_POST['color'], Color::ColorType)) {
			$array['color'] = $_POST['color'];
			$name .= $_POST['color'];
		}
		if (isset($_POST['color']) && $_POST['color'] == 'custom') {
			$array['color'] = $_POST['color'];
			$array['color_custom_field'] = $_POST['color_custom_field'];
			$name .= $_POST['color_custom_field'];
		}
		// 次分類|主分類
		if (isset($_POST['sub_category']) && in_array($_POST['sub_category'], SubCategory::SubCategoryType)) {
			$array['sub_category'] = $_POST['sub_category'];
			$name .= $_POST['sub_category'];
		} else if (isset($_POST['sub_category']) && $_POST['sub_category'] == 'custom') {
			$array['sub_category'] = $_POST['sub_category'];
			$array['sub_category_custom_field'] = $_POST['sub_category_custom_field'];
			$name .= $_POST['sub_category_custom_field'];
		} else {
			$array['sub_category'] = '';
			$array['sub_category_custom_field'] = '';
		}
		if (isset($_POST['category']) && in_array($_POST['category'], Category::CategoryType)) {
			$array['category'] = $_POST['category'];
			if (isset($_POST['sub_category']) && $_POST['sub_category'] == '') {
				$name .= $_POST['category'];
			}
		} else {
			$array['category'] = '';
		}
		if ($name != '')
			$array['name'] = $name;
		/**
		 * name[end]
		 * 賣場名稱→關鍵字→衣領→領口→特色二→袖長→特色一→特色三→特色四→特色五→ 顏色→[次分類|主分類]
		 */
		Product::modifyProductData($_POST['id'], $array);

		$firstArr = Product::findByIdAndStoreId($_POST['id'], $_SESSION["STORE_ID"]);
		$savePictureArr = array();
		$saveSubPictureArr = array();
		$savePictureArr[$firstArr['picture']]['id'] = $firstArr['id'];
		$savePictureArr[$firstArr['picture']]['is_edit'] = $firstArr['is_edit'];
		$savePictureArr[$firstArr['picture']]['img'] = $firstArr['picture'];
		$savePictureArr[$firstArr['picture']]['path'] = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $firstArr['picture']);
		$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $firstArr['id']);
		if (is_array($subPicture) || is_object($subPicture)) {
			foreach ($subPicture as $val2) {
				$saveSubPictureArr[$val2['picture']]['id'] = $firstArr['id'];
				$saveSubPictureArr[$val2['picture']]['img'] = $val2['picture'];
				$saveSubPictureArr[$val2['picture']]['path'] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val2['picture']);
			}
		}
		$swiperArr = [
			'picture' => $savePictureArr,
			'subPicture' => $saveSubPictureArr,
		];
	}
}

$isUpload = true;
$product = Product::findByStoreId($_SESSION["STORE_ID"]);

if (is_array($product) || is_object($product)) {
	foreach ($product as $val) {
		if (empty($firstArr))
			$firstArr = $val;
		$pictureArr[$val['picture']]['id'] = $val['id'];
		$pictureArr[$val['picture']]['is_edit'] = $val['is_edit'];
		$pictureArr[$val['picture']]['img'] = $val['picture'];
		$pictureArr[$val['picture']]['path'] = FileUtil::getPicturePath($_SESSION['USER_EMAIL'], $val['picture']);
		$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $val['id']);
		if (is_array($subPicture) || is_object($subPicture)) {
			foreach ($subPicture as $val2) {
				$subPictureArr[$val2['picture']]['id'] = $val['id'];
				$subPictureArr[$val2['picture']]['img'] = $val2['picture'];
				$subPictureArr[$val2['picture']]['path'] = FileUtil::getSubPicturePath($_SESSION['USER_EMAIL'], $val2['picture']);
			}
		}
		if (!$val['is_edit'])
			$isUpload = false;
		if (empty($swiperArr))
			$swiperArr = [
				'picture' => $pictureArr,
				'subPicture' => $subPictureArr,
			];
	}
}

$data = [
	'store' => $store,
	'first' => $firstArr,
	'picture' => $pictureArr,
	'subPicture' => $subPictureArr,
	'swiper' => $swiperArr,
	'isUpload' => $isUpload
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