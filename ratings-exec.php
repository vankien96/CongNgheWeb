<?php
	//Start session
	session_start();
	
	require_once('connection/config.php');
	if (isset($_SESSION['SESS_MEMBER_ID']) && isset($_POST['food_id']) && isset($_POST['rate'])) {
		$member_id = $_SESSION['SESS_MEMBER_ID'];
		$food_id = $_POST['food_id'];
		$rate = $_POST['rate'];

		$sqlCheck = "SELECT * FROM polls_details WHERE member_id = '$member_id' AND food_id='$food_id'";
		$checkQuery = mysqli_query($db, $sqlCheck);
		if (mysqli_fetch_array($checkQuery)) {
			$sqlUpdate = "UPDATE polls_details SET rate_id = '$rate' WHERE member_id = '$member_id' AND food_id = '$food_id'";
			$query = mysqli_query($db, $sqlUpdate);
			if ($query) {
				echo json_encode(["status" => true, "message" => ""]);
			} else {
				echo json_encode(["status" => false, "message" => "Đánh giá sản phẩm thất bại. Vui lòng thử lại trong chốc lát."]);
			}
		} else {
			$sqlInsert = "INSERT INTO polls_details(member_id,food_id,rate_id) VALUES('$member_id','$food_id','$rate')";
			$query = mysqli_query($db, $sqlInsert);
			if ($query) {
				echo json_encode(["status" => true, "message" => ""]);
			} else {
				echo json_encode(["status" => false, "message" => "Đánh giá sản phẩm thất bại. Vui lòng thử lại trong chốc lát."]);
			}
		}
	} else {
		echo json_encode(["status" => false, "message" => "Đánh giá sản phẩm thất bại. Vui lòng thử lại trong chốc lát."]);
	}
?>