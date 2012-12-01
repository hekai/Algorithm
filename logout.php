<?php
	unset($_SESSION['login']);
	unset($_SESSION['userID']);
	unset($_SESSION['name']);
	unset($_SESSION['nickname']);
	unset($_SESSION['photoPath']);
	
	header('Location: login.php');
?>