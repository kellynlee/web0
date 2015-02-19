<?php
include_once('database.php');
include_once('input_validator.php');

class UserInfoValidator {
	protected $sqlConn;
	protected $validator;
	public function __construct() {
		$this->sqlConn = new Database();
		$this->validator = new InputValidator();
	}
	public function verifyAccessToken($token) {
		if (trim($token)=='') {
			$this->invalidTokenHandler();
		}
		$queryResult = $this->sqlConn->query("SELECT * FROM `access_token` WHERE `token`='".($this->validator->escape($token))."' ORDER BY `expires` DESC");
		if (mysql_num_rows($queryResult)==0) {
			$this->invalidTokenHandler();
		}
		$row = mysql_fetch_array($queryResult);
		if (((int)$row['expires']) < time()) {
			$this->invalidTokenHandler();
		}
	}
	protected function invalidTokenHandler() {
		die('{"status":403,"message":"Access token invalid."}');
	}
}
