<?php
include 'permission.php';
require_once ('include/db_operator_class.php');
$probID = $_POST['probID'];
$content = $_POST['content'];
$userID = $_POST['userID'];

if(isset($_POST['insert'])){
	add_CommentInProb($probID, $userID, $content);
	echo 'test1';
	echo $userID;
	echo $probID;
	echo $content;
}else if(isset($_POST['update'])){
	update_CommentInProb($probID, $content);	
	echo 'test2';
}


?>
