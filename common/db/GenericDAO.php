<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/16
 * Time: 下午 01:41
 */

namespace common\db;


use Exception;
use PDO;
use PDOException;

class GenericDAO
{
	const DB_GENERIC = 'generic';

	public $table;
	public $debug = false;

	/**
	 * @var SafePDO
	 */
	protected static $db;
	protected static $connectionPool = array(GenericDAO::DB_GENERIC => null);

	private static $_host = "";
	// Host Name
	private static $_user = "";
	// User
	private static $_pwd = "";
	// Password
	private static $_dbname = "";
	// DB Name
	private static $_port = "";
	// DB port number
	private static $_charset = "";

	private function __construct()
	{
		$this->apply(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, 3306, 'utf8mb4');
		$this->connect();
	}

	public static function getInstance()
	{
		global $pdo;
		if (empty($pdo)) {
			return new GenericDAO();
		}

	}

	protected function connect($p_host = "", $p_user = "", $p_pwd = "", $p_dbname = "", $p_port = "", $p_charset = '')
	{
		$flag = false;
		if ($p_host == "") {
			$p_host = self::$_host;
		}
		if ($p_user == "") {
			$p_user = self::$_user;
		}
		if ($p_pwd == "") {
			$p_pwd = self::$_pwd;
		}
		if ($p_dbname == "") {
			$p_dbname = self::$_dbname;
		}
		if ($p_port == "") {
			$p_port = self::$_port;
		}
		if ($p_charset == "") {
			$p_charset = self::$_charset;
		}

		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_TIMEOUT => 60,
			PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
			//PDO::ATTR_EMULATE_PREPARES => false
		);

