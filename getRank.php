<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

	$week = $_GET['week'];
	$team = $_GET['team'];
	$weekrank = getRandOnWeek($week,$team);
	if($weekrank!=null){
		$weekrank = my_urlencode_double($weekrank);
		$json = urldecode(json_encode($weekrank));
		echo $json;
	}
?>