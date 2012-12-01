<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

$scoreId = $_GET['scoreID'];

$scores = get_ScoreContent($scoreId);

if($scores!=null){
	$scores = my_urlencode_single($scores);
	echo urldecode(json_encode($scores));
}
?>