<?php

namespace common\login;

use common\model\UserLoginLog;
use common\sso\LoginInformation;
use common\model\User;
use common\util\HttpUtil;
use common\util\LogUtil;

/**
 * Class Login
 * @package common\login
 */
class Login
{
	const LOGIN = 1;
	const LOGOUT = 0;
	private $socialId;
	private $email;
	private $name;

	/**
	 * Login constructor.
	 * @param LoginInformation $LoginInfo
	 */
	public function __construct(LoginInformation $LoginInfo)
	{
		$this->socialId = $LoginInfo->id;
		$this->email = $LoginInfo->email;
		$this->name = $LoginInfo->name;
	}

	public function login()
	{
		if ($this->socialId == "" || $this->email == "") {
			exit;
		}
		$user = User::findUserBySocialIdAndEmail($this->socialId, $this->email);
		$ip = (HttpUtil::isPublicIP(self::getIP())) ? self::getIP() : "";
		if (!$user) {
			$id = User::addUser($this->socialId, $this->email, $this->name);
			UserLoginLog::addUserLoginLog($id, self::LOGIN, $ip);
			if ($id > 0) {
				$this->setUserSession($id, $this->name, $this->email);
			}
		} else {
			if ($user['social_id'] != $this->socialId || $user['email'] != $this->email || $user['name'] != $this->name) {
				User::modifyUser($this->socialId, $this->email, $this->name);
				$user["name"] = $this->name;
				$user["email"] = $this->email;
			}
			UserLoginLog::addUserLoginLog($user["id"], self::LOGIN, $ip);
			if ($user["id"] > 0) {
				$this->setUserSession($user["id"], $user["name"], $user["email"]);
			}
		}
		HttpUtil::redirect('step1.php');
	}

	public static function logout()
	{
		if (isset($_SESSION['USER_ID']) && isset($_SESSION['USER_NAME']) && isset($_SESSION['USER_EMAIL'])) {
			$ip = (HttpUtil::isPublicIP(self::getIP())) ? self::getIP() : "";
			UserLoginLog::addUserLoginLog($_SESSION['USER_ID'], self::LOGOUT, $ip);
		} else {
			$log = new LogUtil("login-" . date("Ymd"));
			$log->warning('logout failed' . json_encode($_SESSION));
		}
		session_destroy();
		HttpUtil::redirect();
	}

	/**
	 * @return mixed|string
	 */
	public static function getIP()
	{
		$ip = '';
		if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} elseif (!empty($_SERVER["REMOTE_ADDR"])) {
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		return $ip;
	}

	/**
	 * @return bool
	 */
	public static function auth()
	{
		return (isset($_SESSION['USER_ID']) && isset($_SESSION['USER_NAME']) && isset($_SESSION['USER_EMAIL'])) ? true : false;
	}

	/**
	 * @param int $id
	 * @param string $name
	 * @param string $email
	 */
	private function setUserSession(int $id, string $name, string $email)
	{
		$_SESSION['USER_ID'] = $id;
		$_SESSION['USER_NAME'] = $name;
		$_SESSION['USER_EMAIL'] = $email;
	}
}