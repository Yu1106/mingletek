<?php

namespace common\model\parameter;

class Site
{
	const TAIPEI = '台北市';
	const NEW_TAIPEI_CITY = '新北市';
	const KEELUNG = '基隆市';
	const YILAN_COUNTY = '宜蘭縣';
	const TAOYUAN_CITY = '桃園市';
	const HSINCHU_CITY = '新竹市';
	const HSINCHU_COUNTY = '新竹縣';
	const MIAOLI_COUNTY = '苗栗縣';
	const TAICHUNG = '台中市';
	const CHANGHUA_COUNTY = '彰化縣';
	const NANTOU_COUNTY = '南投縣';
	const CHIAYI_CITY = '嘉義市';
	const CHIAYI_COUNTY = '嘉義縣';
	const YUNLIN_COUNTY = '雲林縣';
	const TAINAN_CITY = '台南市';
	const KAOHSIUNG = '高雄市';
	const PINGTUNG_COUNTY = '屏東縣';
	const HUALIEN_COUNTY = '花蓮縣';
	const TAITUNG_COUNTY = '台東縣';
	const PENGHU_COUNTY = '澎湖縣';
	const GOLDEN_GATE = '金門';
	const MATSU = '馬祖';
	const UNITED_STATES = '美國';
	const JAPAN = '日本';
	const CANADA = '加拿大';
	const HONG_KONG = '香港';
	const CHINA_MAINLAND = '中國大陸';
	const OTHER_COUNTRIES = '其他國家';

	const SiteType = [
		self::TAIPEI => '台北市',
		self::NEW_TAIPEI_CITY => '新北市',
		self::KEELUNG => '基隆市',
		self::YILAN_COUNTY => '宜蘭縣',
		self::TAOYUAN_CITY => '桃園市',
		self::HSINCHU_CITY => '新竹市',
		self::HSINCHU_COUNTY => '新竹縣',
		self::MIAOLI_COUNTY => '苗栗縣',
		self::TAICHUNG => '台中市',
		self::CHANGHUA_COUNTY => '彰化縣',
		self::NANTOU_COUNTY => '南投縣',
		self::CHIAYI_CITY => '嘉義市',
		self::CHIAYI_COUNTY => '嘉義縣',
		self::YUNLIN_COUNTY => '雲林縣',
		self::TAINAN_CITY => '台南市',
		self::KAOHSIUNG => '高雄市',
		self::PINGTUNG_COUNTY => '屏東縣',
		self::HUALIEN_COUNTY => '花蓮縣',
		self::TAITUNG_COUNTY => '台東縣',
		self::PENGHU_COUNTY => '澎湖縣',
		self::GOLDEN_GATE => '金門',
		self::MATSU => '馬祖',
		self::UNITED_STATES => '美國(YAHOO限定)',
		self::JAPAN => '日本(YAHOO限定)',
		self::CANADA => '加拿大(YAHOO限定)',
		self::HONG_KONG => '香港(YAHOO限定)',
		self::CHINA_MAINLAND => '中國大陸(YAHOO限定)',
		self::OTHER_COUNTRIES => '其他國家(YAHOO限定)'
	];
}