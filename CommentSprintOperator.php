<?php
include 'permission.php';
require_once ('include/db_operator_class.php');
$content = $_POST['content'];

if(isset($_POST['insert'])){
	$userID = $_POST['userID'];
	$week = $_POST['week'];
	$team = $_POST['team'];
	add_CommentInSpring($week, $team, $userID, $content);
}else if(isset($_POST['update'])){
	$commentID=$_POST['commentID'];
	update_CommentInSpring($commentID, $content);	
}
?>