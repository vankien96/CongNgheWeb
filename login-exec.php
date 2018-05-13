<?php
	//Start session
	session_start();
	//Include database connection details
	require_once('connection/config.php');

	if (isset($_POST["email"]) && isset($_POST["password"])) {
		$email = $_POST["email"];
		$password = $_POST["password"];

		if($email != "" && $password != "") {
			$queryString = "SELECT * FROM members WHERE email='$email' AND password='".md5($_POST['password'])."'";
			$query = mysqli_query($db,$queryString);
			$result = mysqli_fetch_array($query);
			if ($result) {
				session_regenerate_id();
				$_SESSION['SESS_MEMBER_ID'] = $result['member_id'];
				$_SESSION['SESS_FIRST_NAME'] = $result['firstname'];
				$_SESSION['SESS_LAST_NAME'] = $result['lastname'];
				session_write_close();
				echo json_encode(["status"=>true,"message"=>"Username or Password invalid"]);
				exit();
			}else{
				echo json_encode(["status"=>false,"message"=>"Username or Password invalid"]);
			}
		} else {
			echo json_encode(["status"=>false,"message"=>"Username or Password invalid"]);
		}
	} else {
		echo json_encode([
			"status"=>false,
			"message"=>"Username or Password invalid"
		]);
	}
?>