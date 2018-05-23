<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('connection/config.php');

    //Sanitize the POST values
    $name = $_POST['name'];
    //define a default value for flag
    $flag_0 = 0;

    //Create INSERT query
    $qry = "INSERT INTO ratings(rate_name) VALUES('$name')";
    $result = @mysql_query($qry);
    
    //Check whether the query was successful or not
    if($result) {
        header("location: options.php");
        exit();
    }else {
        die("Query failed " . mysql_error());
    }
 ?>