<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	
	if(isset($_SESSION['SESS_MEMBER_ID'])) {
		$member_id = $_SESSION['SESS_MEMBER_ID'];
		$check = false;
		$partyhall_id = 0;
	    $table_id = 0;
	    $partyhall_flag = 0;
	    $table_flag = 0;
	    $date = "";
	    $time = "";
		if (isset($_POST['table']) && isset($_POST["date"]) && isset($_POST["time"])) {
			$table_id = $_POST['table'];
			$check = true;
			$table_flag = 1;
			$date = $_POST["date"];
			$time = $_POST["time"];
		}
		if (isset($_POST['partyhall']) && isset($_POST["date"]) && isset($_POST["time"])) {
			$partyhall_id = $_POST['partyhall'];
			$partyhall_flag = 1;
			$date = $_POST["date"];
			$time = $_POST["time"];
			$check = true;
		}
		if ($check) {
			$qry = "INSERT INTO reservations_details(member_id,table_id,partyhall_id,Reserve_Date,Reserve_Time,table_flag,partyhall_flag) VALUES('$member_id','$table_id','$partyhall_id','$date','$time','$table_flag','$partyhall_flag')";
			$result = mysqli_query($db,$qry);
			if ($result) {
				echo json_encode(["status" => true, "message" => ""]);
			} else {
				echo json_encode(["status" => false, "message" => "Đã có lỗi xảy ra. Xin vui lòng thử lại trong giây lát"]);
			}
		} else {
			echo json_encode(["status" => false, "message" => "Đã có lỗi xảy ra. Xin vui lòng thử lại trong giây lát"]);
		}
	} else {
		echo json_encode(["status" => false, "message" => "Đã có lỗi xảy ra. Xin vui lòng thử lại trong giây lát"]);
	}
?>