		$dsn = sprintf("mysql:host=%s;port=%d;dbname=%s;charset=%s", $p_host, $p_port, $p_dbname, $p_charset);
		try {
			self::$connectionPool[self::DB_GENERIC] = new SafePDO($dsn, $p_user, $p_pwd, $options);
			self::$db = self::$connectionPool[self::DB_GENERIC];
			$flag = true;
		} catch (Exception $e) {
			if ($e instanceof PDOException) {
                var_dump("ErrorCode:" . $e->getCode() . ",ErrorMsg:" . $e->getMessage());
			}
		}
		return $flag;
	}

	public function getLastInsertId()
	{
		return self::$db->lastInsertId();
	}

	/**
	 * @param string|null $sql_query
	 * @param array|null $sql_query_value
	 * @param string|null $table
	 * @return bool|null
	 */
	public function findAll(string $sql_query = null, array $sql_query_value = null, string $table = null)
	{
		if ($table != null) {
			$this->table = $table;
		}
		$sql = "select * from " . $this->table;
		$sql_where = " where 1 = 1 ";
		if ($sql_query != null) {
			$sql_where .= " and " . $sql_query;
		}
		$sql .= $sql_where;
		$sth = self::$db->prepare($sql);
		if (empty($sth)) {
			if ($this->debug) {
				$this->dumpError(self::$db, $sql);
				$this->logErrors(self::$db->errorInfo());
				throw new PDOException('SQL error');
			} else {
				return false;
			}
		}
		// bind param
		if ($sql_query_value != null) {
			foreach ($sql_query_value as $k => $v) {
				$sth->bindValue($k, $v, self::getPdoType($v));
			}
		}
		$sth->execute();
		$result = null;
		if ($sth->errorCode() != '0000') {
			if ($this->debug) {
				$this->dumpError($sth, $sql);
				$this->logErrors($sth->errorInfo());
				$sth = null;
				throw new PDOException('SQL error');
			} else {
				$sth = null;
				return false;
			}
		}
		$result = $sth->fetchAll(PDO::FETCH_BOTH);
		$sth = null;
		return $result;
	}

	/**
	 *
	 * @param unknown $sql_query
	 * @param unknown $sql_query_value
	 * @param unknown $table
	 * @return mixed
	 */
	public function find($sql_query = null, $sql_query_value = null, $table = null)
	{
		if ($table != null) {
			$this->table = $table;
		}
		$sql = "select * from " . $this->table;
		$sql_where = " where 1 = 1 ";
		if ($sql_query != null) {
			$sql_where .= " and " . $sql_query;
		}
		$sql .= $sql_where . " limit 1";
		$sth = self::$db->prepare($sql);
		if (empty($sth)) {
			if ($this->debug) {
				$this->dumpError(self::$db, $sql);
				$this->logErrors(self::$db->errorInfo());
				throw new PDOException('SQL error');
			} else {
				return false;
			}
		}
		// bind param
		if ($sql_query_value != null) {
			foreach ($sql_query_value as $k => $v) {
				$sth->bindValue($k, $v, self::getPdoType($v));
			}
		}
		$sth->execute();
		if ($sth->errorCode() != '0000') {
			if ($this->debug) {
				$this->dumpError($sth, $sql);
				$this->logErrors($sth->errorInfo());
				$sth = null;
				throw new PDOException('SQL error');
			} else {
				$sth = null;
				return false;
			}
		}
		$result = $sth->fetch(PDO::FETCH_BOTH);
		$sth = null;
		return $result;
	}

	/**
	 * @param $sql_query
	 * @param null $sql_query_value
	 * @return bool
	 */
	public function sqlQuery($sql_query, $sql_query_value = null)
	{
		$sql = $sql_query;
		$sth = self::$db->prepare($sql);
		if (empty($sth)) {
			if ($this->debug) {
				$this->dumpError(self::$db, $sql);
				$this->logErrors(self::$db->errorInfo());
				throw new PDOException('SQL error');
			} else {
				return false;
			}
		}

		if (stripos($sql_query, "use") === 0 || stripos($sql_query, "drop") === 0 || stripos($sql_query, "delete") === 0
			|| stripos($sql_query, "grant") === 0 || stripos($sql_query, "set") === 0 || stripos($sql_query, "create") === 0
			|| stripos($sql_query, "begin") === 0
		) {
//            $errInfo = self::$db->errorInfo();
//            if (!empty($errInfo[0])){
//                return false;
//            }
			return $sth->execute();
		}
		// bind param
		if ($sql_query_value != null) {
			foreach ($sql_query_value as $k => $v) {
				$sth->bindValue($k, $v, self::getPdoType($v));
			}
		}
		$sth->execute();
		if ($sth->errorCode() != '0000') {
			if ($this->debug) {
				$this->dumpError($sth, $sql);
				$this->logErrors($sth->errorInfo());
				$sth = null;
				throw new PDOException('SQL error');
			} else {
				$sth = null;
				return false;
			}
		}

		$result = $sth->fetchAll(PDO::FETCH_BOTH);
		return $result;
	}

	public function queryOne($sql_query, $sql_query_value = null)
	{
		$result = $this->sqlQuery($sql_query, $sql_query_value);
		if (!empty($result)) {
			return $result[0];
		} else {
			return null;
		}
	}

	/**
	 * @param array $fieldset
	 * @param bool $lastInsertId
	 * @param null $table
	 * @return bool
	 */
	public function save(array $fieldset, $lastInsertId = false, $table = null)
	{
		if ($table != null) {
			$this->table = $table;
		}
		$f1 = '';
		$f2 = '';
		foreach ($fieldset as $k => $v) {
			if ($v instanceof DbExpression) {
				$f1 .= $k . ',';
				$f2 .= $v->expression . ',';
			} else {
				$f1 .= $k . ',';
				$f2 .= ':' . $k . ',';
			}
		}
		$sql = 'insert into ' . $this->table . ' (' . substr($f1, 0, -1) . ')
    			 values (' . substr($f2, 0, -1) . ')';
		$sth = self::$db->prepare($sql);
		if (empty($sth)) {
			if ($this->debug) {
				$this->dumpError(self::$db, $sql);
				$this->logErrors(self::$db->errorInfo());
				throw new PDOException('SQL error');
			} else {
				return false;
			}
		}
		foreach ($fieldset as $k => $v) {
			if (!($v instanceof DbExpression)) {
				$sth->bindValue(':' . $k, $v, self::getPdoType($v));
			}
		}
		$result = $sth->execute();
		if ($sth->errorCode() != '0000') {
			if ($this->debug) {
				$this->dumpError($sth, $sql);
				$this->logErrors($sth->errorInfo());
				$sth = null;
				throw new PDOException('SQL error');
			} else {
				$sth = null;
				return false;
			}
		}
		$sth = null;
		if ($lastInsertId) {
			return self::$db->lastInsertId();
		} else {
			return $result;
		}
	}

	/**
	 *
	 * @param array $fieldset
	 * @param string $sqlcondition
	 * @param array $condition_value
	 * @param string $table
	 * @return boolean
	 */
	public function update($fieldset, $sqlcondition = '1 = 1', $condition_value = array(), $table = null)
	{
		if ($table != null) {
			$this->table = $table;
		}
		$f = '';
		foreach ($fieldset as $k => $v) {
			if ($v instanceof DbExpression) {
				$f .= $k . ' = ' . $v->expression . ',';
			} else {
				$f .= $k . ' = ' . ':' . $k . ',';
			}
		}
		$sql = 'update ' . $this->table . ' set ' . substr($f, 0, -1) . ' where ' . $sqlcondition;
		$sth = self::$db->prepare($sql);
		if (empty($sth)) {
			if ($this->debug) {
				$this->dumpError(self::$db, $sql);
				$this->logErrors(self::$db->errorInfo());
				throw new PDOException('SQL error');
			} else {
				return false;
			}
		}
		// sql set bind param
		foreach ($fieldset as $k => $v) {
			if (!($v instanceof DbExpression)) {
				$sth->bindValue(':' . $k, $v, self::getPdoType($v));
			}
		}
		// sql where bind param
		foreach ($condition_value as $k => $v) {
			$sth->bindValue($k, $v, self::getPdoType($v));
		}
		$result = $sth->execute();
		if ($sth->errorCode() != '0000') {
			if ($this->debug) {
				$this->dumpError($sth, $sql);
				$this->logErrors($sth->errorInfo());
				$sth = null;
				throw new PDOException('SQL error');
			} else {
				$sth = null;
				return false;
			}
		} else {
			$result = $sth->rowCount();
		}
		$sth = null;
		return $result;
	}

	/**
	 *
	 * @param string $sqlcondition
	 * @param array $condition_value
	 * @param unknown $table
	 * @return boolean
	 */
	public function delete($sqlcondition = '1 = 1', $condition_value = array(), $table = null)
	{
		if ($table != null) {
			$this->table = $table;
		}
		$f = '';
		$sql = 'delete from ' . $this->table . ' where ' . $sqlcondition;
		$sth = self::$db->prepare($sql);
		if (empty($sth)) {
			if ($this->debug) {
				$this->dumpError(self::$db, $sql);
				$this->logErrors(self::$db->errorInfo());
				throw new PDOException('SQL error');
			} else {
				return false;
			}
		}
		// sql where bind param
		foreach ($condition_value as $k => $v) {
			$sth->bindValue($k, $v, self::getPdoType($v));
		}
		$result = $sth->execute();
		if ($sth->errorCode() != '0000') {
			if ($this->debug) {
				$this->dumpError($sth, $sql);
				$this->logErrors($sth->errorInfo());
				$sth = null;
				throw new PDOException('SQL error');
			} else {
				$sth = null;
				return false;
			}
		}
		$sth = null;
		return $result;
	}

	/**
	 * Determines the PDO type for the given PHP data value.
	 *
	 * @param mixed $data
	 *            the data whose PDO type is to be determined
	 * @return integer the PDO type
	 * @see http://www.php.net/manual/en/pdo.constants.php
	 */
	public static function getPdoType($data)
	{
		static $typeMap = array(
			// php type => PDO type
			'boolean' => PDO::PARAM_BOOL,
			'integer' => PDO::PARAM_INT,
			'string' => PDO::PARAM_STR,
			'resource' => PDO::PARAM_LOB,
			'NULL' => PDO::PARAM_NULL
		);
		$type = gettype($data);

		return isset($typeMap[$type]) ? $typeMap[$type] : PDO::PARAM_STR;
	}

	/**
	 * get pdo object to do transactions
	 *
	 * @return SafePDO
	 */
	public function getDb()
	{
		return self::$db;
	}


	public static function filterSQL($sql)
	{
		$params = [';', '--', '# ', ' 0x', 'union ', 'drop ', 'use ', 'source ', '/*', '*/', 'char(', 'load_file(', 'if('];
		return str_ireplace($params, "", $sql);
	}

	protected function dumpError($obj, $sql)
	{
		$ip = $_SERVER["REMOTE_ADDR"];
		if ($ip == "127.0.0.1") {
			var_dump($sql);
			var_dump($obj->errorInfo());
			debug_print_backtrace();
		}
	}

	protected function logErrors($errorInfo)
	{
		// 寫回Office總管系統
//        $error = $errorInfo[2];
//        $sql = "insert into novellink.shop_mysql_error_log (mall_id,REQUEST_URI,mysql_query,mysql_error,HTTP_REFERER,REMOTE_ADDR,post_day,post_date)
//                values ('" . $_SESSION["_SYSTEM_MALL_ID"] . "','" . addslashes($_SERVER["REQUEST_URI"]) . "','" . addslashes($SQL) . "','" . addslashes($error) . "','" . addslashes($_SERVER["HTTP_REFERER"]) . "','" . $_SERVER["HTTP_X_FORWARDED_FOR"] . "',now(),now())";
//        $this->sqlQuery($sql);
	}

	private function apply($p_host, $p_user, $p_pwd, $p_dbname, $p_port = '3306', $p_charset = 'utf8mb4')
	{
		self::$db = null;
		self::$_host = $p_host;
		self::$_user = $p_user;
		self::$_pwd = $p_pwd;
		self::$_dbname = $p_dbname;
		self::$_port = $p_port;
		self::$_charset = $p_charset;
	}
}
