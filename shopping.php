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
					
					print '<a href="login.php">'.getLogin().'</a>'; 
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
    	<p>Shopping Basket</p>
    	<p><br />
    	  <?php
				
			include ("inc/connection.php");
			$id=$_GET['id'];
			//check if item is already in the cart and offer to ammend the quantity
			if ($_SESSION['id']!='')
			{
				print "<p>This item is already in the Cart, if you would like to change the quantity you are ordering please do and then click confirm. otherwise click cancel or navigate away</p>"
			}
			$query="SELECT Product.ProductId,Product.Name,Product.Description as pdsp,Product.ImageName,Product.rDate,Product.pformat,Product.`disc#`,Product.UnitPrice FROM `Product` WHERE ProductID='".$id."'";
			// execute query  
			$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());  
			// see if any rows were returned  
			if (mysql_num_rows($result) > 0) 
			{  
				// yes  
				displayCart($result);
			}  
?>
      <form action="addcart.php"  method="post" name="cart">
              
        <label>Choose number of items to be ordered:</label>
<select name="quantity" >
                  <option value="1" <?php if (!(strcmp(1, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>1</option>
                  <option value="2" <?php if (!(strcmp(2, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>2</option>
                  <option value="3" <?php if (!(strcmp(3, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>3</option>
                  <option value="4" <?php if (!(strcmp(4, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>4</option>
                  <option value="5" <?php if (!(strcmp(5, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>5</option>
                  <option value="6" <?php if (!(strcmp(6, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>6</option>
                  <option value="7" <?php if (!(strcmp(7, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>7</option>
                  <option value="8" <?php if (!(strcmp(8, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>8</option>
                  <option value="9" <?php if (!(strcmp(9, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>9</option>
                  <option value="10" <?php if (!(strcmp(10, "$_SESSION[\'basket\'][\'quantity\']"))) {echo "selected=\"selected\"";} ?>>10</option>
                </select>
             <input name="id" type="hidden" value= <?php print "'.$id.'"; ?>/><br>
			 <label>To add to shopping basket click confirm otherwise click cancel</label>
			
              <table align="right">
			  <tr>
			 <td><input type="image" src=images/btn_cancel.gif name="clear" id="clear" value="Clear" /></td>
           <td><input type="image" src=images/btn_continue.gif name="submit" id="submit" value="Submit" /></td>
				</tr>
              </table>
      </form>
	        
				
			
    	  
  	  </p>
    	<form id="form1" name="form1" method="post" action="">
   	  </form>
<p>&nbsp;</p>
    </div>
    <!-- end body -->
    <div class="clear"></div>
    <div id="footer"> Designed by <a href="index.php">Somoud Saqfelhait</a> </div>
    <!-- end footnav -->
  </div>
  <!-- end footer -->
</div>
<!-- end inner -->
  </div><!-- end wrapper -->
</body>
</html>
