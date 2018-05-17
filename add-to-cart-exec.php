<?php
	require_once("connection/config.php");
	session_start();

	if (isset($_POST['food_id']) && isset($_POST['quantity']) && isset($_POST['total']) && isset($_SESSION['SESS_MEMBER_ID'])) {
		$food_id = $_POST['food_id'];
		$quantity = $_POST['quantity'];
		$id = $_SESSION['SESS_MEMBER_ID'];
		$total = $_POST['total'];
		$sql = "INSERT INTO cart_details(member_id, food_id, quantity, total, flag) VALUES('$id', '$food_id', '$quantity', '$total', '0')";

		$result = mysqli_query($db, $sql);
		if($result) {
			echo json_encode(["status" => true, "message" => "Đặt hàng thành công"]);
		} else {
			echo json_encode(["status" => false, "message" => "Đã có lỗi xảy ra. Vui lòng thử lại nhé"]);
		}

	} else {
		echo json_encode(["status" => false, "message" => "Đã có lỗi xảy ra. Vui lòng thử lại"]);
	}
?>