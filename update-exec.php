<?php
	//checking connection and connecting to a database
	require_once('connection/config.php');
    session_start();
    if (isset($_POST['opassword']) && isset($_POST['password']) && isset($_SESSION['SESS_MEMBER_ID'])) {
        $opassword = $_POST['opassword'];
        $password = $_POST['password'];
        $id = $_SESSION['SESS_MEMBER_ID'];

        $sqlString = "SELECT * FROM members WHERE member_id='$id' AND password='".md5($opassword)."'";
        $check = mysqli_query($db, $sqlString);
        if (mysqli_fetch_array($check)) {
            $sqlString = "UPDATE members SET password='".md5($password)."' WHERE member_id='$id' AND password='".md5($opassword)."'";
            $result = mysqli_query($db, $sqlString);
            if ($result) {
                echo json_encode(["status" => true, "message" => ""]);
            } else {
                echo json_encode(["status" => false, "message" => "Không kết nối được tới server"]);
            }
        } else {
            echo json_encode(["status" => false, "message" => "Mật khẩu cũ không chính xác"]); 
        }
    } else {
        echo json_encode(["status" => false, "message" => "Đã xảy ra lỗi không xác định!"]); 
    }
?>