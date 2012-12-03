<?php
session_start();
require_once 'include/db_operator_class.php';

function getWeek(){
	$dateStart = strtotime('2012-12-2');
	$dateNow = strtotime(date('Y-m-j'));
	$betweenDate = floor(($dateNow - $dateStart)/604800)+1;
	return $betweenDate;
}

if(isset($_GET['uid'])) {
	$uid = $_GET['uid'];
	$user_result = get_UserByUid($uid);
	if($user_result!=null){
		$_SESSION['login']=1;
		$_SESSION['uid']=$uid;
		$_SESSION['userid']=$user_result['id'];
		$_SESSION['name']=$user_result['name'];
		$_SESSION['nickname']=$user_result['nickname'];
		$_SESSION['pojname']=$user_result['POJ_user_name'];
		$_SESSION['sex']=$user_result['sex'];
		$_SESSION['email']=$user_result['mail'];
		$_SESSION['week']=getWeek();
		$_SESSION['team']=$user_result['team'];
		$_SESSION['photoPath']=$user_result['photoPath'];
		header("Location: index.php");
		exit;
	}else{
		$name = $_GET['name'];
		header('Location: user_profile.php?uid='.$uid.'&&name='.$name.'&&type=insert');
		exit;
	}
}
?>