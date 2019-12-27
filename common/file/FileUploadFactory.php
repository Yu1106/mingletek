<?php

namespace common\file;

use common\util\FileUtil;

/**
 * Class FileUploadProtocol
 * @package common\file
 */
abstract class FileUploadFactory
{
	const SUCCESS = 1;
	const FAIL = 0;
	const type = [
		self::SUCCESS => '成功',
		self::FAIL => '失敗',
	];

	const MSG = [
		UPLOAD_ERR_OK => '沒有錯誤發生，檔案上傳成功',
		UPLOAD_ERR_INI_SIZE => '上傳的檔案超過了 php.ini 中 upload_max_filesize 允許上傳檔案容量的最大值',
		UPLOAD_ERR_FORM_SIZE => '上傳檔案的大小超過了 HTML 表單中 MAX_FILE_SIZE 選項指定的值',
		UPLOAD_ERR_PARTIAL => '檔案只有部分被上傳',
		UPLOAD_ERR_NO_FILE => '沒有檔案被上傳 (沒有選擇上傳檔案就送出表單)',
		UPLOAD_ERR_NO_TMP_DIR => '找不到臨時目錄',
		UPLOAD_ERR_CANT_WRITE => '檔案寫入失敗',
		UPLOAD_ERR_EXTENSION => '上傳的文件被 PHP 擴展程式中斷'
	];

	private $fileInfo;
	private $directory;
	private $filePath;
	private $fileName;
	private $originalFileName;
	private $uploadPath;

	protected $ext;
	protected $allowExt = array('jpeg', 'jpg', 'gif', 'png');
	protected $maxSize = 2097152;
	protected $flag = true;
	protected $msg;

	public function __construct(string $directory, $fileInfo)
	{
		$this->fileInfo = $fileInfo;
		$this->directory = $directory;
		$this->init();
	}

	protected function init()
	{
		$this->originalFileName = (isset($this->fileInfo['name'])) ? $this->fileInfo['name'] : NULL;
		$this->ext = (isset($this->fileInfo['name'])) ? pathinfo($this->fileInfo['name'], PATHINFO_EXTENSION) : NULL;
		$this->fileName = $this->fileInfo['name'];
		$this->uploadPath = $this->getUploadPath();
		$this->filePath = $this->getFilePath();
	}

	/**
	 * @return string
	 */
	protected function getUploadPath(): string
	{
		return FileUtil::IMG . $this->directory . "/";
	}

	/**
	 * @return string
	 */
	public function getFileName(): string
	{
		return $this->fileName;
	}

	/**
	 * @return string
	 */
	public function getFilePath(): string
	{
		return $this->uploadPath . $this->fileName;
	}

	/**
	 * @return bool
	 */
	protected function check(): bool
	{
		$msg = '';
		if ($this->fileInfo['error'] > 0)
			$msg = $this->getErrorMsg($this->fileInfo['error']);
		// 檢查檔案是否是通過 HTTP POST 上傳的
		if (!is_uploaded_file($this->fileInfo['tmp_name']))
			$msg = '檔案不是通過 HTTP POST 方式上傳的';

		// 檢查上傳檔案是否為允許的擴展名
		if (!is_array($this->allowExt))  // 判斷參數是否為陣列
			$msg = '檔案類型型態必須為 array';
		else {
			if (!in_array($this->ext, $this->allowExt))  // 檢查陣列中是否有允許的擴展名
				$msg = '非法檔案類型';
		}
		// 檢查上傳檔案的容量大小是否符合規範
		if ($this->fileInfo['size'] > $this->maxSize)
			$msg = '上傳檔案容量超過限制';
		// 檢查是否為真實的圖片類型
		if ($this->flag && !@getimagesize($this->fileInfo['tmp_name']))
			$msg = '不是真正的圖片類型';
		// 檢查指定目錄是否存在，不存在就建立目錄
		if (!file_exists($this->uploadPath))
			mkdir($this->uploadPath, 0777, true);  // 建立目錄
		if (file_exists($this->filePath))
			self::remove($this->filePath);
		$this->msg = $msg;
		return ($msg === '') ? self::SUCCESS : self::FAIL;
	}

	/**
	 * @param int $error
	 * @return string
	 */
	private function getErrorMsg(int $error): string
	{
		return self::MSG[$error];
	}

	/**
	 * @return bool
	 */
	private function uploadFile(): bool
	{
		if (!@move_uploaded_file($this->fileInfo['tmp_name'], '/var/www/test/pig.jpg')) {
			$this->msg = '檔案移動失敗';
			return self::FAIL;
		}
		return self::SUCCESS;
	}

	/**
	 * @return array
	 */
	public function upload(): array
	{
		if (!$this->check() || !$this->uploadFile()) {
			return self::message(self::FAIL, $this->fileName, $this->filePath, $this->msg);
		}
		return self::message(self::SUCCESS, $this->fileName, $this->filePath, self::type[self::SUCCESS]);
	}


	public function validate()
	{
		if ($this->check())
			return self::message(self::SUCCESS, $this->fileName, "", self::type[self::SUCCESS]);
		return self::message(self::FAIL, $this->fileName, "", $this->msg);
	}

	/**
	 * @param string $filePath
	 * @return array
	 */
	public static function remove(string $filePath): array
	{
		if (!@unlink($filePath)) {
			$msg = '檔案刪除失敗';
			return self::message(self::FAIL, "", $filePath, $msg);
		}
		return self::message(self::SUCCESS, "", $filePath, self::type[self::SUCCESS]);
	}

	/**
	 * @param string $status
	 * @param string $name
	 * @param string $path
	 * @param string $msg
	 * @return array
	 */
	private static function message(string $status, string $name = "", string $path = "", string $msg = "")
	{
		return ['status' => $status, 'name' => $name, 'path' => $path, 'msg' => $msg];
	}
}