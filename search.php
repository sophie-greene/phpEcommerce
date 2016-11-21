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
    	<p>Search Results</p><br />
    	
        <?php 
			$cat=$_POST['cat'];
			$dvd=$_POST['dvd'];
			//remove white space from begining and end of string
			$dvd=trim($dvd);
			//remove all whitespace to simplify checking for valid characters
			$checkstring=preg_replace('/\s+/','',$dvd);
			
			//check for non printble characters
			
			if(  !ctype_punct ($checkstring) )
				{
					if(ctype_alnum($checkstring))
					{
						print '<p>Results for Category: '.$cat;
						print ' and DVD Title: '.$dvd.'</p>';
						
						//retrieve data from database and print it
						include ("inc/connection.php"); 
									
						// create query  
						$query = "SELECT Product.ProductId,Product.Name,Product.Description as pdsp,Product.ImageName,Product.rDate,Product.pformat,Product.`disc#`,Product.UnitPrice,Category.Description as cat FROM `Product`,Category WHERE Product.CategoryId=Category.CategoryId "; 
						//Check if there is an initial letter  
						if (!$dvd=="" && $cat=="")  
						{  
						 	//if there is, then amend the query 
							  $query = $query."  and upper(Product.Name)=upper('$dvd')";  
						}  
						if (!$cat==""&& $dvd=="" )
						{
							$query = $query." AND upper(Category.Description) = upper('$cat' )";
						}
						if (!$cat==""&& !$dvd=="" )
						{
							$query = $query." AND upper(Category.Description) = upper('$cat' )and upper(Product.Name)=upper('$dvd')";
						}
		
						// execute query  
						$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());  
						// see if any rows were returned  
						include ("inc/functions.php");
						// see if any rows were returned  
						if (mysql_num_rows($result) > 0) 
						{  
							// yes 
							
						   display($result);
						}
					else 
					{  
						// no  
						// print status message  
						echo "<p>No exact matches found!</p>"; 
						// create a MySQL REGEXP for the search: 
						
						$temp=substr( $_POST['dvd'],0,5);
						print "<p>you might be interested in the following:</p>";
						$query = "SELECT Product.ProductId,Product.Name,Product.Description as pdsp,Product.ImageName,Product.rDate,Product.pformat,Product.`disc#`,Product.UnitPrice,Category.Description as cat FROM `Product`,Category WHERE Product.CategoryId=Category.CategoryId ";  
						//Check if there is an initial letter  
						if (!$dvd=="" && $cat=="")  
						{  
						  //if there is, then amend the query 
						  $query = $query."  and (upper(Product.Name) like \"%$temp%\" or upper(Product.Description)like \"%$temp%\")";  
						}  
						if (!$cat==""&& $dvd=="" )
						{
							$query = $query." AND upper(Category.Description) = upper('$cat' )";
						}
						if (!$cat==""&& !$dvd=="" )
						{
							$query = $query." AND upper(Category.Description)= upper('$cat' )  and (upper(Product.Name) like    
\"%$temp%\" or upper(Product.Description)like \"%$temp%\")";
						}
		
						// execute query  
						$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());  
						// see if any rows were returned  
						if (mysql_num_rows($result) > 0) 
						{  
							// yes  
							display($result);
						}  
					}  
				}
			}
		elseif ($dvd=="")
		{
			print "no search term entered";
			
	}
		else
			{
				print ' DVD Title is invalid. please enter alphanumeric input </p>';
			}
				
		?>
	      
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
