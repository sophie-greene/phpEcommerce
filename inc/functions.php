<?php
//Define a function . This takes a string and 
function display($array ) 
{ 
	$index=0;
	print"<table align='center' cellspacing=10px cellpadding=0>";
	print "<tr>";
	while($row = mysql_fetch_array($array)) 
	{  
		print"<td>";
        print "<table id='display' cellpadding =0>";  
        echo "<tr>";
        echo "<td colspan='2'><font weight=bold size=meduim color=red>".$row['Name']."</font></td>"; 
		echo "</tr><tr>";
		echo "<td >Price: <font weight=bold size=meduim color=red> &#163;".$row['UnitPrice']."</font></td>"; 
		echo"<td rowspan='3' width=30% height=30% align=right><img src='pro-image/".$row['ImageName'] ."'  ></img></td>";
		echo "</tr><tr>";
		echo "<td >Format: ".$row['pformat']."</td>"; 
		
		echo "</tr><tr>";
		echo "<td> Number of Discs:".$row['disc#']."</td>";
		echo "</tr><tr>";
		echo "<td colspan='2'> Description: ".$row['pdsp']."</td>";
		
		echo "</tr><tr>";
		print "<td colspan='2' >Rlease Date: ".$row['rDate']."</td>";
        
		echo "</tr><tr>";
		echo "<td> Product ID: ".$row['ProductId']."</td>";
		echo "<td><a href='shopping.php?id=".$row['ProductId']."'><img src='images/btn_buy.gif' /></a></td>";
		echo "</tr>";
        print "</table>";
		print "</td>";
		
		$index=$index+1;
		if ($index % 2 ==0 && $index!=0)
		{
			print "</tr><tr>";
		}
		
    }  
    echo "</table>";  
}

function displayCart($array ) 
{ 
	$index=0;
	print"<table align='center' cellspacing=10px cellpadding=0>";
	print "<tr>";
	while($row = mysql_fetch_array($array)) 
	{  

		print"<td>";
        print "<table id='display' cellpadding =0>";  
        echo "<tr>";
        echo "<td colspan='2'><font weight=bold size=meduim color=red>".$row['Name']."</font></td>"; 
		echo "</tr><tr>";
		echo "<td >Price: <font weight=bold size=meduim color=red> &#163;".$row['UnitPrice']."</font></td>"; 
		echo"<td rowspan='3' width=30% height=30% align=right><img src='pro-image/".$row['ImageName'] ."'  /></td>";
		echo "</tr><tr>";
		echo "<td >Format: ".$row['pformat']."</td>"; 
		
		echo "</tr><tr>";
		echo "<td> Number of Discs:".$row['disc#']."</td>";
		echo "</tr><tr>";
		echo "<td colspan='2'> Description: ".$row['pdsp']."</td>";
		
		echo "</tr><tr>";
		print "<td colspan='2' >Rlease Date: ".$row['rDate']."</td>";
        
		echo "</tr><tr>";
		echo "<td> Product ID: ".$row['ProductId']."</td>";
	
		echo "</tr>";
        print "</table>";
		print "</td>";
		
		$index=$index+1;
		if ($index % 2 ==0 && $index!=0)
		{
			print "</tr><tr>";
		}
		
    }  
    echo "</table>";  
} 

 // Show whether the user is logged in or not 
function getLogin() 
   {  
      // Check if we have established an authenticated session 
     if (($_SESSION['logged_in'])!="") 
     { 
       $_SESSION['message'] = 'Welcome '. $_SESSION['logged_in']; 
         
     } 
    else 
     { 
         $_SESSION['message'] = 'log in'; 
          
     } 
     return $_SESSION["message"]; 
    }
	//checks for valid email format
	function checkEmail($email)
	{
  		return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
	}
	
 // check number is greater than 0 and $length digits long
  // returns TRUE on success
  function checkNumber($num, $length)
  {
	  if($num > 0 && strlen($num) == $length)
		{
			return TRUE;
		}
	}
	
function errorCheck($string, $type, $length)
{

  // assign the type
  $type = 'is_'.$type;

  if(!$type($string))
    {
    return FALSE;
    }
  // now we see if there is anything in the string
  elseif(empty($string))
    {
    return FALSE;
    }
  // then we check how long the string is
  elseif(strlen($string) > $length)
    {
    return FALSE;
    }
  else
    {
    // if all is well, we return TRUE
    return TRUE;
    }
}

