<?php

namespace common\util;

class HttpUtil
{
	const WEB_BASIC = 'https://www.mingletek.com/';
	const METHOD_GET = 'get';
	const METHOD_POST = 'post';
	const METHOD_WWW_URLENCODED = 'www-urlencoded';
	const METHOD_RAW = 'raw';
	const METHOD_FILE = 'file';
	const METHOD_XML = 'xml';

	// ajax return value
	const XHR_SUCCESS = '1';
	const XHR_FAILED = '-1';
	const INFO = 'html_info';
	const MESSAGE = 'html_message';
	const WARNING = 'html_warning';
	const ERROR = 'html_error';

	const DEFAULT_OPTION = [
		CURLOPT_RETURNTRANSFER => true, // return web page
		CURLOPT_HEADER => false, // don't return headers
		CURLOPT_FOLLOWLOCATION => true, // follow redirects
		CURLOPT_AUTOREFERER => true,
		CURLOPT_USERAGENT => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36",
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => true,
		CURLOPT_CONNECTTIMEOUT => 5,
		// timeout 5 seconds
		CURLOPT_TIMEOUT => 5,
		CURLOPT_CAINFO => '/var/www/html/cacert.pem'
	];

	/**
	 * @param string $url
	 * @param array $data
	 * @param string $method
	 * @param array $option
	 * @return mixed|null
	 * @throws \Exception
	 *
	 *   When $method == 'xml'
	 *   $data = [
	 *     'xml' => xml raw Data
	 *   ];
	 */
	public static function curl(string $url, array $data = [], string $method = self::METHOD_POST, array $option = self::DEFAULT_OPTION)
	{
		$option[CURLOPT_DNS_CACHE_TIMEOUT] = 2;

		$method = strtolower($method);
		if ($method == static::METHOD_POST) {
			$option[CURLOPT_POST] = count($data);
			$option[CURLOPT_POSTFIELDS] = http_build_query($data);
		} else if ($method == static::METHOD_GET) {
			if (!empty($data)) {
				$url .= '?' . http_build_query($data);
			}
		} else if ($method == static::METHOD_WWW_URLENCODED) {
			$option[CURLOPT_HTTPHEADER][] = 'Content-Type: application/x-www-form-urlencoded';
			$option[CURLOPT_POST] = 1;
			$option[CURLOPT_POSTFIELDS] = http_build_query($data);
		} else if ($method == static::METHOD_RAW) {
			$option[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
			$option[CURLOPT_POST] = 1;
			$option[CURLOPT_POSTFIELDS] = json_encode($data);
		} else if ($method == static::METHOD_FILE) {
			$option[CURLOPT_POST] = count($data);
			$option[CURLOPT_POSTFIELDS] = $data;
		} else if ($method == static::METHOD_XML) {
			$option[CURLOPT_HTTPHEADER][] = 'Content-Type: text/xml';
			$option[CURLOPT_POST] = 1;
			$option[CURLOPT_POSTFIELDS] = $data['xml'];
		}
		$ch = curl_init($url);
		curl_setopt_array($ch, $option);
		$httpcode = null;
		$result = null;
		if (!curl_errno($ch)) {
			$result = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		}
		if ($httpcode == 200) {
			curl_close($ch);
			return $result;
		} else {
			$error = curl_error($ch);
			curl_close($ch);
			throw new \Exception("HTTP error, error message: $error, http code: $httpcode, message: $result, method: $method, header: " .
				json_encode($option) . ", data: " . json_encode($data));
		}
	}

	public static function post($field)
	{
		if (isset($_POST[$field])) {
			return $_POST[$field];
		} else {
			return '';
		}
	}

	public static function get($field)
	{
		if (isset($_GET[$field])) {
			return $_GET[$field];
		} else {
			return '';
		}
	}

	public static function port()
	{
		if (isset($_SERVER['HTTP_CF_VISITOR'])) {
			$cfVisitor = json_decode($_SERVER['HTTP_CF_VISITOR']);
			if (isset($cfVisitor->scheme) && $cfVisitor->scheme == 'https') {
				return 443;
			}
		}

		if (!empty($_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'])) {
			if ($_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'] == 'https') {
				$port = 443;
			} else {
				$port = 80;
			}
		} else {
			if (!empty($_SERVER["HTTP_X_FORWARDED_PORT"])) {
				$port = $_SERVER['HTTP_X_FORWARDED_PORT'];
			} else {
				$port = $_SERVER['SERVER_PORT'];
			}
		}
		return $port;
	}

	public static function isPublicIP(string $ip)
	{
		return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) ? true : false;
	}

	public static function SSOUrl(string $endpoint)
	{
		return self::WEB_BASIC . "mingletek/login.php" . $endpoint;
	}

	public static function redirect(string $path = 'index.php')
	{
		header('location:' . self::WEB_BASIC . 'mingletek/' . $path);
		die();
	}
}
