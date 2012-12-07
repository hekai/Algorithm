<?php
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once ('include/db_operator_class.php');

if(isset($_GET['userID'])){
	$userID=$_GET['userID'];
	
}
?>