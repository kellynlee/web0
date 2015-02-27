<?php
include_once('todo.php');
$todoObj = new todo();
$action = $_GET['action'];

switch($action) {
	case 'writeresume':
		$todoObj->writeresume($POST['title'],$_POST['name'],$_POST['sex'],$_POST['age'],$_POST['phone'],$_POST['email'],$_POST['qq'],$_POST['msn'],$_POST['content']);
		break;
	case 'createshop':
		$todoObj->createshop($_POST['name'],$_POST['owner'],$_POST['phone'],$_POST['content']);
		break;
	case 'searchresume':
		$todoObj->searchresume($_POST['data']);
		break;
	case 'searchshop':
		$todoObj->searchresume($_POST['data']);
		break;
	default:
		echo '{"status":-1,"message":"Action not specified."}';
		break;
}
