<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');
echo '<h3>get_Users</h3>';
$users = get_Users();
if($users!=null){
	foreach($users as $key=>$value){
		foreach($value as $key2=>$value2){
			printf("%s = %s ,", $key2, $value2);
		}
		echo '<br/>';
	}
}else{
	echo 'no result';
}

echo '<h3>get_UserById , id = 1</h3>';
$user1 = get_UserById(1);
if($user1!=null){
	foreach($user1 as $keyu1=>$valueu1){
		printf("%s = %s ,", $keyu1, $valueu1);
	}
	echo '<br/>';
}else{
	echo 'no result';
}

echo '<h3>get_UserByEmail , Email = test@gmail.com</h3>';
$user2 = get_UserByEmail("test@gmail.com");
if($user2!=null){
	foreach($user2 as $keyu2=>$valueu2){
		printf("%s = %s ,", $keyu2, $valueu2);
	}
	echo '<br/>';
}else{
	echo 'no result';
}
?>