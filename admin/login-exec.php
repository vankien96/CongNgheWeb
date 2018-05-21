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
	
	
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($str);
	}
	
	//Sanitize the POST values
	// $login = clean($_POST['login']);
	// $password = clean($_POST['password']);

	$login = $_POST['username'];
	$password = $_POST['password'];
	//Input Validations
	// if($login == '') {
	// 	$errmsg_arr[] = 'Username missing';
	// 	$errflag = true;
	// }
	// if($password == '') {
	// 	$errmsg_arr[] = 'Password missing';
	// 	$errflag = true;
	// }
	
	// //If there are input validations, redirect back to the login form
	// if($errflag) {
	// 	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	// 	session_write_close();
	// 	header("location: login-form.php");
	// 	exit();
	// }
	
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