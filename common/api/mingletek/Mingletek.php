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
		echo "Hello<br>";
		$mingletek = new HelloRequest();
		$helloRequest = $mingletek->send();
		var_dump($helloRequest);
	}

	public function CreateAccount(CreateAccountRecord $data)
	{
		echo "CreateAccount<br>";
		$mingletek = new CreateAccountRequest($data);
		$createAccountRequest = $mingletek->send();
		var_dump($createAccountRequest);
	}

	public function CheckAccount(CheckAccountRecord $data)
	{
		echo "CheckAccount<br>";
		$mingletek = new CheckAccountRequest($data);
		$checkAccountRequest = $mingletek->send();
		var_dump($checkAccountRequest);
	}

	public function StartProcess(StartProcessRecord $data)
	{
		echo "StartProcess<br>";
		$mingletek = new StartProcessRequest($data);
		$startProcessRequest = $mingletek->send();
		var_dump($startProcessRequest);
	}

	public function GetProcessData(GetProcessDataRecord $data)
	{
		echo "GetProcessData<br>";
		$mingletek = new GetProcessDataRequest($data);
		$getProcessDataRequest = $mingletek->send();
		var_dump($getProcessDataRequest);
	}

	public function Housekeeping(HousekeepingRecord $data)
	{
		echo "Housekeeping<br>";
		$mingletek = new HousekeepingRequest($data);
		$housekeepingRequest = $mingletek->send();
		var_dump($housekeepingRequest);
	}

	public function RenewSentence(RenewSentenceRecord $data)
	{
		echo "RenewSentence<br>";
		$mingletek = new RenewSentenceRequest($data);
		$renewSentenceRequest = $mingletek->send();
		var_dump($renewSentenceRequest);
	}
}