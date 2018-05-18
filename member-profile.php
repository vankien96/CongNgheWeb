<?php
	require_once('auth.php');
?>
<?php
  //checking connection and connecting to a database
  require_once('connection/config.php');

  //get member id from session
  $memberId=$_SESSION['SESS_MEMBER_ID'];
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysqli_query($db, "SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
      or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($db, "SELECT * FROM messages")
      or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);

    $billingInfoQuery = mysqli_query($db, "SELECT * FROM billing_details WHERE member_id='$memberId'")
      or die("Something is wrong ... \n" . mysqli_error()); 
    $billingInfo = mysqli_fetch_array($billingInfoQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Thông tin cá nhân</title>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
  <script language="JavaScript" src="validation/user.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function changePassword() {
        var opassword = document.getElementById("opassword").value;
        var password = document.getElementById("password").value;
        var rpassword = document.getElementById("rpassword").value;
      if (opassword != "" && password != "" && rpassword != "") {
        if (password == rpassword) {
          $.ajax({
            url: "update-exec.php",
            method: "POST",
            data: {
              opassword: opassword,
              password: password
            },
            success: function(response) {
              var dataRes = JSON.parse(response);
              if (dataRes.status) {
                alert("Đổi mật khẩu thành công");
                document.getElementById("opassword").value = "";
                document.getElementById("password").value = "";
                document.getElementById("rpassword").value = "";
              } else {
                alert(dataRes.message);
              }
            }
          })
        } else {
          alert("Nhập lại mật khẩu không chính xác");
        }
      } else {
        alert("Vui lòng nhập đầy đủ các trường");
      }
    }

    function changeAddress() {
      var address = document.getElementById("address").value;
      var city = document.getElementById("city").value;
      var phone = document.getElementById("phone").value;
      if (address != "" && city != "" && phone != "") {
        $.ajax({
            url: "billing-exec.php",
            method: "POST",
            data: {
              address: address,
              city: city,
              phone: phone
            },
            success: function(response) {
              var dataRes = JSON.parse(response);
              if (dataRes.status) {
                alert("Thay đổi thông tin giao hàng thành công");
              } else {
                alert(dataRes.message);
              }
            }
          })
      } else {
        alert("Vui lòng nhập đầy đủ các trường");
      }
    }
  </script>
</script>
</head>
<body>
<div id="page">
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
  <h1>Thông Tin Cá Nhân</h1>
  <div style="border:#66ff99 solid 1px;" class="container-fluid">
    <a href="member-profile.php">Thông tin cá nhân</a> | <a href="cart.php">Đơn hàng[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Tin nhắn[<?php echo $num_messages;?>]</a> | <a href="tables.php">Bàn</a> | <a href="partyhalls.php">Hội trường</a> | <a href="ratings.php">Đánh giá</a> | <a href="logout.php">Đăng xuất</a>
    <p>&nbsp;</p>
    <p>Ở đây bạn có thể thay đổi mật khẩu cũng như địa chỉ giao hàng của mình. Địa chỉ giao hàng và các thông tin của bạn sẽ được chúng tôi sử dụng trong quá trình giao hàng và thanh toán giao dịch. Để biết thêm thông tin <a href="aboutus.php">Nhấn vào đây</a> để liên lạc với chúng tôi.</p>
  <div class="rows">
        <div class="col-sm-6" id="changePassForm">
          <CAPTION><h2>THAY ĐỔI MẬT KHẨU</h2></CAPTION>
          <table class="table table-stride">
            <tr>
              <label for="opassword">Mật khẩu cũ</label>
              <input type="password" name="opassword" id="opassword" class="form-control" required>
            </tr>
            <tr>
              <label for="password">Mật khẩu mới</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </tr>
            <tr>
              <label for="rpassword">Nhập lại mật khẩu</label>
              <input type="password" name="rpassword" id="rpassword" class="form-control" required>
            </tr>
            <tr>
              <button type="button" class="btn btn-primary" onclick="changePassword()" style="margin-top: 10px">Đổi</button>
            </tr>
          </table>
        </div>
        <div class="col-sm-6">
          <CAPTION><h2>ĐỊA CHỈ GIAO HÀNG</h2></CAPTION>
          <table class="table table-stride" align="center">
            <tr class="spacer">
              <label for="address">Tên Đường</label>
              <input type="text" id= "address" name="address" class="form-control" required value="<?php echo $billingInfo['address']?>">
            </tr>
            <tr>
              <label for="city">Thành phố</label>
              <input type="text" id= "city" name="city" class="form-control" required value="<?php echo $billingInfo['city']?>">
            </tr>
            <tr>
              <label for="phone">Số điện thoại</label>
              <input type="text" id= "phone" name="phone" class="form-control" required value="<?php echo $billingInfo['phone'] ?>">
            </tr>
            <tr>
              <button id="update" class="btn btn-primary" onclick="changeAddress()" style="margin-top: 10px">Update</button>
            </tr>
          </table>
        </div>
  </div>
  </div>
</div>
  <div id="footer">
      <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">Khu ẩm thực</a>  |  <a href="#">Chương trình liên kết</a> |<br>
    | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
    
    <div class="bottom_addr">&copy; 2018 LK Restarant. All Rights Reserved</div>
  </div>
</div>
</body>
</html>