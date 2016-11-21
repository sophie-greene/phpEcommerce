<?php 
session_start(); 
include_once  'inc/connection.php';  

$id = $_POST["id"]; 
$quantity = $_POST["quantity"]; 


if (empty($_SESSION["basket"] )) { 
  $_SESSION["basket"] = array( 
                              array("id"=>$id,"quantity"=>$quantity) ) ; 
}//End create basket 
else { 
  array_push ($_SESSION["basket"], array("id"=>$id, "quantity"=>$quantity  )); 
 } 
      // using the HTTP response header "Location:" 
     
     header("Location: product.php"); 
      exit; 

?> 