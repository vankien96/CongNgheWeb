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
    or die("Something is wrong ... \n" . mysql_error()); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($db, "SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysql_error()); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<?php
    //retrieve partyhalls from the partyhalls table
    $partyhalls=mysqli_query($db, "SELECT * FROM partyhalls")
    or die("Something is wrong ... \n" . mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Party Halls</title>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
  <script language="JavaScript" src="validation/user.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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
<h1>RESERVE PARTY HALL(S)</h1>
  <div style="border:#66ff99 solid 1px;padding:4px 6px 2px 6px">
<a href="member-profile.php">Thông tin cá nhân</a> | <a href="cart.php">Đơn hàng[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Tin nhắn[<?php echo $num_messages;?>]</a> | <a href="tables.php">Bàn</a> | <a href="partyhalls.php">Hội trường</a> | <a href="ratings.php">Đánh giá</a> | <a href="logout.php">Đăng xuất</a>
<p>&nbsp;</p>
<p>Đây là nơi bạn có thể đặt hội trường cho các bữa tiệc lớn của mình... Để biêt thêm thông tin <a href="contactus.php">Nhấn vào đây</a> để liên lạc với chúng tôi.
<hr>
<form name="partyhallForm" id="partyhallForm" method="post" action="reserve-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return partyhallValidate(this)">
    <table align="center" width="320">
        <CAPTION><h3>ĐẶT CHỔ HỘI TRƯỜNG</h3></CAPTION>
        <tr>
            <td><b>Hội trường số/tên:</b></td>
            <td>
            <select name="partyhall" id="partyhall" class="form-control">
            <option value="select">- chọn hội trường -
            <?php 
            //loop through partyhalls table rows
            while ($row=mysqli_fetch_array($partyhalls)){
            echo "<option value=$row[partyhall_id]>$row[partyhall_name]"; 
            }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td><b>Ngày:</b></td><td><input type="date" name="date" id="date" class="form-control" /></td></tr>
        <tr>
            <td><b>Thời gian:</b></td><td><input type="time" name="time" id="time" class="form-control" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Đặt" class="btn btn-primary"></td>
        </tr>
    </table>
</form>
</div>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">Khu ẩm thực</a>  |  <a href="#">Chương trình liên kết</a> |<br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; 2018 LK Restaurant. All Rights Reserved</div>
</div>
</div>
</body>
</html>