<?php
	//checking connection and connecting to a database
	require_once('connection/config.php');
	session_start();
	
     // check if the 'id' variable is set in URL
     if (isset($_SESSION['SESS_ADMIN_ID']) && isset($_POST['opassword']) && isset($_POST['npassword']) && isset($_POST['cpassword'])) {
         // get id value
        $id = $_SESSION['SESS_ADMIN_ID'];
        $oldPassword = $_POST['opassword'];
		$newPassword = $_POST['npassword'];
		$confirmNewPassword = $_POST['cpassword'];
        
        if ($newPassword == $confirmNewPassword) {
        	$result = mysqli_query($db, "UPDATE users SET password='$newPassword' WHERE id='$id' AND password='$oldPassword'")
       		or die("The admin does not exist ... \n". mysql_error());
       		if ($result) {
       			header("Location: index.php");
       		} else {
       			die("Mật khẩu cũ không đúng");
       		}
        } else {
        	die("Nhập lại mật khẩu không trùng khớp");
        }
     } else {
        die("Password changing failed ..." . mysql_error());
     }
?>