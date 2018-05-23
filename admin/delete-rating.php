<?php
    //Start session
    session_start();
    
    //checking connection and connecting to a database
    require_once('connection/config.php');
    
    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of currency and Sanitize the POST value
          $rate_id = $_POST['rating'];
         // delete the entry
         $result = mysqli_query($db,"DELETE FROM ratings WHERE rate_id='$rate_id'")
         or die("There was a problem while deleting the rate name ... \n" . mysqli_error($db)); 
         
         // redirect back to options
         header("Location: index.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: index.php");
         }
?>