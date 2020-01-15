<?php

use common\csv\Csv;
use common\csv\vendor\pchome\PchomeRecord;
use common\model\ExportFileLog;
use common\model\parameter\Store;

include 'library.php';

$csv = Csv::factory(Store::PCHOME);
$csvThread = $csv->createCsv();
var_dump($csvThread);
$pchomeRecord = new PchomeRecord();
$pchomeRecord->title = 'test';
$pchomeRecord->Field1 = 'test2';
$pchomeRecord->Field2 = 'test3';
$pchomeRecord->Field3 = 'test4';
$pchomeRecord->Field4 = 'test5';
$csv->setData($pchomeRecord);
$csv->writeCsv($csvThread);
$pchomeRecord->title = '1,2,3';
$pchomeRecord->Field1 = 'test2';
$pchomeRecord->Field2 = 0;
$pchomeRecord->Field3 = NULL;
$pchomeRecord->Field4 = '';
$csv->setData($pchomeRecord);
$csv->writeCsv($csvThread);

$array = array(['Field2' => 1, 'Field3' => 2, 'title' => '測試2,測試2,測試2', 'd' => 4, 'e' => 5], [4, 2, 3, 4, 56, "測試1", "測試2"]);
$csv->writeArrayToCsv($csvThread, $array);

$exportFileLog = ExportFileLog::findOneByUserId($_SESSION["USER_ID"], Store::PCHOME);
$csv->exportCvs($exportFileLog["file_name"]);


die;