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
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$FirstName = clean($_POST['fName']);
	$LastName = clean($_POST['lName']);
	$StreetAddress = clean($_POST['sAddress']);
	$MobileNo = clean($_POST['mobile']);
	

	//Create INSERT query
	$qry = "INSERT INTO staff(firstname,lastname,Street_Address,Mobile_Tel) VALUES('$FirstName','$LastName','$StreetAddress','$MobileNo')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		echo "<html><script language='JavaScript'>alert('Staff information added successifully.');
		location.replace(\"profile.php\");</script></html>";
		exit();
	}else {
		die("Adding staff information failed ... " . mysql_error());
	}
?>