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
    <h1>Thank you</h1>
<?php
		$user_name= $_POST["username"];
		$firstname=$_POST["firstname"];
		$surname=$_POST["surname"];
		$email=$_POST["email"];
		$cemail=$_POST["cemail"];
		$password=$_POST["password"];
		$cpassword=$_POST["cpassword"];
		$address_line1=$_POST["address_line1"];
		
		$address_post_code=$_POST["post_code"];
		$agree=$_POST["agree"];
		$errors = false;
		$_SESSION['user_name_err']=false;
		$_SESSION['firstname_err']=false;
		$_SESSION['surname_err']=false;
		$_SESSION['email_err']=false;
		$_SESSION['cemail_err']=false;
		$_SESSION['password_err']=false;
		$_SESSION['cpassword_err']=false;
		$_SESSION['address_line1_err']=false;
		$_SESSION['post_code_err']=false;
		include("inc/functions.php");
		include ("inc/connection.php");
		if ($agree=='unchecked')
		{
			$_SESSION['agree_err']=true;
			$errors=true;
		}
		if (!errorCheck($user_name,"string",12))
		{          
			$_SESSION['user_name_err']=true;
			$errors = true;
			  // There are errors.  Relocate back to the client form 
		
		}
		if (!errorCheck($firstname,"string",10))
		{
			$_SESSION['firstname_err']=true;
			$errors = true;
		}
		if (!errorCheck($surname,"string",15))
		{
			$_SESSION['surname_err']=true;
			$errors = true;
		}
		
		if (!checkEmail($email))
		{
			$_SESSION['email_err']=true;
			$errors = true;
		}
		
		if ($email!=$cemail || empty($cemail))
		{
			$_SESSION['cemail_err']=true;
			$errors = true;
		}
		if (!errorCheck($password,'string',12))
		{
			$_SESSION['password_err']=true;
			$errors = true;
		}
		
		if ($cpassword!=$password || empty($cpassword))
		{
			$_SESSION['cpassword_err']=true;
			$errors = true;
		}
		
		if (!errorCheck($address_line1,'string',10))
		{
			$_SESSION['address_line1_err']=true;
			$errors = true;
		}
		if (!errorCheck($address_post_code,'string', 6))
		{
			$_SESSION['post_code_err']=true;
			$errors = true;
		}
		
				
		if ($errors){
			//Go back to the form
			
			header("Location: register.php"); 
		
		}	
		//if all required information is filled and in the correct format, write info for database
		else
		{
			
			//check if username  already registered
			$query="select count(*) from Customer where upper(user_name)=upper('".$user_name."')";
			$result=mysql_query($query);
			$count = mysql_fetch_row($result); 
			if($count[0]>0)
			{
				$_SESSION['user_name_exists']=TRUE;
				header("Location: register.php"); 
			
			}	
			else
			{
				$_SESSION['user_name_exists']=FALSE;
			}
			//check if email already registered
			$query="select count(*)from Customer where upper(email)=upper('".$email."')";
			$result=mysql_query($query);
			$count = mysql_fetch_row($result); 
			if($count[0]>0)
			{
				$_SESSION['email_exists']=TRUE;
				header("Location: register.php"); 
			
			}	
			else
			{
				$_SESSION['email_exists']=FALSE;
			}

			//use escape characters to make sure the database is secure
			//find id
			$query="select max(customer_id) from Customer";
			
			$result= mysql_query($query);
			$data=mysql_fetch_array($result);
			$id=$data[0]+1;
			
			$query = sprintf("INSERT INTO Customer (customer_id,firstname, surname, user_name, email, password, address_line1,  address_post_code)
    		VALUES( '%s','%s', '%s','%s','%s','%s','%s','%s')",
			mysql_real_escape_string($id),
			mysql_real_escape_string($firstname),
			mysql_real_escape_string($surname),
			mysql_real_escape_string($user_name),
			mysql_real_escape_string($email),
			mysql_real_escape_string($password),
			mysql_real_escape_string($address_line1),
			mysql_real_escape_string($address_post_code));
			// run the query
			if(!mysql_query($query))
				{
				echo 'Query failed '.mysql_error();
				 exit();
				}
			  else
				{
				$subject = 'Submission';
				$msg= 'Thank you for submitting your information';
				mail ($email,$subject,$msg);
				}


		}
		
	?>
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
