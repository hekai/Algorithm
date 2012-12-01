<?php 
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

// echo '<h3>add_Problem </h3>';
// add_Problem(1, 1000, 'Hello add_Problem', 1);
$probId = $_GET['probID'];
$problems = get_ProblemContentById($probId);

if($problems!=null){
	$problems = my_urlencode_single($problems);
	echo urldecode(json_encode($problems));
}

?>
