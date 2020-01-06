<?php


namespace common\model\parameter;

/**
 * Class Feature5
 * @package common\model\parameter
 * api傳入欄位名[texture_4]
 */
class Feature5
{
	const POLK_DOT = 'polkadot';
	const STRIPED = 'striped';
	const PLAID = 'plaid';

	const Feature5Type = [
		self::POLK_DOT => '波卡圓點',
		self::STRIPED => '條紋',
		self::PLAID => '格子',
	];
}