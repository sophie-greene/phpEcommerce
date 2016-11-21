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
    <h1>Register</h1>
    <form id="form1" name="form1" method="post" action="register_action.php" >
     <table align="center" >
     <tr>
       <td>
       <table align="center" >
         <tr>
           <td>
           <div align="right">
		   <?php  
			   if ($_SESSION['user_name_err'])
			   {
				   echo '<font color="#CC0000">User Name*:</font>';
				   $_SESSION['user_name_err']=FALSE;
				  } 
				  else 
				  {
					  if ($_SESSION['user_name_exists'])
					  {
						  print '<font color="#CC0000">username exists</font>';
						  $_SESSION['user_name_exists']=false;
					  }
					  else
					  {
						echo  '<font color="#000000">User Name*:</font>';
					  }
				} 
			?>
                 </div>
                 </td>
           <td><input name="username" type="text"  maxlength="30" /></td>
         </tr>
         <tr>
           <td>
           <div align="right">
           <?php  
		   if ($_SESSION['firstname_err'])
		   {
			   echo '<font color="#CC0000">First Name*:</font>';
			   $_SESSION['firstname_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000">First Name*:</font>';
				  } 
				  ?>
           </div>
           </td>
           <td><input name="firstname" type="text"  maxlength="30" /></td>
           
           <td>
           <?php  
		   if ($_SESSION['surname_err'])
		   {
			   echo '<font color="#CC0000">Surame*:</font>';
			   $_SESSION['surname_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000">Surname*:</font>';
			} 
				  ?>
           </td>
           
           <td><input name="surname" type="text"  maxlength="30" /></td>
         </tr>
         <tr>
           <td>
           <div align="right">
          
           <?php  
		   if ($_SESSION['email_err'])
		   {
			   echo '<font color="#CC0000"> Email*:</font>';
			   $_SESSION['email_err']=FALSE;
			  } 
			  else 
			  {
				   if ($_SESSION['email_exists'])
				  {
					  print '<font color="#CC0000">email exists</font>';
					  $_SESSION['email_exists']=false;
				  }
				  else
				  {
				  	echo  '<font color="#000000"> Email*:</font>';
				  }
				} 
				  ?>
           </div>
           </td>
           <td><input name="email" type="text" /></td>
         </tr>
         <tr>
           <td>
           <div align="right">
           
           <?php  
		   if ($_SESSION['cemail_err'])
		   {
			   echo '<font color="#CC0000"> Confirm email*:</font>';
			   $_SESSION['cemail_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000"> Confirm email*:</font>';
				} 
				  ?>
           </div>
           </td>
           <td><input name="cemail" type="text" /></td>
         </tr>
         <tr>
           <td>
           <div align="right">
      
          <?php  
		   if ($_SESSION['password_err'])
		   {
			   echo '<font color="#CC0000"> Password*:</font>';
			   $_SESSION['password_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000"> Password*:</font>';
				} 
				  ?>
           </div>
           </td>
           <td><input name="password" type="password"  /></td>
         </tr>
         <tr>
           <td>
           <div align="right">
           
           <?php  
		   if ($_SESSION['cpassword_err'])
		   {
			   echo '<font color="#CC0000"> confirm Password*:</font>';
			   $_SESSION['cpassword_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000"> Confirm Password*:</font>';
				} 
				  ?>
           </div>
           </td>
           <td><input name="cpassword" type="password"/></td>
         </tr>
         <tr>
           <td><div align="right"></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td><div align="left">Address</div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td height="27">
           <div align="right">
           
           <?php
           if ($_SESSION['address_line1_err'])
		   {
			   echo '<font color="#CC0000"> Line 1*:</font>';
			   $_SESSION['address_line1_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000"> Line 1*:</font>';
				} 
				  ?>
           </div>
           </td>
           <td><input name="address_line1" type="text"  maxlength="30" id="address_line1" /></td>
         </tr>

         <tr>
           <td >
           <div align="right">
             <?php
           if ($_SESSION['post_code_err'])
		   {
			   echo '<font color="#CC0000"> Post Code*:</font>';
			   $_SESSION['post_code_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000"> Post Code*:</font>';
				} 
				  ?>
           </div>
           </td>
           <td><input name="post_code" type="text"  maxlength="30"/></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
         <tr >
           <td colspan="4">
            <?php
           if ($_SESSION['agree_err'])
		   {
			   echo '<font color="#CC0000"> I agree to terms and conditions  (click the box to check)</font>';
			   $_SESSION['agree_err']=FALSE;
			  } 
			  else 
			  {
				  echo  '<font color="#000000"> I agree to terms and conditions  (click the box to check)</font>';
				} 
		?>
             <input name="agree" type="checkbox" id="agree" value="1" />
             <label for="agree"></label></td>
         </tr>
         <tr>
           <td ></td>
           <td><input type="image" src="images/btn_clear.gif" name="clear" id="clear" value="Clear" /></td>
           <td><input type="image" src="images/btn_submit.gif" name="submit" id="submit" value="Submit" /></td>
           <td>&nbsp;</td>
         </tr>
       </table></td>
     </tr>
     </table>
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
