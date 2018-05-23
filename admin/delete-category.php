<?php
    //Start session
    session_start();
    
    //checking connection and connecting to a database
    require_once('connection/config.php');
  
    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of category and Sanitize the POST values
          $category_id = $_POST['category'];
         // delete the entry
         $result = mysqli_query($db,"DELETE FROM categories WHERE category_id='$category_id'")
         or die("There was a problem while deleting the category ... \n" . mysqli_error($db)); 
         
         // redirect back to options
         header("Location: categories.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: categories.php");
         }
     
 
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // delete the entry
         $result = mysqli_query($db,"DELETE FROM categories WHERE category_id='$id'")
         or die("There was a problem while deleting the category ... \n" . mysqli_error($db)); 
         
         // redirect back to the categories
         header("Location: categories.php");
     }
     else
        // if id isn't set, redirect back to the categories
     {
        header("Location: categories.php");
     }
 
?>