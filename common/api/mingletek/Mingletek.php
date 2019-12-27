<?php


namespace common\api\mingletek;

use ArrayObject;
use common\api\IPFilter;

class Mingletek
{
	public function __construct()
	{
		$array = ['127.0.0.1'];
		$object = new ArrayObject($array);
		$iterator = new IPFilter($object->getIterator());
		if (!$iterator) {
			die("ip failed");
		}
	}

	public function Hello()
	{
		$mingletek = new HelloRequest();
		$helloRequest = $mingletek->send();
		return $helloRequest;
	}

	public function CreateAccount(CreateAccountRecord $data)
	{
		$mingletek = new CreateAccountRequest($data);
		$createAccountRequest = $mingletek->send();
		return $createAccountRequest;
	}

	public function CheckAccount(CheckAccountRecord $data)
	{
		$mingletek = new CheckAccountRequest($data);
		$checkAccountRequest = $mingletek->send();
		return $checkAccountRequest;
	}

	public function StartProcess(StartProcessRecord $data)
	{
		echo "StartProcess<br>";
		$mingletek = new StartProcessRequest($data);
		$startProcessRequest = $mingletek->send();
		return $startProcessRequest;
	}

	public function GetProcessData(GetProcessDataRecord $data)
	{
		$mingletek = new GetProcessDataRequest($data);
		$getProcessDataRequest = $mingletek->send();
		return $getProcessDataRequest;
	}

	public function Housekeeping(HousekeepingRecord $data)
	{
		$mingletek = new HousekeepingRequest($data);
		$housekeepingRequest = $mingletek->send();
		return $housekeepingRequest;
	}

	public function RenewSentence(RenewSentenceRecord $data)
	{
		$mingletek = new RenewSentenceRequest($data);
		$renewSentenceRequest = $mingletek->send();
		return $renewSentenceRequest;
	}
}