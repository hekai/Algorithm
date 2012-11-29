<?php
require_once 'include/db_operator_class.php';
if(isset($_GET['userid'])) {
	$userId = $_GET['userid'];
	$query = "SELECT u.photo FROM user AS u where id=$userId";
	$result = mydb_query_return_first_item($query);
	$data = $result['photo'];
	$type = $result['photoType'];
	header( "Content-type: $type");
	echo $data;
}
echo 'getPhoto';
?>