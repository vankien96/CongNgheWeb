<?php
	require_once('auth.php');
	
	//Include database connection details
	require_once('connection/config.php');

    if (isset($_POST['cart_id']) && $_SESSION['SESS_MEMBER_ID']) {
    	$member_id = $_SESSION['SESS_MEMBER_ID'];
    	$qry_select = mysqli_query($db,"SELECT * FROM billing_details WHERE member_id='$member_id'");
    	if (mysqli_num_rows($qry_select)>0) {
    		$cart_id = $_POST['cart_id'];
    		$sql = "UPDATE cart_details SET flag = '1' WHERE cart_id = '$cart_id'";
    		$query = mysqli_query($db,$sql);

    		date_default_timezone_set("Asia/Bangkok"); //sets the default timezone for use
            
            $time_stamp = date("H:i:s"); //gets the current time
            
            $delivery_date = date("Y-m-d"); //gets the current date
	        
	     	$row = mysqli_fetch_array($qry_select);
	        $billing_id = $row['billing_id'];
	        $qry_create = "INSERT INTO orders_details(member_id,billing_id,cart_id,delivery_date,flag,time_stamp) VALUES('$member_id','$billing_id','$cart_id','$delivery_date','0','$time_stamp')";
	        mysqli_query($db,$qry_create);

            if ($qry_create && $query) {
    			echo json_encode(["status" => true, "billing" => false, "message" => "Đặt hàng thành công. Trong vài phút nữa chúng tôi sẽ gọi lại để xác nhận. Xin cảm ơn."]);
    		} else {
    			echo json_encode(["status" => false, "billing" => false, "message" => "Hệ thống đang gặp sự cố vui lòng thử lại trong giây lát."]);
    		}

    	} else {
    		echo json_encode(["status" => false , "billing" => true]);
    	}
    } else {
    	echo json_encode(["status" => false, "billing" => false, "message" => "Hệ thống đang gặp sự cố vui lòng thử lại trong giây lát."]);
    }
?>