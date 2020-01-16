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
					if (isset($value['product_description']))
						$product_description .= str_replace(array("\r", "\n", "\r\n", "\n\r"), '', $value['product_description']);
					if (isset($store['note']))
						$product_description .= "," . str_replace(array("\r", "\n", "\r\n", "\n\r"), '', $store['note']);
					if (isset($store['return_notice']))
						$product_description .= "," . str_replace(array("\r", "\n", "\r\n", "\n\r"), '', $store['return_notice']);
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
			$csv = Csv::factory(StoreType::YAHOO);
			$csvThread = $csv->createCsv();
			$yahooRecord = new YahooRecord();
			$yahooRecord->title = 'test';
			$yahooRecord->Field1 = 'test2';
			$yahooRecord->Field2 = 'test3';
			$yahooRecord->Field3 = 'test4';
			$yahooRecord->Field4 = 'test5';
			$csv->setData($yahooRecord);
			$csv->writeCsv($csvThread);
			ExportFileLog::addLog(
				(int)$_SESSION['USER_ID'],
				(int)$_SESSION['STORE_ID'],
				$uid,
				StoreType::YAHOO,
				$csv->getFileName()
			);
			break;
		case StoreType::PCHOME:
			$csv = Csv::factory(StoreType::PCHOME);
			$csvThread = $csv->createCsv();
			$pchomeRecord = new PchomeRecord();
			$pchomeRecord->title = 'test';
			$pchomeRecord->Field1 = 'test2';
			$pchomeRecord->Field2 = 'test3';
			$pchomeRecord->Field3 = 'test4';
			$pchomeRecord->Field4 = 'test5';
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
			unlink($val);
		}
		die;
	} else if (count($exportFileLog) == 1) {
		$fileName = $exportFileLog[0]['file_name'];
		$filePath = FileUtil::CSV . $fileName;
		$csv->exportCvs($fileName);
		unlink($filePath);
		die;
	}
}
die;