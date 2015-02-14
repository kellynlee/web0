<?php
include_once('config.php');
include_once('database.php');
include_once('userinfo_validator.php');

class Users {
	protected $sqlConn;
	protected $validator;
	protected $tokenValidator;
	public function __construct() {
		$this->sqlConn = new Database();
		$this->validator = new InputValidator();
		$this->tokenValidator = new UserInfoValidator();
	}

	/*******************************************************************************/
	/*****************************API View Functions********************************/
	/*******************************************************************************/

	public function createUser($username,$password,$email,$avatar,$properties) {
		$username = $this->validator->escape($username);
		$email = $this->validator->escape($email);
		$avatar = $this->validator->escape($avatar);
		$properties = $this->validator->escape($properties);
		if ($username=='' || $password=='' || $email=='') {
			die('{"status":-1,"message":"Invalid input."}');
		}
		if ($avatar == '') {
			$avatar = $GLOBALS['DEFAULT_AVATAR'];
		}
		if ($properties == '') {
			$properties = '';
		}
		$queryResult = $this->sqlConn->query("SELECT * FROM `users` WHERE `username`='$username'");
		if (mysql_num_rows($queryResult)) {
			die('{"status":0,"message":"Username already exists."}');
		}
		$password = md5($password);
		$this->sqlConn->query("INSERT INTO `users` (`username`,`password`,`email`,`avatar`,`properties`,`authorities`) VALUES ('$username','$password','$email','$avatar','$properties','')");
		echo '{"status":200,"message":"User created."}';
	}

	public function login($username,$password) {
		$username = $this->validator->escape($username);
		if ($username=='' || $password=='') {
			die('{"status":-1,"message":"Invalid input."}');
		}
		$password = md5($password);
		$queryResult = $this->sqlConn->query("SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'");
		if (mysql_num_rows($queryResult)==0) {
			die('{"status":403,"message":"Username or password incorrect."}');
		}
		$newToken = $this->generateAccessToken();
		$expires = time() + $GLOBALS['ACCESS_TOKEN_EXPIRES'];
		$this->sqlConn->query("INSERT INTO `access_token` (`token`,`username`,`expires`) VALUES ('$newToken','$username','$expires')");
		echo '{"status":200,"message":"Successfully Logged in.","accesstoken":"'.$newToken.'"}';
	}

	public function logout($token) {
		$this->tokenValidator->verifyAccessToken($token);
		$this->sqlConn->query("DELETE FROM `access_token` WHERE `token`='$token'");
		echo '{"status":200,"message":"Success."}';
	}

	public function getUserInfoByToken($token) {
		$this->tokenValidator->verifyAccessToken($token);
		$username = $this->getUsernameByToken($token);
		echo $this->getUserInfo($username);
	}

	public function getAllUsernames($token) {
		$this->tokenValidator->verifyAccessToken($token);
		if (!$this->userHasAuthority($token,'admin')) {
			die('{"status":403,"message":"Permission denied."}');
		}
		$users = array();
		$index = 0;
		$queryResult = $this->sqlConn->query("SELECT * FROM `users`");
		while ($row = mysql_fetch_array($queryResult)) {
			$users[$index] = $row['username'];
			$index++;
		}
		$users_json = json_encode($users);
		echo '{"status":200,"message":"Success.","userlist":'.$users_json.'}';
	}

	public function updateUserInfoByToken($token, $email, $avatar, $properties) {
		$this->tokenValidator->verifyAccessToken($token);
		$username = $this->getUsernameByToken($token);
		$this->updateUserInfo($username,$email,$avatar,$properties);
		echo '{"status":200,"message":"Success."}';
	}

	public function updateUserInfoByUsername($token, $username, $email, $avatar, $properties) {
		$this->tokenValidator->verifyAccessToken($token);
		if (!$this->userHasAuthority($token,'admin')) {
			die('{"status":403,"message":"Permission denied."}');
		}
		$this->updateUserInfo($username,$email,$avatar,$properties);
		echo '{"status":200,"message":"Success."}';				
	}

