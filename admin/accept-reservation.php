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
     $result = mysqli_query($db,"UPDATE reservations_details SET flag = '1' WHERE ReservationID='$id'")
     or die("The reservation does not exist ... \n"); 
     
     // redirect back to the reservations 
     header("Location: reservations.php");
     }
     else
     // if id isn't set, redirect back to the reservations
     {
     header("Location: reservations.php");
     }
 
?>