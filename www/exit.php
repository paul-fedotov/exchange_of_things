<?php
	session_start(); 
	session_destroy();
	unset($_COOKIE['id']);
	header("Location: index.php");
?>