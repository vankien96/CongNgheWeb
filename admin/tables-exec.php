<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('connection/config.php');
 
    //Sanitize the POST values
    $name = $_POST['name'];
    //Create INSERT query
    $qry = "INSERT INTO tables(table_name) VALUES('$name')";
    $result = @mysqli_query($db,$qry);
    
    //Check whether the query was successful or not
    if($result) {
        header("location: reservation.php");
        exit();
    }else {
        die("Query failed " . mysqli_error($db));
    }
 ?>