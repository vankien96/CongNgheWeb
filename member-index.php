<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');

//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID'];

//selecting all records from the orders_details table. Return an error if there are no records in the table
$result=mysqli_query($db, "SELECT * FROM orders_details,cart_details,food_details,categories,members WHERE members.member_id='$memberId' AND orders_details.member_id='$memberId' AND orders_details.cart_id=cart_details.cart_id AND cart_details.food_id=food_details.food_id AND food_details.food_category=categories.category_id AND orders_details.flag = '1'")
  or die("There are no records to display ... \n" . mysqli_error()); 
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
    or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($db, "SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Trang cá nhân</title>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
  <script language="JavaScript" src="validation/user.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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
<h1>Chào <?php echo $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];?></h1>
<div style="border:#66ff99 solid 1px;padding:4px 6px 2px 6px">
  <a href="member-profile.php">Thông tin cá nhân</a> | <a href="cart.php">Đơn hàng[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Tin nhắn[<?php echo $num_messages;?>]</a> | <a href="tables.php">Bàn</a> | <a href="partyhalls.php">Hội trường</a> | <a href="ratings.php">Đánh giá</a> | <a href="logout.php">Đăng xuất</a>
  <p>&nbsp;</p>
  <p>Ở đây bạn có thể xem lịch sử đặt thức ăn và xóa những đơn hàng đã cũ từ tài khoản của mình. Có thể thấy hóa đơn của những lần đặt thức ăn. Bạn cũng có thể đặt bàn bằng tài khoản của mình. Để biết thêm thông tin <a href="contactus.php">Nhấn vào đây</a> để liên lạc với chúng tôi.
  <h3><a href="foodzone.php">Đặt thức ăn!</a></h3>
  <hr>
  <table border="0" width="910" style="text-align:center;" class="table table-stride">
  <CAPTION><h2>LỊCH SỬ ĐẶT THỨC ĂN</h2></CAPTION>
  <tr>
    <th>Mã số</th>
    <th>Hình ảnh</th>
    <th>Tên</th>
    <th>Thể loại</th>
    <th>Giá</th>
    <th>Số lượng</th>
    <th>Tổng cộng</th>
    <th>Ngày giao hàng</th>
  </tr>

<?php
  //loop through all table rows
  $symbol=mysqli_fetch_assoc($currencies); //gets active currency
  while ($row=mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['order_id']."</td>";
    echo '<td><a href=images/'. $row['food_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['food_photo']. ' width="80" height="70"></a></td>';
    echo "<td>" . $row['food_name']."</td>";
    echo "<td>" . $row['category_name']."</td>";
    echo "<td>" . $row['food_price']."" . $symbol['currency_symbol']. "</td>";
    echo "<td>" . $row['quantity']."</td>";
    echo "<td>" . $row['total']."" . $symbol['currency_symbol']. "</td>";
    echo "<td>" . $row['delivery_date']."</td>";
    echo "</tr>";
  }
?>
</table>
</div>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">Food Zone</a>  |  <a href="#">Chương trình liên kết</a> | <br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; 2018 LK Restaurant. All Rights Reserved</div>
</div>
</div>
</body>
</html>
