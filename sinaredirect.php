<?php
session_start();
require_once 'include/db_operator_class.php';

if(isset($_GET['uid'])) {
	$uid = $_GET['uid'];
	$user_result = get_UserByUid($uid);
	if($user_result!=null){
		$_SESSION['login']=1;
		$_SESSION['uid']=$uid;
		$_SESSION['userid']=$user_result['id'];
		$_SESSION['name']=$user_result['name'];
		$_SESSION['nickname']=$user_result['nickname'];
		$_SESSION['week']=1;
		$_SESSION['team']=$user_result['team'];
		$_SESSION['photoPath']=$user_result['photoPath'];
		header("Location: index.php");
		exit;
	}else{
		$name = $_GET['name'];
		header('Location: user_profile.php?uid='.$uid.'&&name='.$name);
		exit;
	}
}
?>