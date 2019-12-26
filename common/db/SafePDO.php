<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/16
 * Time: 下午 02:01
 */

namespace common\db;

use PDO;

Class SafePDO extends PDO {
	protected $transactionCounter = 0;
	// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    public static function exception_handler($exception) {
        die("Uncaught exception: " . $exception->getMessage());
    }

    public function __construct($dsn, $username='', $password='', $driver_options=array()) {

        // Temporarily change the PHP exception handler while we . . .
        set_exception_handler(array(__CLASS__, 'exception_handler'));

        // . . . create a PDO object
        parent::__construct($dsn, $username, $password, $driver_options);

        // Change the exception handler back to whatever it was before
        restore_exception_handler();
    }

    function beginTransaction() {
    	if(!$this->transactionCounter++)
    		return parent::beginTransaction();
    		return $this->transactionCounter >= 0;
    }

    function commit() {
	    if(!--$this->transactionCounter)
	    	return parent::commit();
	    	return $this->transactionCounter >= 0;
    }

    function rollBack() {
	    if($this->transactionCounter >= 0) {
	    	$this->transactionCounter = 0;
	    	return parent::rollback();
	    }
	    $this->transactionCounter = 0;
    	return false;
    }
}

?>
