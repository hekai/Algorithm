<?php
	session_start();
	unset($_SESSION['login']);
	unset($_SESSION['uid']);
	unset($_SESSION['userID']);
	unset($_SESSION['name']);
	unset($_SESSION['nickname']);
	unset($_SESSION['team']);
	unset($_SESSION['photoPath']);
	session_unset();
	 session_destroy();
	
	header('Location: login.php');
?>
