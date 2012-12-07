<?php
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'Algorithm');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');
/** MySQL hostname */
define('DB_HOST', 'localhost');

function mydb_query_without_return($query){
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET time_zone = '+8:00'");
	mysql_query($query);
	$insert_id = mysql_insert_id();
	mysql_close($connection);
	return $insert_id;
}

function mydb_query_return_double_array($query){
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET time_zone = '+8:00'");
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

function mydb_query_return_first_item($query){
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET time_zone = '+8:00'");
	$result = mysql_query($query);
	if(!$result){
		die("Could not query the database:<br/>".mysql_error());
	}
	$result_array = mysql_fetch_array($result,MYSQL_ASSOC);
	mysql_close($connection);
	return $result_array;
}
?>
