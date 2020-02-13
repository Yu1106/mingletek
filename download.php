<?php

use common\csv\vendor\ruten\RutenRecord;
use common\csv\vendor\yahoo\YahooRecord;
use common\login\Login;
use common\model\ExportFileLog;
use common\model\parameter\Site;
use common\model\Product;
use common\model\Store;
use common\model\SubPicture;
use common\util\CvsUtil;
use common\util\FileUtil;
use common\util\LogUtil;
use common\util\UidUtil;
use common\csv\Csv;
use common\csv\vendor\pchome\PchomeRecord;
use common\model\parameter\Store as StoreType;

include 'library.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!Login::auth() || !UidUtil::auth()) {
	exit;
}

$store = Store::findById($_SESSION["STORE_ID"]);
if (empty($store))
	die;

$storeType = explode(",", $store['upload_store_type']);
$uid = UidUtil::uid($_SESSION['USER_ID']);
$product = Product::findByStoreId($_SESSION["STORE_ID"]);
$email = $_SESSION['USER_EMAIL'];

foreach ($storeType as $val) {
	switch ($val) {
		case StoreType::RUTEN:
			if (is_array($product)) {
				$csv = Csv::factory(StoreType::RUTEN);
				$csv->setDirectory($email);
				$csvThread = $csv->createCsv();
				foreach ($product as $value) {
					$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $value['id']);
					$rutenRecord = new RutenRecord();
					$rutenRecord->category = $value['ruten_category'];
					$rutenRecord->name = $value['name'];
					$rutenRecord->sell_price = $value['price'];
					$stockArr = explode(",", $value['stock']);
					$rutenRecord->stock = array_sum($stockArr);
					$rutenRecord->custom_category = '5400094';
					$product_description = '';
					if (isset($value['product_description']) && $value['product_description'] != '')
						$product_description .= $value['product_description'];
					if (isset($store['note']) && $store['note'] != '')
						$product_description .= "\n" . $store['note'];
					if (isset($store['return_notice']) && $store['return_notice'] != '')
						$product_description .= "\n" . $store['return_notice'];
					$rutenRecord->product_description = $product_description;
					$isNew = ($value['is_new'] == '新品') ? "全新" : "二手";
					$rutenRecord->is_new = $isNew;
					$rutenRecord->picture_1 = $value['picture'];
					if (isset($subPicture[0]))
						$rutenRecord->picture_2 = $subPicture[0]['picture'];
					if (isset($subPicture[1]))
						$rutenRecord->picture_3 = $subPicture[1]['picture'];
					$site = $value['site'];
					if ($value['site'] == Site::GOLDEN_GATE) {
						$site = "金門縣";
					} else if ($value['site'] == Site::MATSU) {
						$site = "連江縣";
					}
					$rutenRecord->site = $site;
					$rutenRecord->score_greater_than = 0;
					$rutenRecord->score_less_than = '無';
					$rutenRecord->abandoned = '無';
					$rutenRecord->size = str_replace("custom", $value['size_custom_field'], $value['size']);
					$rutenRecord->color = str_replace("custom", $value['color_custom_field'], $value['color']);
					$csv->setData($rutenRecord);
					$csv->writeCsv($csvThread);
				}
			}
			ExportFileLog::addLog(
				(int)$_SESSION['USER_ID'],
				(int)$_SESSION['STORE_ID'],
				$uid,
				StoreType::RUTEN,
				$csv->getFileName()
			);
			break;
		case StoreType::YAHOO:
			if (is_array($product)) {
				$csv = Csv::factory(StoreType::YAHOO);
				$csv->setDirectory($email);
				$csvThread = $csv->createCsv();
				foreach ($product as $value) {
					$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $value['id']);
					$yahooRecord = new YahooRecord();
					$yahooRecord->category = $value['yahoo_category'];
					$yahooRecord->name = $value['name'];
					$keyword = '';
					if (isset($value['keyword']))
						$keyword .= $value['keyword'];
					$keywordArr = explode(",", $keyword);
					$keyword = '';
					$i = 1;
					foreach ($keywordArr as $val) {
						if ($i > 1) $keyword .= ",";
						if ($val != '') {
							$keyword .= "#" . $val;
							$i++;
						}
						if ($i == 6) break;
					}
					$yahooRecord->keyword = str_replace("custom", $value['keyword_custom_field'], $keyword);
					$product_description = '';
					if (isset($value['product_description']) && $value['product_description'] != '')
						$product_description .= $value['product_description'];
					if (isset($store['note']) && $store['note'] != '')
						$product_description .= "\n" . $store['note'];
					if (isset($store['return_notice']) && $store['return_notice'] != '')
						$product_description .= "\n" . $store['return_notice'];
					$yahooRecord->product_description = $product_description;
					$yahooRecord->site = $value['site'];
					$stockArr = explode(",", $value['stock']);
					$yahooRecord->stock = '';
					$yahooRecord->price = $value['price'];
					$yahooRecord->sell_price = $value['sell_price'];
					$yahooRecord->posting_days = $value['posting_days'];
					$isNew = ($value['is_new'] == '新品') ? "全新品" : "二手品";
					$yahooRecord->is_new = $isNew;
					$yahooRecord->standard_name = "尺寸";
					$sizeStr = str_replace("custom", $value['size_custom_field'], $value['size']);
					$sizeArr = explode(",", $sizeStr);
					$i = 1;
					if (is_array($sizeArr)) {
						foreach ($sizeArr as $val) {
							$field = 'standard_' . ($i) . '_name';
							$yahooRecord->$field = $val;
							$i++;
						}
					}
					$i = 1;
					if (is_array($stockArr)) {
						foreach ($stockArr as $val) {
							$field = 'standard_' . ($i) . '_quantity';
							$yahooRecord->$field = $val;
							$i++;
						}
					}
					$yahooRecord->home_delivery = 100;
					$yahooRecord->pay_easily_cash = 'yes';
					$yahooRecord->pay_easily_credit_card = 'no';
					$yahooRecord->pay_easily_family_mart = 'no';
					$yahooRecord->pay_easily_seven_eleven = 'no';
					$yahooRecord->pay_easily_cash_on_delivery = 'no';
					$yahooRecord->ct_cash = 'no';
					$yahooRecord->ct_credit_card = 'no';
					$yahooRecord->ct_seven_eleven = 'no';
					$yahooRecord->ct_contract_account = 'no';
					$yahooRecord->ct_union_pay_cards = 'no';
					$yahooRecord->family_mart_freight = 'no';
					$yahooRecord->self_pick = 1;
					$yahooRecord->picture_1 = $value['picture'];
					$yahooRecord->attribute_1 = "內裡/襯-:無內裡";
					$i = 0;
					if (is_array($subPicture)) {
						foreach ($subPicture as $val) {
							$field = 'picture_' . ($i + 2);
							$yahooRecord->$field = $subPicture[$i]['picture'];
							$i++;
						}
					}
					$csv->setData($yahooRecord);
					$csv->writeCsv($csvThread);
				}
			}
			ExportFileLog::addLog(
				(int)$_SESSION['USER_ID'],
				(int)$_SESSION['STORE_ID'],
				$uid,
				StoreType::YAHOO,
				$csv->getFileName()
			);
			break;
		case StoreType::PCHOME:
			if (is_array($product)) {
				$csv = Csv::factory(StoreType::PCHOME);
				$csv->setDirectory($email);
				$csvThread = $csv->createCsv();
				foreach ($product as $value) {
					$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $value['id']);
					$pchomeRecord = new PchomeRecord();
					$pchomeRecord->name = $value['name'];
					$pchomeRecord->category = $value['pchome_category'];
					$pchomeRecord->price = $value['price'];
					$pchomeRecord->sell_price = $value['sell_price'];
					$pchomeRecord->standard = '顏色>尺寸';

					$size_color = '';
					$sizeStr = str_replace("custom", $value['size_custom_field'], $value['size']);
					$sizeArr = explode(",", $sizeStr);
					$color = '';
					$colorStr = str_replace("custom", $value['color_custom_field'], $value['color']);
					$colorArr = explode(",", $colorStr);
					foreach ($colorArr as $val) {
						if ($val != "") {
							$color = $val;
							break;
						}
					}
					$i = 0;
					foreach ($sizeArr as $val) {
						if ($i > 0)
							$size_color .= "\n";
						$size_color .= $color . ">" . $val;
						$i++;
					}
					$pchomeRecord->size_color = $size_color;

					$stock = '';
					$stockArr = explode(",", $value['stock']);
					$i = 0;
					foreach ($stockArr as $val) {
						if ($i > 0)
							$stock .= "\n";
						$stock .= $val;
						$i++;
					}
					$pchomeRecord->stock = $stock;
					$product_description = '';
					if (isset($value['product_description']) && $value['product_description'] != '')
						$product_description .= $value['product_description'];
					if (isset($store['note']) && $store['note'] != '')
						$product_description .= "," . $store['note'];
					if (isset($store['return_notice']) && $store['return_notice'] != '')
						$product_description .= "," . $store['return_notice'];
					$pchomeRecord->product_description = $product_description;
					$isNew = ($value['is_new'] == '新品') ? "全新" : "二手";
					$pchomeRecord->is_new = $isNew;
					$pchomeRecord->picture = $value['picture'];
					$pchomeRecord->site = $value['site'];
					$csv->setData($pchomeRecord);
					$csv->writeCsv($csvThread);
				}
			}
			ExportFileLog::addLog(
				(int)$_SESSION['USER_ID'],
				(int)$_SESSION['STORE_ID'],
				$uid,
				StoreType::PCHOME,
				$csv->getFileName()
			);
			break;
		default:
			break;
	}
}

