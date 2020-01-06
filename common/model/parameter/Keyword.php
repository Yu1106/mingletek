<?php

namespace common\model\parameter;

class Keyword
{
	const KOREAN_STYLE = 'korean_style';
	const THIN = 'thin';
	const TEMPERAMENT = 'temperament';
	const HIPSTER = 'hipster';
	const FRESH = 'fresh';
	const SEXY = 'sexy';
	const SWEET = 'sweet';
	const LEISURE = 'leisure';
	const SPOT = 'spot';
	const ELEGANT = 'elegant';
	const RECOMMENDED = 'recommended';
	const FASHION = 'fashion';
	const NEW_PRODUCT = 'new_product';
	const ROMANTIC = 'romantic';

	const KeywordType = [
		self::KOREAN_STYLE => '韓版',
		self::THIN => '顯瘦',
		self::TEMPERAMENT => '氣質',
		self::HIPSTER => '文青風',
		self::FRESH => '清新',
		self::SEXY => '性感',
		self::SWEET => '甜美',
		self::LEISURE => '休閒',
		self::SPOT => '現貨',
		self::ELEGANT => '優雅',
		self::RECOMMENDED => '店長推薦',
		self::FASHION => '時尚',
		self::NEW_PRODUCT => '新品',
		self::ROMANTIC => '浪漫'
	];
}