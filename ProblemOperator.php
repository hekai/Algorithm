<?php
include 'permission.php';
require_once ('include/db_operator_class.php');
$title = $_POST['title'];
$pojID = $_POST['pojID'];
$content = $_POST['content'];
$source = $_POST['source'];

if(isset($_POST['insert'])){
	$userID = $_POST['userID'];
	$week = $_POST['week'];
	add_Problem($userID, $pojID, $title, $content, $week, $source);
}else if(isset($_POST['update'])){
	$probID = $_POST['probID'];
	update_ProblemContent($probID,$pojID, $title, $content, $source);
}
?>