$exportFileLog = ExportFileLog::findAllByUserIdAndStoreIdAndUid($_SESSION["USER_ID"], $_SESSION["STORE_ID"], $uid);

if (is_array($exportFileLog)) {
	if (count($exportFileLog) > 1) {
		$array = array();
		$zip = new ZipArchive();
		$fileName = date("YmdHis") . rand(10000, 99999) . '-download.zip';
		$filePath = FileUtil::getCsvPath($email, $fileName);
		$array[] = $filePath;
		if ($zip->open($filePath, ZipArchive::CREATE) !== TRUE) {
			exit("cannot open <$filePath>\n");
		}//打開壓縮檔，若無此檔自動建立新檔
		foreach ($exportFileLog as $val) {
			try {
				$path = FileUtil::getCsvPath($email, $val['file_name']);
				$csvNew = new CvsUtil(CvsUtil::READ, $path);
				$content = mb_convert_encoding("UTF-8", "big5", $csvNew->getContent());
				file_put_contents($path, $content);
				$zip->addFile($path, $val['file_name']);
				$array[] = $path;
			} catch (Exception $e) {
				$log = new LogUtil("export-" . date("Ymd"));
				$log->error('exportCvs failed' . $e);
			}
		}
		$zip->close();//關閉壓縮檔
		ExportFileLog::addLog(
			(int)$_SESSION['USER_ID'],
			(int)$_SESSION['STORE_ID'],
			$uid,
			99,
			$fileName
		);
		try {
			$csv = new CvsUtil(CvsUtil::READ, $filePath);
			$csv->output($fileName);
		} catch (Exception $e) {
			$log = new LogUtil("export-" . date("Ymd"));
			$log->error('exportCvs failed' . $e);
		}
		foreach ($array as $val) {
			if (is_file($val))
				unlink($val);
		}
		die;
	} else if (count($exportFileLog) == 1) {
		$fileName = $exportFileLog[0]['file_name'];
		$filePath = FileUtil::getCsvPath($email, $fileName);
		try {
			$csvNew = new CvsUtil(CvsUtil::READ, $filePath);
			$content = mb_convert_encoding("UTF-8", "big5", $csvNew->getContent());
			file_put_contents($filePath, $content);
			$csv = new CvsUtil(CvsUtil::READ, $filePath);
			$csv->output($fileName);
		} catch (Exception $e) {
			$log = new LogUtil("export-" . date("Ymd"));
			$log->error('exportCvs failed' . $e);
		}
		if (is_file($filePath))
			unlink($filePath);
		die;
	}
}
die;