	public function setUserAuthorities($token,$username,$newAuthorities) {
		$this->tokenValidator->verifyAccessToken($token);
		if (!$this->userHasAuthority($token,'admin')) {
			die('{"status":403,"message":"Permission denied."}');
		}
		$username = $this->validator->escape($username);
		$newAuthorities = $this->validator->escape($newAuthorities);
		$this->sqlConn->query("UPDATE `users` SET `authorities`='$newAuthorities' WHERE `username`='$username'");
		echo '{"status":200,"message":"Success."}';
	}

	public function getUserInfoByUsername($token,$username) {
		$this->tokenValidator->verifyAccessToken($token);
		if (!$this->userHasAuthority($token,'admin')) {
			die('{"status":403,"message":"Permission denied."}');
		}
		echo $this->getUserInfo($username);
	}

	public function deleteUser($token,$username) {
		$this->tokenValidator->verifyAccessToken($token);
		if (!$this->userHasAuthority($token,'admin')) {
			die('{"status":403,"message":"Permission denied."}');
		}
		$username = $this->validator->escape($username);
		$this->verifyUsername($username);
		$this->sqlConn->query("DELETE FROM `users` WHERE `username`='$username'");
		echo '{"status":200,"message":"Success."}';
	}

	/****************************************************************************/
	/***********************Internal-call functions******************************/
	/****************************************************************************/

	public function verifyUsername($username) {
		$queryResult = $this->sqlConn->query("SELECT * FROM `users` WHERE `username`='$username'");
		if (mysql_num_rows($queryResult)==0) {
			die('{"status":404,"message":"Username not found."}');
		}		
	}

	public function getUserInfo($username) {
		$this->verifyUsername($username);
		$queryResult = $this->sqlConn->query("SELECT * FROM `users` WHERE `username`='$username'");
		$row = mysql_fetch_array($queryResult);
		$email = $row['email'];
		$avatar = $row['avatar'];
		$properties = $row['properties'];
		$authorities = $row['authorities'];
		return '{"status":200,"message":"Success.","userinfo":{"username":"'.$username.'","email":"'.$email.'","avatar":"'.$avatar.'","properties":"'.$properties.'","authorities":"'.$authorities.'"}}';
	}

	public function updateUserInfo($username,$email,$avatar,$properties) {
		$email = $this->validator->escape($email);
		$avatar = $this->validator->escape($avatar);
		$properties = $this->validator->escape($properties);
		$this->verifyUsername($username);
		if ($email!='')
			$this->sqlConn->query("UPDATE `users` SET `email`='$email' WHERE `username`='$username'");
		if ($avatar!='')
			$this->sqlConn->query("UPDATE `users` SET `avatar`='$avatar' WHERE `username`='$username'");
		if ($properties!='')
			$this->sqlConn->query("UPDATE `users` SET `properties`='$properties' WHERE `username`='$username'");
	}

	public function getUserAuthoritiesByToken($token) {
		$username = $this->getUsernameByToken($token);
		$this->verifyUsername($username);
		$queryResult = $this->sqlConn->query("SELECT * FROM `users` WHERE `username`='$username'");
		$row = mysql_fetch_array($queryResult);
		return explode(' ',$row['authorities']);
	}

	public function userHasAuthority($token,$authority) {
		$authorities = $this->getUserAuthoritiesByToken($token);
		$flag = 0;
		foreach ($authorities as $userAuthority) {
			if ($authority==$userAuthority) {
				$flag = 1;
			}
		}
		return $flag;		
	}

	public function getUsernameByToken($token) {
		$queryResult = $this->sqlConn->query("SELECT * FROM `access_token` WHERE `token`='$token' ORDER BY `expires` DESC");
		$resultArray = mysql_fetch_array($queryResult);
		return $resultArray['username'];
	}

	protected function generateAccessToken() {
		$src = time().rand(10000000,99999999);
		return md5($src);
	}

}