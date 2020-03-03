<?php

use common\api\mingletek\GetProcessDataRecord;
use common\api\mingletek\Mingletek;
use common\login\Login;
use common\model\MingletekApiLog;
use common\model\parameter\Category;
use common\model\parameter\Collar;
use common\model\parameter\Color;
use common\model\parameter\Feature1;
use common\model\parameter\Feature2;
use common\model\parameter\Feature3;
use common\model\parameter\Feature4;
use common\model\parameter\Feature5;
use common\model\parameter\Neckline;
use common\model\parameter\Pchome;
use common\model\parameter\Ruten;
use common\model\parameter\Sleeve;
use common\model\parameter\SubCategory;
use common\model\parameter\Yahoo;
use common\model\Product;
use common\model\Store;
use common\model\SubPicture;
use common\util\UidUtil;
use common\view\Asset;
use common\view\View;
use Volnix\CSRF\CSRF;
use common\util\HttpUtil;

include 'library.php';

if (!Login::auth() || !UidUtil::auth()) {
	HttpUtil::redirect();
}

$store = Store::findById($_SESSION["STORE_ID"]);

if ($_POST && CSRF::validate($_POST)) {
	$uid = $store['uid'];
	$mingletek = new Mingletek();
	$GetProcessDataRecord = new GetProcessDataRecord();
	$GetProcessDataRecord->account = $_SESSION['USER_EMAIL'];
	$GetProcessDataRecord->session_id = $uid;
	$mingletekApiLogId = MingletekApiLog::addLog($_SESSION['USER_ID'], $_SESSION["STORE_ID"], MingletekApiLog::GET_PROCESS_DATA, json_encode($GetProcessDataRecord));
	$getProcessData = $mingletek->GetProcessData($GetProcessDataRecord);
	$mingletekApiLog = MingletekApiLog::modifyLogById($mingletekApiLogId, $_SESSION["STORE_ID"], '', json_encode($getProcessData));

	if (isset($getProcessData) && count($getProcessData) > 0) {
		foreach ($getProcessData as $data) {
			$product = Product::findByStoreIdAndPicture($_SESSION["STORE_ID"], $data->filename);
			if (isset($product)) {
				for ($i = 1; $i <= 10; $i++) {
					$filename_add = 'filename_add_' . $i;
					$confidence_add = $filename_add.'_confidence';
					if (isset($data->$filename_add)) {
						$subPicture = SubPicture::findByStoreIdAndPicture($_SESSION["STORE_ID"], $data->$filename_add);
						if ($subPicture)
							SubPicture::modifyByStoreIdAndPicture($_SESSION["STORE_ID"], $data->$filename_add, $product['id'], $data->$confidence_add);
					}
				}
				$array = array();
				if (isset($data->sleeve)) {
					if ($data->sleeve == Sleeve::SLEEVELESS || $data->sleeve == Sleeve::CAP)
						$rutenCategory = Ruten::SLEEVELESS_DRESS;
					if ($data->sleeve == Sleeve::SHORT || $data->sleeve == Sleeve::ELBOW)
						$rutenCategory = Ruten::SHORT_SLEEVE_DRESS;
					if ($data->sleeve == Sleeve::BRACELET || $data->sleeve == Sleeve::LONG)
						$rutenCategory = Ruten::LONG_SLEEVE_DRESS;
					if ($rutenCategory != '')
						$array['ruten_category'] = $rutenCategory;
				}
				if (isset($data->sleeve)) {
					if ($data->sleeve == Sleeve::SLEEVELESS || $data->sleeve == Sleeve::CAP)
						$yahooCategory = Yahoo::SLEEVELESS_DRESS;
					if ($data->sleeve == Sleeve::SHORT || $data->sleeve == Sleeve::ELBOW)
						$yahooCategory = Yahoo::SHORT_SLEEVE_DRESS;
					if ($data->sleeve == Sleeve::BRACELET || $data->sleeve == Sleeve::LONG)
						$yahooCategory = Yahoo::LONG_SLEEVE_DRESS;
					if ($yahooCategory != '')
						$array['yahoo_category'] = $yahooCategory;
				}
				if (isset($data->sleeve)) {
					if ($data->sleeve == Sleeve::SLEEVELESS || $data->sleeve == Sleeve::CAP)
						$pchomeCategory = Pchome::SLEEVELESS_DRESS;
					if ($data->sleeve == Sleeve::SHORT || $data->sleeve == Sleeve::ELBOW)
						$pchomeCategory = Pchome::SHORT_SLEEVE_DRESS;
					if ($data->sleeve == Sleeve::BRACELET || $data->sleeve == Sleeve::LONG)
						$pchomeCategory = Pchome::LONG_SLEEVE_DRESS;
					if ($pchomeCategory != '')
						$array['pchome_category'] = $pchomeCategory;
				}
				/**
				 * name[start]
				 * 賣場名稱→關鍵字→衣領→領口→特色二→袖長→特色一→特色三→特色四→特色五→ 顏色→[次分類|主分類]
				 */
				$name = '';
				// 賣場名稱
				$name .= $store['name'] . "  ";
				// 關鍵字 NULL
				// 衣領
				if (isset($data->collar)) {
					$array['collar'] = Collar::CollarType[$data->collar];
					$name .= Collar::CollarType[$data->collar];
				}
				// 領口
				if (isset($data->neckline)) {
					$array['neckline'] = Neckline::NecklineType[$data->neckline];
					$name .= Neckline::NecklineType[$data->neckline];
				}
				// 特色二
				if (isset($data->neckshoulder)) {
					$array['feature_2'] = Feature2::Feature2Type[$data->neckshoulder];
					$name .= Feature2::Feature2Type[$data->neckshoulder];
				}
				// 袖長
				if (isset($data->sleeve)) {
					$array['sleeve'] = Sleeve::SleeveType[$data->sleeve];
					$name .= Sleeve::SleeveType[$data->sleeve];
				}
				// 特色一
				if (isset($data->texture_1) || isset($data->texture_2) || isset($data->texture_3) || isset($data->pattern)) {
					$characteristic1 = array();
					if (isset($data->texture_1)) {
						$characteristic1[] = Feature1::Feature1Type[$data->texture_1];
						$name .= Feature1::Feature1Type[$data->texture_1];
					}
					if (isset($data->texture_2)) {
						$characteristic1[] = Feature1::Feature1Type[$data->texture_2];
						$name .= Feature1::Feature1Type[$data->texture_2];
					}
					if (isset($data->texture_3)) {
						$characteristic1[] = Feature1::Feature1Type[$data->texture_3];
						$name .= Feature1::Feature1Type[$data->texture_3];
					}
					if (isset($data->pattern)) {
						$characteristic1[] = Feature1::Feature1Type[$data->pattern];
						$name .= Feature1::Feature1Type[$data->pattern];
					}
					$array['feature_1'] = implode(",", $characteristic1);
				}
				// 特色三
				if (isset($data->accessory_1)) {
					$array['feature_3'] = Feature3::Feature3Type[$data->accessory_1];
					$name .= Feature3::Feature3Type[$data->accessory_1];
				}
				// 特色四
				if (isset($data->waist)) {
					$array['feature_4'] = Feature4::Feature4Type[$data->waist];
					$name .= Feature4::Feature4Type[$data->waist];
				}
				// 特色五
				if (isset($data->texture_4)) {
					$array['feature_5'] = Feature5::Feature5Type[$data->texture_4];
					$name .= Feature5::Feature5Type[$data->texture_4];
				}
				// 顏色
				if (isset($data->color_name)) {
					$array['color'] = Color::ColorType[$data->color_name];
					$name .= Color::ColorType[$data->color_name];
				}
				// 次分類|主分類
				if (isset($data->sub_category)) {
					$array['sub_category'] = SubCategory::SubCategoryType[$data->sub_category];
					$name .= SubCategory::SubCategoryType[$data->sub_category];
				}
				if (isset($data->category)) {
					$array['category'] = Category::CategoryType[$data->category];
					if (!isset($data->sub_category)) {
						$name .= Category::CategoryType[$data->category];
					}
				}
				if ($name != '')
					$array['name'] = $name;
				/**
				 * name[end]
				 * 賣場名稱→關鍵字→衣領→領口→特色二→袖長→特色一→特色三→特色四→特色五→ 顏色→[次分類|主分類]
				 */
				if (isset($data->collar_desc) || isset($data->neckline_desc) || isset($data->neckshoulder_desc) || isset($data->sleeve_desc)
					|| isset($data->accessory_1_desc) || isset($data->pattern_desc) || isset($data->waist_desc) || isset($data->texture_1_desc)
					|| isset($data->texture_2_desc) || isset($data->texture_3_desc) || isset($data->texture_4_desc)) {
					$productDescription = array();
					if (isset($data->collar_desc) && $data->collar_desc != "")
						$productDescription[] = $data->collar_desc;
					if (isset($data->neckline_desc) && $data->neckline_desc != "")
						$productDescription[] = $data->neckline_desc;
					if (isset($data->neckshoulder_desc) && $data->neckshoulder_desc != "")
						$productDescription[] = $data->neckshoulder_desc;
					if (isset($data->sleeve_desc) && $data->sleeve_desc != "")
						$productDescription[] = $data->sleeve_desc;
					if (isset($data->accessory_1_desc) && $data->accessory_1_desc != "")
						$productDescription[] = $data->accessory_1_desc;
					if (isset($data->pattern_desc) && $data->pattern_desc != "")
						$productDescription[] = $data->pattern_desc;
					if (isset($data->waist_desc) && $data->waist_desc != "")
						$productDescription[] = $data->waist_desc;
					if (isset($data->texture_1_desc) && $data->texture_1_desc != "")
						$productDescription[] = $data->texture_1_desc;
					if (isset($data->texture_2_desc) && $data->texture_2_desc != "")
						$productDescription[] = $data->texture_2_desc;
					if (isset($data->texture_3_desc) && $data->texture_3_desc != "")
						$productDescription[] = $data->texture_3_desc;
					if (isset($data->texture_4_desc) && $data->texture_4_desc != "")
						$productDescription[] = $data->texture_4_desc;
					$array['product_description'] = implode("\n", $productDescription);
				}
				$productDescriptionAnalysis = array();
				if (isset($data->collar) && isset($data->collar_desc) && $data->collar_desc != "")
					$productDescriptionAnalysis[Collar::CollarType[$data->collar]] = $data->collar_desc;
				if (isset($data->neckline) && isset($data->neckline_desc) && $data->neckline_desc != "")
					$productDescriptionAnalysis[Neckline::NecklineType[$data->neckline]] = $data->neckline_desc;
				if (isset($data->sleeve) && isset($data->sleeve_desc) && $data->sleeve_desc != "")
					$productDescriptionAnalysis[Sleeve::SleeveType[$data->sleeve]] = $data->sleeve_desc;
				if (isset($data->texture_1) && isset($data->texture_1_desc) && $data->texture_1_desc != "")
					$productDescriptionAnalysis[Feature1::Feature1Type[$data->texture_1]] = $data->texture_1_desc;
				if (isset($data->texture_2) && isset($data->texture_2_desc) && $data->texture_2_desc != "")
					$productDescriptionAnalysis[Feature1::Feature1Type[$data->texture_2]] = $data->texture_2_desc;
				if (isset($data->texture_3) && isset($data->texture_3_desc) && $data->texture_3_desc != "")
					$productDescriptionAnalysis[Feature1::Feature1Type[$data->texture_3]] = $data->texture_3_desc;
				if (isset($data->pattern) && isset($data->pattern_desc) && $data->pattern_desc != "")
					$productDescriptionAnalysis[Feature1::Feature1Type[$data->pattern]] = $data->pattern_desc;
				if (isset($data->neckshoulder) && isset($data->neckshoulder_desc) && $data->neckshoulder_desc != "")
					$productDescriptionAnalysis[Feature2::Feature2Type[$data->neckshoulder]] = $data->neckshoulder_desc;
				if (isset($data->accessory_1) && isset($data->accessory_1_desc) && $data->accessory_1_desc != "")
					$productDescriptionAnalysis[Feature3::Feature3Type[$data->accessory_1]] = $data->accessory_1_desc;
				if (isset($data->waist) && isset($data->waist_desc) && $data->waist_desc != "")
					$productDescriptionAnalysis[Feature4::Feature4Type[$data->waist]] = $data->waist_desc;
				if (isset($data->texture_4) && isset($data->texture_4_desc) && $data->texture_4_desc != "")
					$productDescriptionAnalysis[Feature5::Feature5Type[$data->texture_4]] = $data->texture_4_desc;
				$array['product_description_analysis'] = json_encode($productDescriptionAnalysis);
				Product::modifyProductData($product['id'], $array);
			}
		}
	}
	if ($mingletekApiLog) {
		HttpUtil::redirect('step4.php');
		die();
	}
}

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