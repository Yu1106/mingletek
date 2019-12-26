<?php

namespace common\file;

use common\util\LogUtil;
use Exception;

class MultiFileUpload
{
	private $directory;
	private $fileInfo;

	public function __construct(string $directory, $fileInfo)
	{
		$this->directory = $directory;
		$this->fileInfo = $fileInfo;
	}

	/**
	 * @return array|null
	 */
	public function upload(): array
	{
		try {
			$array = array();
			$returnData = array();
			foreach ($this->fileInfo as $key => $val) {
				foreach ($val as $k => $v) {
					$array[$k][$key] = $v;
				}
			}
			foreach ($array as $val) {
				$fileUpload = new FileUpload($this->directory, $val);
				$returnData[] = $fileUpload->upload();
			}
			return $returnData;
		} catch (Exception $e) {
			$log = new LogUtil("upload-" . date("Ymd"));
			$log->error('MultiFileUpload failed' . $e);
		}
		die;
	}

	/**
	 * @return array
	 */
	public function validate(): array
	{
		$array = array();
		$returnData = array();
		foreach ($this->fileInfo as $key => $val) {
			foreach ($val as $k => $v) {
				$array[$k][$key] = $v;
			}
		}
		foreach ($array as $val) {
			$fileUpload = new FileUpload($this->directory, $val);
			$returnData[] = $fileUpload->validate();
		}
		return $returnData;
	}
}
