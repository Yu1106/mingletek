<?php

namespace common\util;

use League\Csv\CannotInsertRecord;
use League\Csv\EncloseField;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Writer;

class CvsUtil
{
	const READ = 'READ';
	const WRITE = 'WRITE';
	const WRITE_A = 'WRITE_A';

	private $cvsRead;
	private $cvsWrite;

	/**
	 * LeagueCsv constructor.
	 * @param string $action
	 * @param string $path
	 * @param string $delimiter
	 * @throws Exception
	 */
	public function __construct(string $action, string $path, string $delimiter = ",")
	{
		switch ($action) {
			case self::READ:
				$this->cvsRead = Reader::createFromPath($path, 'r');
				$this->cvsRead->setDelimiter($delimiter);
				$this->cvsRead->setOutputBOM(Reader::BOM_UTF8);
				break;
			case self::WRITE:
				$this->cvsWrite = Writer::createFromPath($path, 'w+');
				$this->cvsWrite->setDelimiter($delimiter);
				break;
			case self::WRITE_A:
				$this->cvsWrite = Writer::createFromPath($path, 'a');
				$this->cvsWrite->setDelimiter($delimiter);
				break;
			default:
				exit();
		}
	}

	/**
	 * @return string
	 */
	public function getContent()
	{
		return $this->cvsRead->getContent();
	}

	/**
	 * @param string $fileName
	 */
	public function output(string $fileName)
	{
		$this->cvsRead->output($fileName);
	}

	/**
	 * @param array $data
	 * @throws CannotInsertRecord
	 * @throws Exception
	 */
	public function insertOne(array $data)
	{
		EncloseField::addTo($this->cvsWrite, "\t\x1f");
		$this->cvsWrite->insertOne($data);
	}

	/**
	 * @param array $data
	 */
	public function insertAll(array $data)
	{
		EncloseField::addTo($this->cvsWrite, "\t\x1f");
		$this->cvsWrite->insertAll($data);
	}
}