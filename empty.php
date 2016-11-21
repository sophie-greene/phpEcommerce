<?php  
	session_start(); 

	$_SESSION['basket']="";

	header('location: cart.php');
	?>