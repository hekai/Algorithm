<?php 
header("content-type:text/html; charset=utf-8");
require_once ('include/db_operator_class.php');

$type = $_GET['type'];
if($type!=null && $type==1){
	$probId = $_GET['probID'];
	$commentsprob = get_CommentsByProb($probId);
	if($commentsprob!=null){
		$commentsprob = my_urlencode_double($commentsprob);
		$json = urldecode(json_encode($commentsprob));
		echo $json;
	}
}else if($type!=null && $type==2){
	$week = $_GET['week'];
	$team = $_GET['team'];
	$commentspring = get_CommentsByWeek($week, $team);
	if($commentspring!=null){
		$commentspring = my_urlencode_double($commentspring);
		$json = urldecode(json_encode($commentspring));
		echo $json;
	}
}
?>