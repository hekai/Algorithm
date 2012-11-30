<?php
require_once ('include/db_operator_class.php');
$code = $_POST['code'];
$ac = $_POST['ac'];
$language = $_POST['language'];

if(isset($_POST['insert'])){
	$userID = $_POST['userID'];
	$probID = $_POST['probID'];
	$language = $_POST['language'];
	add_Score($probID, $userID, $code, $ac, $language);
}else if(isset($_POST['update'])){
	$scoreID = $_POST['scoreID'];
	update_Score($scoreID, $code, $ac,$language);
}
?>