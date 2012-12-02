<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

$type = $_GET['type'];
if($type=='all'){
	$week = $_GET['week'];
	$level = $_GET['level'];
	if($level==null)
		$level=$_SESSION['team'];
	$problems = get_ProblemsOnWeek($week,$level);
	echo json_encode($problems);
}else if($type=='detail'){
	$probId = $_GET['probID'];
	$problems = get_ProblemContentById($probId);
	echo json_encode($problems);
}

?>
