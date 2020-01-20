<?php

use common\csv\vendor\ruten\RutenRecord;
use common\csv\vendor\yahoo\YahooRecord;
use common\login\Login;
use common\model\ExportFileLog;
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

foreach ($storeType as $val) {
	switch ($val) {
		case StoreType::RUTEN:
			if (is_array($product)) {
				$csv = Csv::factory(StoreType::RUTEN);
				$csvThread = $csv->createCsv();
				foreach ($product as $value) {
					$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $value['id']);
					$rutenRecord = new RutenRecord();
					$rutenRecord->category = $value['ruten_category'];
					$rutenRecord->name = $value['name'];
					$rutenRecord->sell_price = $value['price'];
					$rutenRecord->stock = $value['stock'];
					$rutenRecord->custom_category = '5400094';
					$product_description = '';
					if (isset($value['product_description']) && $value['product_description'] != '')
						$product_description .= replaceRN($value['product_description']);
					if (isset($store['note']) && $store['note'] != '')
						$product_description .= "," . replaceRN($store['note']);
					if (isset($store['return_notice']) && $store['return_notice'] != '')
						$product_description .= "," . replaceRN($store['return_notice']);
					$rutenRecord->product_description = $product_description;
					$rutenRecord->is_new = $value['is_new'];
					$rutenRecord->picture_1 = $value['picture'];
					if (isset($subPicture[0]))
						$rutenRecord->picture_2 = $subPicture[0]['picture'];
					if (isset($subPicture[1]))
						$rutenRecord->picture_3 = $subPicture[1]['picture'];
					$rutenRecord->score_greater_than = 0;
					$rutenRecord->score_less_than = '無';
					$rutenRecord->abandoned = '無';
					$rutenRecord->site = $value['site'];
					$rutenRecord->size = $value['size'];
					$rutenRecord->color = $value['color'];
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
				$csvThread = $csv->createCsv();
				foreach ($product as $value) {
					$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $value['id']);
					$yahooRecord = new YahooRecord();
					$yahooRecord->category = $value['yahoo_category'];
					$yahooRecord->name = $value['name'];
					$keyword = '';
					if (isset($value['keyword']))
						$keyword .= $value['keyword'];
					if (isset($value['keyword_custom_field']))
						$keyword .= "," . $value['keyword_custom_field'];
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
					$yahooRecord->keyword = $keyword;
					$product_description = '';
					if (isset($value['product_description']) && $value['product_description'] != '')
						$product_description .= replaceRN($value['product_description']);
					if (isset($store['note']) && $store['note'] != '')
						$product_description .= "," . replaceRN($store['note']);
					if (isset($store['return_notice']) && $store['return_notice'] != '')
						$product_description .= "," . replaceRN($store['return_notice']);
					$yahooRecord->product_description = $product_description;
					$yahooRecord->site = $value['site'];
					$yahooRecord->stock = $value['stock'];
					$yahooRecord->price = $value['price'];
					$yahooRecord->sell_price = $value['sell_price'];
					$yahooRecord->posting_days = $value['posting_days'];
					$yahooRecord->is_new = $value['is_new'];
					$yahooRecord->picture_1 = $value['picture'];
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
				$csvThread = $csv->createCsv();
				foreach ($product as $value) {
					$subPicture = SubPicture::findByStoreIdAndProductId($_SESSION["STORE_ID"], $value['id']);
					$pchomeRecord = new PchomeRecord();
					$pchomeRecord->name = $value['name'];
					$pchomeRecord->category = $value['pchome_category'];
					$pchomeRecord->price = $value['price'];
					$pchomeRecord->sell_price = $value['sell_price'];
					$pchomeRecord->standard = '顏色>尺寸';
					$pchomeRecord->stock = $value['stock'];
					$product_description = '';
					if (isset($value['product_description']) && $value['product_description'] != '')
						$product_description .= replaceRN($value['product_description']);
					if (isset($store['note']) && $store['note'] != '')
						$product_description .= "," . replaceRN($store['note']);
					if (isset($store['return_notice']) && $store['return_notice'] != '')
						$product_description .= "," . replaceRN($store['return_notice']);
					$pchomeRecord->product_description = $product_description;
					$pchomeRecord->is_new = $value['is_new'];
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
		$filePath = FileUtil::CSV . $fileName;
		$array[] = $filePath;
		if ($zip->open($filePath, ZipArchive::CREATE) !== TRUE) {
			exit("cannot open <$filePath>\n");
		}//打開壓縮檔，若無此檔自動建立新檔
		foreach ($exportFileLog as $val) {
			$zip->addFile(FileUtil::CSV . $val['file_name'], $val['file_name']);
			$array[] = FileUtil::CSV . $val['file_name'];
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
		$filePath = FileUtil::CSV . $fileName;
		$csv->exportCvs($fileName);
		if (is_file($filePath))
			unlink($filePath);
		die;
	}
}
die;