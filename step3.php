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
use common\model\parameter\Sleeve;
use common\model\parameter\SubCategory;
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
					if (isset($data->$filename_add)) {
						$subPicture = SubPicture::findByStoreIdAndPicture($_SESSION["STORE_ID"], $data->$filename_add);
						if ($subPicture)
							SubPicture::modifyByStoreIdAndPicture($_SESSION["STORE_ID"], $data->$filename_add, $product['id']);
					}
				}
				$array = array();
				if (isset($data->sub_category))
					$array['sub_category'] = SubCategory::SubCategoryType[$data->sub_category];
				if (isset($data->category))
					$array['category'] = Category::CategoryType[$data->category];
				if (isset($data->color_name))
					$array['color'] = Color::ColorType[$data->color_name];
				if (isset($data->collar))
					$array['collar'] = Collar::CollarType[$data->collar];
				if (isset($data->neckline))
					$array['neckline'] = Neckline::NecklineType[$data->neckline];
				if (isset($data->sleeve))
					$array['sleeve'] = Sleeve::SleeveType[$data->sleeve];
				if (isset($data->texture_1) || isset($data->texture_2) || isset($data->texture_3) || isset($data->pattern)) {
					$characteristic1 = array();
					if (isset($data->texture_1))
						$characteristic1[] = Feature1::Feature1Type[$data->texture_1];
					if (isset($data->texture_2))
						$characteristic1[] = Feature1::Feature1Type[$data->texture_2];
					if (isset($data->texture_3))
						$characteristic1[] = Feature1::Feature1Type[$data->texture_3];
					if (isset($data->pattern))
						$characteristic1[] = Feature1::Feature1Type[$data->pattern];
					$array['feature_1'] = implode(",", $characteristic1);
				}
				if (isset($data->neckshoulder))
					$array['feature_2'] = Feature2::Feature2Type[$data->neckshoulder];
				if (isset($data->accessory_1))
					$array['feature_3'] = Feature3::Feature3Type[$data->accessory_1];
				if (isset($data->waist))
					$array['feature_4'] = Feature4::Feature4Type[$data->waist];
				if (isset($data->texture_4))
					$array['feature_5'] = Feature5::Feature5Type[$data->texture_4];
				if (isset($data->collar_desc) || isset($data->neckline_desc) || isset($data->neckshoulder_desc) || isset($data->sleeve_desc)
					|| isset($data->accessory_1_desc) || isset($data->pattern_desc) || isset($data->waist_desc) || isset($data->texture_1_desc)
					|| isset($data->texture_2_desc) || isset($data->texture_3_desc) || isset($data->texture_4_desc)) {
					$productDescription = array();
					if (isset($data->collar_desc))
						$productDescription[] = $data->collar_desc;
					if (isset($data->neckline_desc))
						$productDescription[] = $data->neckline_desc;
					if (isset($data->neckshoulder_desc))
						$productDescription[] = $data->neckshoulder_desc;
					if (isset($data->sleeve_desc))
						$productDescription[] = $data->sleeve_desc;
					if (isset($data->accessory_1_desc))
						$productDescription[] = $data->accessory_1_desc;
					if (isset($data->pattern_desc))
						$productDescription[] = $data->pattern_desc;
					if (isset($data->waist_desc))
						$productDescription[] = $data->waist_desc;
					if (isset($data->texture_1_desc))
						$productDescription[] = $data->texture_1_desc;
					if (isset($data->texture_2_desc))
						$productDescription[] = $data->texture_2_desc;
					if (isset($data->texture_3_desc))
						$productDescription[] = $data->texture_3_desc;
					if (isset($data->texture_4_desc))
						$productDescription[] = $data->texture_4_desc;
					$array['product_description'] = implode("\n", $productDescription);
				}
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