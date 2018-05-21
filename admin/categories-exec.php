<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('connection/config.php');
    
    
    
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($str);
    }
    
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