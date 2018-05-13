<?php
	//Start session
	session_start();
	require_once('connection/config.php');

    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['question']) && isset($_POST['answer'])) {
    	$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
	    $question_id = $_POST['question'];
	    $answer = $_POST['answer'];

    	$qry_select="SELECT * FROM members WHERE email='$email'";
	    $result_select = mysqli_query($db, $qry_select);
	    if(mysqli_num_rows($result_select)>0){
	        echo json_encode(["status" => false, "message" => "Email đã tồn tại"]);
	        exit();
	    } else {
		    //Create INSERT query
		    $qry = "INSERT INTO members(firstname, lastname, email, password, question_id, answer) VALUES('$fname','$lname','$email','".md5($_POST['password'])."','$question_id','".md5($_POST['answer'])."')";
		    $queryResult = mysqli_query($db, $qry);
		    if($queryResult) {
		    	$qry_select="SELECT * FROM members WHERE email='$email'";
		    	$queryResult = mysqli_query($db, $qry_select);
		    	$result = mysqli_fetch_array($queryResult);
		    	session_regenerate_id();
				$_SESSION['SESS_MEMBER_ID'] = $result['member_id'];
				$_SESSION['SESS_FIRST_NAME'] = $result['firstname'];
				$_SESSION['SESS_LAST_NAME'] = $result['lastname'];
				session_write_close();
			    echo json_encode(["status" => true, "message" => ""]);
			    exit();
		    }else {
			    echo json_encode(["status" => false, "message" => "Có lỗi xảy ra trong quá trình đăng ký tài khoản mới. Vui lòng thử lại"]);
			    exit();
		    }
	    }
    } else {
    	echo json_encode(["status" => false, "message" => "Có lỗi xảy ra trong quá trình đăng ký tài khoản mới. Vui lòng thử lại"]);
    	exit();
    }
?>