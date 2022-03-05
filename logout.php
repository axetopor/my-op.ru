<?php

	session_start();
	
	if (!isset($_SESSION['owner_id'])) {
		header("Location: index.php");
	} else if(isset($_SESSION['owner_id'])!="") {
		header("Location: home.php");
	}
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['owner_id']);
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit;
	}