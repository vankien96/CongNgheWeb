<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('connection/config.php');
    
    //Sanitize the POST values
    $name = $_POST['name'];

    //Create INSERT query
    $qry = "INSERT INTO categories(category_name) VALUES('$name')";
    $result = mysqli_query($db,$qry);
    //Check whether the query was successful or not
    if($result) {
        header("location: categories.php");
    }else {
        die("Query failed " . mysqli_error($db));
    }
 ?>