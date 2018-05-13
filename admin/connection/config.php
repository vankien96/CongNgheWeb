<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'congngheweb');
    //Connect to mysql server
    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    mysqli_query($db, "set names 'utf8'");
    if(!$db) {
        die("Unable to select database");
    }
?>