<?php


namespace common\model;

use common\db\DbExpression;

class MingletekApiLog extends Model
{
	const CREATE_ACCOUNT = 'CreateAccount';
	const CHECK_ACCOUNT = 'CheckAccount';
	const START_PROCESS = 'StartProcess';
	const GET_PROCESS_DATA = 'GetProcessData';
	const HOUSE_KEEPING = 'Housekeeping';
	const RENEW_SENTENCE = 'RenewSentence';

	protected static function tableName()
	{
		return "mingletek_api_log";
	}

	/**
	 * @param int $user_id
	 * @param int $storeId
	 * @param string $action
	 * @param string $data
	 * @param string $returnData
	 * @param string $modifyData
	 * @return bool
	 */
	public static function addLog(int $user_id = 0, int $storeId = 0, string $action, string $data = '', string $returnData = '', string $modifyData = '')
	{
		return self::getDb()->save(
			[
				'user_id' => $user_id,
				'store_id' => $storeId,
				'action' => $action,
				'data' => $data,
				'return_data' => $returnData,
				'modify_data' => $modifyData,
				'modify_date' => new DbExpression("now()"),
				'create_date' => new DbExpression("now()")
			], true, static::tableName());
	}

	/**
	 * @param int $id
	 * @param int $storeId
	 * @param string $data
	 * @param string $returnData
	 * @param string $modifyData
	 * @return bool
	 */
	public static function modifyLogById(int $id, int $storeId = 0, string $data = '', string $returnData = '', string $modifyData = '')
	{
		$array = [
			'modify_date' => new DbExpression("now()")
		];
		if ($storeId)
			$array['store_id'] = $storeId;
		if ($data)
			$array['data'] = $data;
		if ($returnData)
			$array['return_data'] = $returnData;
		if ($modifyData)
			$array['modify_data'] = $modifyData;
		return self::getDb()->update(
			$array,
			"id = :id",
			['id' => $id],
			static::tableName()
		);
	}
}