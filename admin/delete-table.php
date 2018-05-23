<?php
    //Start session
    session_start();
    
    //checking connection and connecting to a database
    require_once('connection/config.php');

    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of table and Sanitize the POST value
         $table_id = $_POST['table'];
         // delete the entry
         $result = mysqli_query($db,"DELETE FROM tables WHERE table_id='$table_id'")
         or die("There was a problem while deleting the table ... \n" . mysqli_error($db)); 
         
         // redirect back to options
         header("Location: reservations.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: reservations.php");
         }
?>