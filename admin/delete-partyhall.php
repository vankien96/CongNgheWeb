<?php
    //Start session
    session_start();
    
    //checking connection and connecting to a database
    require_once('connection/config.php');

    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of partyhall and Sanitize the POST value
          $partyhall_id = $_POST['partyhall'];

         // delete the entry
         $result = mysqli_query($db,"DELETE FROM partyhalls WHERE partyhall_id='$partyhall_id'")
         or die("There was a problem while deleting the partyhall ... \n" . mysqli_error($db)); 
         
         // redirect back to options
         header("Location: options.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: options.php");
         }
?>