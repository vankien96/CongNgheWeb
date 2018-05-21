<?php
	//checking connection and connecting to a database
	require_once('connection/config.php');

	if (isset($_POST['cart_id'])) {
		// get id value
		 $id = $_POST['cart_id'];
		 
		 // delete the entry
		 $result = mysqli_query($db,"DELETE FROM cart_details WHERE cart_id = '$id'");
		 if ($result) {
		 	echo json_encode(["status" => true, "message" => ""]);
		 } else {
		 	echo json_encode(["status" => false, "message" => "Có lỗi rồi nè."]);
		 }
	} else {
		echo json_encode(["status" => false, "message" => "Có lỗi rồi nè."]);
	}
?>