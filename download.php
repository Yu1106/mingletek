<?php

use common\csv\vendor\ruten\RutenRecord;
use common\csv\vendor\yahoo\YahooRecord;
use common\login\Login;
use common\model\ExportFileLog;
use common\model\Store;
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

foreach ($storeType as $val) {
	switch ($val) {
		case StoreType::RUTEN:
			$csv = Csv::factory(StoreType::RUTEN);
			$csvThread = $csv->createCsv();
			$rutenRecord = new RutenRecord();
			$rutenRecord->title = 'test';
			$rutenRecord->Field1 = 'test2';
			$rutenRecord->Field2 = 'test3';
			$rutenRecord->Field3 = 'test4';
			$rutenRecord->Field4 = 'test5';
			$csv->setData($rutenRecord);
			$csv->writeCsv($csvThread);
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
var_dump($exportFileLog);
//	$array = array(['Field2' => 1, 'Field3' => 2, 'title' => '測試2,測試2,測試2', 'd' => 4, 'e' => 5], [4, 2, 3, 4, 56, "測試1", "測試2"]);
//	$csv->writeArrayToCsv($csvThread, $array);
//
//	$exportFileLog = ExportFileLog::findOneByUserId($_SESSION["USER_ID"], Store::PCHOME);

die;