<?php
require_once ('include/db_operator_class.php');
$probID = $_POST['probID'];
$content = $_POST['content'];

if(isset($_POST['insert'])){
	$userID = $_POST['userID'];
	add_CommentInProb($userID, $probID, $content);
}else if(isset($_POST['update'])){
	update_CommentInProb($probID, $content);	
}
?>