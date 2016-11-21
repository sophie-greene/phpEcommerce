<?php  
session_start(); 
include ('inc/functions.php'); //This includes some common functions 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Online movie store</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--


-->
</style>
</head>
<body>
<div id="wrapper">
  <div id="inner">
    <div id="header" >
<div id="logged" align="left">
<?php
				//Show login status 
				
				if (getLogin()=='log in')
				{
					$_SESSION["login_error"] = "To be able to view shopping cart you need to login" ; 
               		header("Location: login.php"); 
					//print '<a href="login.php">'.getLogin().'</a>'; 
				}
				else
				{
					
					print getLogin();
					print '<br><br>';
					print '<a href="logout_action.php">logout</a>';
				}
			 ?>
</div>
   	  <h1 align="center">e-Movie Shop</h1>
      <div id="cart" align="left"><a href="cart.php"><font  size="2">shopping Cart</font></a> </div>
    </div>
    
    <!-- end nav -->
    <div id="navigation" align="right">
      <table  cellspacing="5" width="553px" >
        <tr>
          <td ><a href="index.php">Home</a></td>
          <td><a href="product.php">Products</a></td>
          <td><a href="contactus.php">Contact Us</a></td>
          <td><a href="register.php">Register</a></td>
        </tr>
      </table>
    </div>
    <dl id="browse">
      <dt>Full Category Lists</dt>
      <dd class="first"><a href="product.php?category=action">Action</a></dd>
      <dd><a href="product.php?category=Classics">Classics</a></dd>
      <dd><a href="product.php?category=Comedy">Comedy</a></dd>
      <dd><a href="product.php?category=Drama">Drama</a></dd>
      <dd class="last"><a href="product.php?category=Horror">Horror</a></dd>
      <dt>Search Your Favourite Movie</dt>
       <form action="search.php" method="POST" style="background:#227293;">
       	<table>
        <tr>
            <td><font color=white><strong>Category:<strong></font></td>
         </tr>
         <tr>
            <td>
            <select name="cat">
            <option value="" selected="selected">All</option>
            <option value="Action">Action</option>
            <option value="Classics">Classics</option>
            <option value="Comedy">Comedy</option>
            <option value="Drama">Drama</option>
            <option value="Horror">Horror</option>
            </select>
         </tr>
         <tr>
    		<td><font color=white><strong>DVD TITLE:<strong></font></td>
         </tr>
         <tr>
 		 	<td><input name="dvd" type="text" class="text" id="dvd" /></td>
         </tr>
         <tr>  
        		<td><input type="image" src="images/btn_search.gif"/></td>
        </table>
      </form>
    </dl>
    <div id="body">
		<h1>Checkout</h1>
<p> 
  <?php   
   //The customer must log on to use this page . retrieve full name for customer
   
  echo "<h2>Shopping cart for ". . $_SESSION['logged_in'] . "</h2>"; 
  //See if the user has started shopping yet 
  if (empty($_SESSION["basket"])) 
  { 
    echo "<h3>Your cart is empty</h3>"; 
  } 
  else //the temporary order is copied to the database
  { 
  		
		//displays the cart stored in the database
		displaycart($_SESSION["basket"]);

?> 
</p> 

    </div>
    <!-- end body -->
    <div class="clear"></div>
    <div id="footer"> Designed by <a href="">Somoud Saqfelhait</a> </div>
    <!-- end footnav -->
  </div>
  <!-- end footer -->
</div>
<!-- end inner -->
  </div><!-- end wrapper -->
</body>
</html>
