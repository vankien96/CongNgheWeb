<?php
	//Start session
	session_start();
	require_once('connection/config.php');

	if (isset($_POST['address']) && isset($_POST['city']) && isset($_POST['phone']) && isset($_SESSION['SESS_MEMBER_ID'])) {
		$address = $_POST['address'];
		$city = $_POST['city'];
		$phone = $_POST['phone'];
		$id = $_SESSION['SESS_MEMBER_ID'];

		$sql = "SELECT * FROM billing_details WHERE member_id='$id'";
		$result = mysqli_query($db, $sql);
		if (mysqli_fetch_array($result)) {
			$sql = "UPDATE billing_details SET address = '$address', city = '$city', phone = '$phone' WHERE member_id = '$id'";
			$result = mysqli_query($db, $sql);
			if ($result) {
				echo json_encode(["status" => true, "message" => ""]);
			} else {
				echo json_encode(["status" => false, "message" => "Không thể cập nhật dữ liệu"]);
			}
		} else {
			$qry = "INSERT INTO billing_details(member_id,address,city,phone) VALUES('$id','$address','$city','$phone')";
			$result = mysqli_query($db, $qry);
			if ($result) {
				echo json_encode(["status" => true, "message" => ""]);
			} else {
				echo json_encode(["status" => false, "message" => "Không thể thêm dữ liệu"]);
			}
		}
	} else {
		echo json_encode(["status" => false, "message" => "Đã xảy ra lỗi không xác định!"]);
	}
?>