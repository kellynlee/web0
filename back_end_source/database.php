<?php
include_once('config.php');

class Database {
	protected $mysqlConn;
	public function __construct() {
		$this->mysqlConn = mysql_connect($GLOBALS['DATABASE_HOST'],$GLOBALS['DATABASE_USER'],$GLOBALS['DATABASE_PASSWORD']);
		mysql_select_db($GLOBALS['DATABASE_NAME'],$this->mysqlConn);
	}
	public function query($queryStr) {
		return mysql_query($queryStr,$this->mysqlConn);
	}
	public function __destruct() {
//		mysql_close($this->mysqlConn);
	}
}
