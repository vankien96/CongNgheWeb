<?php
    //Start session
    session_start();
    
	//checking connection and connecting to a database
	require_once('connection/config.php');
	
 
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // delete the entry
         $result = mysqli_query($db,"UPDATE orders_details SET flag = '1' WHERE order_id='$id'")
         or die("There was a problem while deleting the order ... \n" . mysqli_error($db)); 
         
         // redirect back to the orders
         header("Location: orders.php");
     }
     else
        // if id isn't set, redirect back to the orders
     {
        header("Location: orders.php");
     }
 
?>