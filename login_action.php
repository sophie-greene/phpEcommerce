<?php  
session_start(); 
include ('inc/functions.php'); //This includes some common functions 

          // Get the data collected from the user 
           $username =$_POST["username"]; 
           $password_input =$_POST["password"]; 
           //Display any login errors from last time 
           $_SESSION["login_error"] = ""; 
          // $username = trim($username); 
           //Escape bad chars 
          // $username=  addslashes($username); 
           //$password_input = trim($password_input); 
          // $password_input = addslashes($password_input); 
           if (empty($username) or empty($password_input))  
           { 
               $_SESSION["login_error"] = "Must enter Username and Password " ; 
               header("Location: login.php"); //This sets the redirection information 
               exit; //Ends the script and redirects to above 
           } 
           include ("inc/connection.php");
           //Need some security 
            
          $query = "SELECT * FROM Customer WHERE user_name = '$username' AND  password = '$password_input' ";  
           $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());  
            // see if any rows were returned  
            if (mysql_num_rows($result) > 0) {  
                //Success set some details 
                $row = mysql_fetch_array($result); 
                $_SESSION["logged_in"] =  $row["user_name"]; //for displaying on pages 
                $_SESSION["customer_id"] = $row["customer_id"]; //Used in checking out 
                 header("Location: index.php"); 
            }  
            else  
              { 
               $_SESSION["login_error"] = "Could not log you in using $username" ; 
               header("Location: login.php"); 
              }     
        ?> 

