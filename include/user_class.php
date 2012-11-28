<?php
require_once ('config.php');

function get_Users() {
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	$query = "SELECT * FROM USER";
	$result = mysql_query($query);
	if(!$result){
		die("Could not query the database:<br/>".mysql_error());
	}
	$result_array=array();
	while($tmp = mysql_fetch_array($result,MYSQL_ASSOC)){
		$result_array[] = $tmp;
	}
	mysql_close($connection);
	return $result_array;
}

function get_UserById($id) {
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	$query = "SELECT * FROM USER where id = $id LIMIT 1";
	$result = mysql_query($query);
	if(!$result){
		die("Could not query the database:<br/>".mysql_error());
	}
	$result_array = mysql_fetch_array($result,MYSQL_ASSOC);
	mysql_close($connection);
	return $result_array;
}

function get_UserByEmail($email) {
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	$query = "SELECT * FROM USER where mail = $email LIMIT 1";
	$result = mysql_query($query);
	if(!$result){
		die("Could not query the database:<br/>".mysql_error());
	}
	$result_array = mysql_fetch_array($result,MYSQL_ASSOC);
	mysql_close($connection);
	return $result_array;
}
?>