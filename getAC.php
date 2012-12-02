<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

$type = $_GET['type'];
if($type=='all'){
	$probID = $_GET['probID'];
	$scores = get_ScoresByProb($probID);
}else if($type=='detail'){
	$scoreID = $_GET['scoreID'];
	$scores = get_ScoreContent($scoreID);
	
}

if($scores!=null){
	echo json_encode($scores);
}

?>