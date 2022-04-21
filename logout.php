<?php

	session_start();
	
	require_once 'connector.php';
	if (!isset($_SESSION['User_id'])) {
		header("Location: index.php");
	} 
	
	if (isset($_GET['logout'])&&isset($_SESSION['User_id'])) {

		unset($_SESSION['User_id']);
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit;
	}
	
	?>
