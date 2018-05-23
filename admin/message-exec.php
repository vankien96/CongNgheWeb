<?php
	//checking connection and connecting to a database
	require_once('connection/config.php');

    date_default_timezone_set('Asia/Ho_Chi_Minh'); //sets the default timezone for use
    
    $current_date = date("Y-m-d"); //gets the current date
    
    $current_time = date("H:i:s"); //gets the current time
    
	//Sanitize the POST values
    $new_subject = $_POST['subject'];
	$new_message = $_POST['txtmessage'];
    
    $from = "administrator"; //sets default to the administrator (it can be changed if PM will be implemented in the future)
	
     // update the entry
     $result = mysqli_query($db,"INSERT INTO messages(message_from,message_date,message_time,message_subject,message_text) VALUES('$from','$current_date','$current_time','$new_subject','$new_message')")
     or die("Message sending failed ..." . mysqli_error($db)); 
 
     if($result){
         // redirect back to the messages page
         header("Location: messages.php");
         exit();
     }
     else
     // if not sent, give an error
     {
        die("Message sending failed ..." . mysqli_error($db));
     }
?>