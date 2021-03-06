<?php
//checking connection and connecting to a database
  require_once('connection/config.php');
//retrieve questions from the questions table
  $questions=mysqli_query($db, "SELECT * FROM questions")
  or die("Something is wrong ... \n" . mysqli_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Đăng ký</title>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
  <script language="JavaScript" src="validation/user.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function register() {
      if ($('#registerForm')[0].checkValidity()) {
          var question = document.getElementById("question").value;
          var firstName = document.getElementById("firstName").value;
          var lastName = document.getElementById("lastName").value;
          var email = document.getElementById("email").value;
          var password = document.getElementById("password").value;
          var rpassword = document.getElementById("rpassword").value;
          var answer = document.getElementById("answer").value;
          if (question == "") {
            alert("Vui lòng chọn câu hỏi bảo mật");
          } else if (password != rpassword){
            alert("Nhập lại mật khẩu không đúng");
          } else {
            $.ajax({
              url: "register-exec.php",
              method: "POST",
              data: {
                email: email,
                password: password,
                fname: firstName,
                lname: lastName,
                question: question,
                answer: answer
            },
            success: function(response) {
              var dataRes = JSON.parse(response);
              if (dataRes.status) {
                window.open('member-index.php','_self',false);
              } else {
                alert(dataRes.message);
              }
            }
            })
          }
      } else {
        alert("Vui lòng điền các trường bắt buộc");
      }
    }
  </script>
</script>
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
<h1>Register</h1>
<div id="center" style="width: 350px">
  <form id="registerForm">
    <font color="#FF0000">* Miền bắt buộc</font>
    <div class="form-group">
      <label for="firstName">Họ</label><font color="#FF0000">*</font>
      <input type="text" class="form-control" id="firstName" name="fname" required>
    </div>
    <div class="form-group">
      <label for="lastName">Tên</label><font color="#FF0000">*</font>
      <input type="text" class="form-control" id="lastName" name="lname" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label><font color="#FF0000">*</font>
      <input type="text" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Mật khẩu</label><font color="#FF0000">*</font>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
      <label for="rpassword">Xác nhận mật khẩu</label><font color="#FF0000">*</font>
      <input type="password" class="form-control" id="rpassword" name="rpassword" required>
    </div>
    <div class="form-group">
      <label for="question">Câu hỏi bảo mật</label><font color="#FF0000">*</font>
      <select name="question" id="question" class="form-control">
        <option value="">-Chọn câu hỏi-</option>
        <?php
          while ($row=mysqli_fetch_array($questions)) {
            echo "<option value=$row[question_id]>$row[question_text]"; 
          }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="answer">Câu trả lời</label><font color="#FF0000">*</font>
      <input type="text" class="form-control" id="answer" name="answer" required>
    </div>
    <div id="error"></div>
    <div class="form-group">
      <button class="btn btn-primary" type="reset">Reset</button>
      <button class="btn btn-primary" type="button" onclick="register()">Đăng Ký</button>
    </div>
<hr>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">Khu ẩm thực</a>  |  <a href="#">Chương trình liên kết</a> |<br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; LK Restaurant. All Rights Reserved</div>
</div>
</div>
</body>
</html>
