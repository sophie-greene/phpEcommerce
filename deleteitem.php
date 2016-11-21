<?php  
	session_start(); 
	$count=$_GET['count'];
	settype($count, "integer"); 
	
	
	$_SESSION['basket'][$count]="";

	header('location: cart.php');
	?>