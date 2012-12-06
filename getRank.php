<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

if(!isset($_GET['type']))
	exit();

$type=$_GET['type'];

$week = $_GET['week'];
$team = $_GET['team'];
	
if($type=='all'){
	$weekrank = getRandOnWeek($week,$team);
	if($weekrank!=null){
// 		$weekrank = my_urlencode_double($weekrank);
// 		$json = urldecode(json_encode($weekrank));
		echo json_encode($weekrank);
	}
}else if($type=='worst'){
	$worst = getWorstOnWeek($week, $team);
	if($worst!=null){
		echo json_encode($worst);
	}
}
?>