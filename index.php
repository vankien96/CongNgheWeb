<?php
	//checking connection and connecting to a database
	include_once('connection/config.php');
  session_start();
  if (isset($_SESSION['SESS_MEMBER_ID'])) {
    header("Location:member-index.php");
  }
	//retrieve questions from the questions table
	$questions = mysqli_query($db, "SELECT * FROM questions");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Trang chủ</title>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
  <script type="text/javascript">
    function checkLogin() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      $.ajax({
        url: "login-exec.php",
        method: "POST",
        data: {
          email: email,
          password: password
        },
        success: function(response) {
          var dataRes = JSON.parse(response);
          if (dataRes.status) {
            window.open ('member-index.php','_self',false);
          } else {
            var ele = "<p class='text-danger'>"+dataRes.message+"</p>";
            $('#error').html(ele);
          }
        }
      })
    }
  </script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <div id="page" align="center">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">LK Restaurant</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Trang chủ</a></li>
          <li><a href="foodzone.php">Khu ẩm thực</a></li>
          <li><a href="specialdeals.php">Ưu đãi đặc biệt</a></li>
          <li><a href="aboutus.php">Về chúng tôi</a></li>
        </ul>
      </div>
    </nav>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="images/1.jpg" alt="Los Angeles" height="150" width="1000">
        </div>

        <div class="item">
          <img src="images/2.jpg" alt="Chicago" height="150" width="1000">
        </div>

        <div class="item">
          <img src="images/3.jpg" alt="New York" height="150" width="1000">
        </div>

        <div class="item">
          <img src="images/4.jpg" alt="New York" height="150" width="1000">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  <div id="center">
    <h1><center>Chào mừng đến với hệ thống đặt hàng online của nhà hàng LK Restaurant!</center></h1>
        <div class="body_text">
    Ngay từ bây giờ bạn chỉ cần ở nhà và đặt món ăn của mình từ LK Restaurant và nó sẽ được giao đến ngay trước cửa của bạn. Hãy lướt qua những ưu đãi đặc biệt hàng tuần của chúng tôi trong menu ưu đãi đặc biệt. Đăng ký một tài khoản với chúng tôi để sử dụng chức năng đặt hàng nhanh, giao hàng và thanh toán tiện lợi thức ăn. Thực hiện ngay bây giờ bằng cách Đăng Nhập dưới đây hoặc Đăng Ký nếu bạn không có tài khoản trên website:
    </div>
  <div style="border:#66ff99 solid 1px; padding:4px 6px 2px 6px; margin-top: 16px;" class="form-group" align="center">
    <form id="loginForm" name="loginForm">
      <div style="width: 200px">
        <label for="email">Email</label>
        <input name="email" type="text" class="form-control" id="email" required />
      </div>
        <div style="width: 200px">
          <label for="password">Mật khẩu</label>
          <input name="password" type="password" id="password" class="form-control" required />
        </div>
        <div id="error"></div>
        <div style="margin-top: 8px; margin-bottom: 8px">
          <a href="reset-password.php">Quên mật khẩu?</a>
          <a href="register.php">Tạo tài khoản?</a>
        </div>
        <div style="margin-bottom: 8px;">
          <button class="btn btn-primary" type="reset">Reset</button>
          <button class="btn btn-primary" type="button" onclick="checkLogin()">Đăng Nhập</button>
        </div>
    </form>
  </div>
  <hr>
  </div>
  <div id="footer">
      <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">LK Restaurant</a>  |  <a href="#">Chương trình liên kết</a> |<br>
    | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
    
    <div class="bottom_addr">&copy; 2018 LK Restaurant. All Rights Reserved</div>
  </div>
  </div>
</body>
</html>
