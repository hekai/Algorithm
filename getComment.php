<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

$type = $_GET['type'];
if($type!=null && $type=='prob'){
	$probId = $_GET['probID'];
	$commentsprob = get_CommentsByProb($probId);
	if($commentsprob!=null){
		echo json_encode($commentsprob);
	}
}else if($type!=null && $type=='spring'){
	$week = $_GET['week'];
	$team = $_GET['team'];
	$commentspring = get_CommentsByWeek($week, $team);
	if($commentspring!=null){
		echo json_encode($commentspring);
	}
}
?>