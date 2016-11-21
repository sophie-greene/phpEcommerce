<?php  
	session_start(); 
	$_SESSION["login_error"] = ""; 
	$_SESSION["logged_in"] =  '';
	$_SESSION["customer_id"] = '';
	$_SESSION['basket']='';
	$_SESSION['amount']='';
	$_SESSION['message']='';
	 header("Location: index.php"); 
	?>