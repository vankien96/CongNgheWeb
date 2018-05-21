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
         $result = mysqli_query($db,"DELETE FROM messages WHERE message_id='$id'")
         or die("There was a problem while removing the message ... \n" . mysqli_error($db)); 
         
         // redirect back to the messages page
         header("Location: messages.php");
         }
     else
     // if id isn't set, redirect back to the messages page
     {
        header("Location: messages.php");
     }
 
?>