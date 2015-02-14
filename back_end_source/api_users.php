<?php
include_once('users.php');
$userObj = new Users();
$action = $_GET['action'];

switch($action) {
	case 'createuser':
		$userObj->createUser($_POST['username'],$_POST['password'],$_POST['email'] ,$_POST['avatar'] ,$_POST['properties']);
		break;
	case 'login':
		$userObj->login($_POST['username'],$_POST['password']);
		break;
	case 'getuserinfobytoken':
		$userObj->getUserInfoByToken($_GET['accesstoken']);
		break;
	case 'logout':
		$userObj->logout($_GET['accesstoken']);
		break;
	case 'getallusernames':
		$userObj->getAllUsernames($_GET['accesstoken']);
		break;
	case 'updateuserinfobytoken':
		$userObj->updateUserInfoByToken($_GET['accesstoken'], $_POST['email'], $_POST['avatar'], $_POST['properties']);
		break;
	case 'updateuserinfobyusername':
		$userObj->updateUserInfoByUsername($_GET['accesstoken'], $_POST['username'], $_POST['email'], $_POST['avatar'], $_POST['properties']);
		break;
	case 'setuserauthorities':
		$userObj->setUserAuthorities($_GET['accesstoken'],$_POST['username'],$_POST['properties']);
		break;
	case 'getuserinfobyusername':
		$userObj->getUserInfoByUsername($_GET['accesstoken'],$_GET['username']);
		break;
	case 'deleteuser':
		$userObj->deleteUser($_GET['accesstoken'],$_GET['username']);
		break;
	default:
		echo '{"status":-1,"message":"Action not specified."}';
		break;
}
