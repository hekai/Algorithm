<?php
require_once 'include/db_operator_class.php';
if(isset($_GET['userID'])) {
	$userId = $_GET['userID'];
	$query = "SELECT u.photoPath,u.photoType FROM user AS u where id=$userId";
	$result = mydb_query_return_first_item($query);
	$data = $result['photoPath'];
// 	$type = $result['photoType'];
// 	header( "Content-type: $type");
	echo $data;
// 	echo urldecode(json_encode(urlencode($data)));
}
?>