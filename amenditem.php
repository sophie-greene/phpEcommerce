<?php  
	session_start(); 
	$count=$_GET['count'];
	$quantity=$_GET['quantity'];
	settype($count, "integer"); 
	
	
	$_SESSION['basket'][$count]["quantity"]=$quantity;

	header('location: cart.php');
	?>