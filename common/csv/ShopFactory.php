<?php

namespace common\csv;

use common\csv\vendor\pchome\PchomeRecord;
use common\csv\vendor\ruten\RutenRecord;
use common\csv\vendor\yahoo\YahooRecord;
use common\model\parameter\Store;
use common\util\CvsUtil;
use common\PropertyRecord;
use common\util\FileUtil;
use common\util\LogUtil;
use Exception;

abstract class ShopFactory extends PropertyRecord
{
	/**
	 * @var RutenRecord|PchomeRecord|YahooRecord
	 */
	protected $data;
	protected $fileName;
	protected $filePath;
	protected $delimiter;
	protected $directory;

	protected function init()
	{
		$this->setFileName();
		$this->filePath = $this->getFilePath($this->fileName);
		$this->delimiter = $this->setDelimiter();
	}

	/**
	 * @return integer
	 */
	abstract protected function shopType(): int;

	protected function setFileName()
	{
		$this->fileName = Store::StoreType[$this->shopType()] . date("YmdHis") . rand(10000, 99999) . ".csv";
	}

	public function setDirectory($directory)
	{
		$this->directory = FileUtil::CSV . $directory . "/";
		if (!file_exists($this->directory))
			mkdir($this->directory, 0777, true);  // 建立目錄
	}

	/**
	 * @return string
	 */
	public function getFileName(): string
	{
		return $this->fileName;
	}

	/**
	 * @param $fileName
	 * @return string
	 */
	protected function getFilePath($fileName): string
	{
		return $this->directory . $fileName;
	}

	/**
	 * @param string $delimiter
	 * @return string
	 */
	protected function setDelimiter($delimiter = ","): string
	{
		return $delimiter;
	}

	/**
	 * @param string $path
	 */
	public function exportCvs(string $path = '')
	{
		try {
			$csv = new CvsUtil(CvsUtil::READ, $this->getFilePath($path));
			$csv->output($path);
		} catch (Exception $e) {
			$log = new LogUtil("export-" . date("Ymd"));
			$log->error('exportCvs failed' . $e);
		}
	}

	/**
	 * @return CvsUtil|mixed
	 */
	public function createCsv()
	{
		try {
			$this->init();
			$array = array();
			foreach ($this->properties() as $k => $v) {
				$array[] = $v;
			}
			$csv = new CvsUtil(CvsUtil::WRITE, $this->filePath, $this->delimiter);
			$csv->insertOne($array);
			return $csv;
		} catch (Exception $e) {
			$log = new LogUtil("export-" . date("Ymd"));
			$log->error('createCsv failed' . $e);
			return false;
		}
	}

	/**
	 * @param CvsUtil $csv
	 */
	public function writeCsv(CvsUtil $csv)
	{
		try {
			$array = array();
			foreach ($this->data->properties() as $k => $v) {
				$array[] = $this->data->$v;
			}
			$csv->insertOne($array);
		} catch (Exception $e) {
			$log = new LogUtil("export-" . date("Ymd"));
			$log->error('writeCsv failed' . $e);
		}
	}

	/**
	 * @param CvsUtil $csv
	 * @param array $data
	 */
	public function writeArrayToCsv(CvsUtil $csv, array $data)
	{
		try {
			$array = array();
			$i = 0;
			foreach ($data as $k => $v) {
				foreach ($this->properties() as $k2 => $v2) {
					$array[$i][$k2] = (isset($v[$k2])) ? $v[$k2] : "";
				}
				$i++;
			}
			$csv->insertAll($array);
		} catch (Exception $e) {
			$log = new LogUtil("export-" . date("Ymd"));
			$log->error('writeArrayToCsv failed' . $e);
		}
	}
}