//displays the content of the shopping cart
function DisplayBasket($bas)
{
	//input is $bas a two dimentional basket array
	// $ bas contains the product id and the quantity
	//the rest of the information can be retrieved from the database
	
	//print table heading
	
	    echo "<table class= 'basket'>
				<tr><th>Product ID</th>
				<th>Product Name</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Sub-Total</th>
				<th></th>
				</tr>";
		//To find the Total price of the order 
        $total = 0; 
		//to store number of row
		$count=0;
		include ('connection.php');
        foreach ($bas as $basketItemArray) 
        { 
		//get product name and price
		
         $query='SELECT Name,UnitPrice FROM Product WHERE ProductId="'.$basketItemArray["id"].'"';
		 $result= mysql_query($query);
		$data=mysql_fetch_array($result);
		if ($data["UnitPrice"]!='')
		{
			
		$total=$total+($data["UnitPrice"]*$basketItemArray["quantity"]);
        print "<tr><td>".$basketItemArray["id"]."</td>". 
				  "<td>".$data["Name"]."</td>". 
				  "<td>&pound;".$data["UnitPrice"]."</td>".
				  "<td><select name='quantity' >".
          "<option value=1";
		 
			if ( $basketItemArray['quantity']==1) 
			{
				echo 'selected=\'selected\'';
			} 
				print ">1</option><option value=2 ";
	
			 if ($basketItemArray['quantity']==2) 
			 {
				 echo 'selected=\'selected\'';
			 }
				print  ">2</option> <option value=3";
				if ($basketItemArray['quantity']==3) 
				{
					echo 'selected=\'selected\'';
				} 
				print">3</option> <option value=4" ;
	
		  if ($basketItemArray['quantity']==4) 
		  {
			  echo 'selected=\'selected\'';
			  } 
		  print ">4</option><option value=5";
		
		if (strcmp($basketItemArray['quantity'],5)) {echo 'selected=\'selected\'';} 
        print ">5</option>          <option value=6";
		  
		  if ( $basketItemArray['quantity']==6) {echo 'selected=\'selected\'';} 
          print ">6</option> <option value=7";
		  
		  if ($basketItemArray['quantity']==7) {echo 'selected=\'selected\'';} 
          print ">7</option>
          <option value=8";
		 
		   if ( $basketItemArray['quantity']==8) {echo 'selected=\'selected\'';} 
           print ">8</option>
          <option value=9 ";
		  
		  if ( $basketItemArray['quantity']==9) {echo 'selected=\'selected\'';} 
          print ">9</option>
<option value=10";
 
 if ($basketItemArray['quantity']==10) {echo 'selected=\'selected\'';} 
 print ">10</option>
        </select></td>".
                  "<td>&pound;".$data["UnitPrice"]*$basketItemArray["quantity"]."</td>
				  <td><a href='amenditem.php?count=".$count."&quantity=".quantity.value."'><img src='images/btn_amend.gif' width='60%' height='60%' /></a></td>
				  <td><a href='deleteitem.php?count=".$count."'><img src='images/btn_delete.gif' width='60%' height='60%'/></a></td></tr>"; 
				   
		}
		$count=$count+1;	
        } //End for each item in the basket 
        //Print out the total 
		print '<tr><td colspan= "4" align="right"></td><td colspan="2" > Total= &pound;'.$total.'</td></tr>';
		//store total amount to pay
		$_SESSION['total']=$total;
         echo "</table>"; 	
}
function copybasket()
{
	
	include ("inc/connection.php");
	//add a new order with the customer details and delivery details
	//find the cart max number
	$query="select max(CartId) from ShoppingCart";
	$result= mysql_query($query);
	$data=mysql_fetch_array($result);
	$id=$data[0]+1;
	$_SESSION['basketID']=$id;
	//find delivery details- customer first line of address and post code
	$query="SELECT address_line1, address_post_code FROM Customer WHERE customer_id='".$_SESSION["customer_id"]."'";
	$result= mysql_query($query);
	$data=mysql_fetch_array($result);
	$address=$data[0];
	$postcode=$data[1];
	$date=getdate();


			$query = sprintf("INSERT INTO ShoppingCart (CartId,Dateof_Order, DelAddress, DelPostCode, CheckoutCompleted, CustomerID)
    		VALUES( '%s','%s', '%s','%s','%s','%s')",
			mysql_real_escape_string($id),
			mysql_real_escape_string($date),
			mysql_real_escape_string($address),
			mysql_real_escape_string($postcode),
			mysql_real_escape_string('N'),
			mysql_real_escape_string($_SESSION["customer_id"]));
			// run the query
			if(!mysql_query($query))
				{
				echo 'Query failed '.mysql_error();
				 exit();
				}
	//copy the temporary array basket into the mysql database shoppingcart and shoppingcartline
	foreach ($_SESSION['basket'] as $bas)
	{
		if ($bas!='')
		{
			$query = sprintf("INSERT INTO ShoppingCartLine (Quantity, ProductId,CartId)
				VALUES( '%s','%s', '%s')",
				mysql_real_escape_string($bas['quantity']),
				mysql_real_escape_string($bas['id']),			
				mysql_real_escape_string($id));
				// run the query
				if(!mysql_query($query))
					{
					echo 'Query failed '.mysql_error();
					 exit();
					}
		}
	}
}

?>
