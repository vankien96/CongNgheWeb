<?php
	//Start session
	session_start();
	
	//Include database connection details
	// require_once('connection/config.php');
	include 'connection/config.php';
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;

	$login = $_POST['username'];
	$password = $_POST['password'];
	
	//Create query
	$qry="SELECT * FROM users WHERE username='$login' AND password='$password'";
	 $result = mysqli_query($db,$qry);
	 echo $username;
	//Check whether the query was successful or not
	if (mysqli_num_rows($result) > 0)  {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_ADMIN_ID'] = $member['id'];
			$_SESSION['SESS_ADMIN_NAME'] = $member['username'];
			session_write_close();
			header("location: index.php");
	}
	else {
			//Login failed
			header("location: login-failed.php");
	}
	
?>