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
					$_SESSION["login_error"] = "To be able to view payment you need to login" ; 
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
    <h1 align="center"> Check Out - Payment Details </h1>
	 
	    <?php 
    echo "<p>Payment details for ". $_SESSION["logged_in"] . "</p>"; 
    //Get any errors from last time if there were any 
    if (!empty($_GET["error"])) 
    { 
       echo $_GET["error"]; 
    }    
 ?>

	  <form action='processPayment.php' method='post'> 
	    <table class='basket'> 
        <tr>
          <td>Total To Pay</td>
          <td><input type='text' name='total' readonly='yes' style= "width:100%;" value=<?php print $_SESSION["total"];?>  /></td></tr> 
        <tr><td  >Credit card type</td>
        <td ><select name="creditcardtype" style= "width:100%;">
          <option value="VISA" selected="selected">Visa</option>
          <option value="MASTER">Master Card</option>
          <option value="SOLO">Solo</option>
          <option value="MAESTRO">Maestro</option>
        </select></td></tr> 
        <tr><td >Name on Card</td> 
    	<td ><input type='text' name='creditCard' style= "width:100%;"/></td></tr> 
    	<tr><td >Credit card number</td> 
    	<td ><input type='text' name='creditCard' style= "width:100%;"/></td></tr> 
    	<tr>
      	<td>Expiry Date(mm/yy)</td><td><input type='text' name='expiry' style= "width:100%;"/></td> 
    </tr>
    	<tr align="right">
    	  <td>&nbsp;</td>
    	  <td align="right"><input type="image" src="images/btn_pay.gif" align="right"/></td>
  	  </tr> 
    
        </table>
	  </form></p> 
      <p>Alternatively you can use your paypal account to pay the total amount</p>
      <p>To do so please click on the paypal image below:</p>
      <p>
        <?php 
//Variables have already been collected previously 
$business = "e-movies@yahoo.com"; 
$item_name = "Great Movies to beat recession"; 
$currency_code = "GBP"; 
$amount = $_SESSION['total']; 
?>
      </p>
      <form action="https://www.paypal.com/uk/cgi-bin/webscr" method="post"> 
  <input type="hidden" name="cmd" value="_xclick"> 
  <input type="hidden" name="business" value=<?php print $business; ?>> 
  <input type="hidden" name="item_name" value="<?php print $item_name; ?>"> 
  <input type="hidden" name="currency_code" value=<?php print $currency_code ;?>> 
  <input type="hidden" name="amount" value=<?php print $amount; ?>>
  <input alt="Make payments with PayPal - it's fast, free and secure!" src="images/paynow.gif" type="image" name="submit" />
</form> 

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
