<?php
    require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');

//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID']; 

//selecting all records from the food_details table. Return an error if there are no records in the table
$foods=mysqli_query($db,"SELECT * FROM food_details")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 

//selecting all records from the ratings table. Return an error if there are no records in the table
$ratings=mysqli_query($db,"SELECT * FROM ratings")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysqli_query($db,"SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error($db)); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($db,"SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysql_error($db)); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
< <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
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
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
</div>
<div id="center">
<h1>RATE US</h1>
  <div style="border:#66ff99 solid 1px;padding:4px 6px 2px 6px">
<a href="member-profile.php">Thông tin cá nhân</a> | <a href="cart.php">Đơn hàng[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Tin nhắn[<?php echo $num_messages;?>]</a> | <a href="tables.php">Bàn</a> | <a href="partyhalls.php">Hội trường</a> | <a href="ratings.php">Đánh giá</a> | <a href="logout.php">Đăng xuất</a>
<p>&nbsp;</p>
<p>Ở đây bạn sẽ cho chúng tôi biết được mức độ hài lòng về thức ăn của chúng tôi. Những đánh giá của bạn sẽ giúp ích cho chúng tôi rất nhiều trong việc biết khẩu vị của khách hàng và cố gắng tạo ra nhiều món ngon cho khách hàng hơn nữa. Để biết thêm thông tin <a href="aboutus.php">Nhấn vào đây</a> để liên lạc với chúng tôi.
<hr>
<form name="ratingForm" id="ratingForm" method="post" action="ratings-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return ratingValidate(this)" style="text-align:center;">
    <table align="center" >
        <CAPTION><h2>ĐÁNH GIÁ THỨC ĂN CỦA CHÚNG TÔI</h2></CAPTION>
            <tr>
                <td class="navbar-brand">Thức ăn</td>
                <td><select name="food" id="food" class="form-control">
                <option value="select">- chọn thức ăn -
                <?php 
                //loop through food_details table rows
                while ($row=mysqli_fetch_array($foods)){
                echo "<option value=$row[food_id]>$row[food_name]"; 
                }
                ?>
                </select></td>
            <tr>
                <td class="navbar-brand">Mức độ</td>
                <td><select name="scale" id="scale" class="form-control">
                <option value="select" >- chọn mức độ -
                <?php 
                //loop through ratings table rows
                while ($row=mysqli_fetch_array($ratings)){
                echo "<option value=$row[rate_id]>$row[rate_name]"; 
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="Submit" value="Gửi" class="btn btn-primary" /></td>
            </td>
    </table>
</form>
</div>
</div>
<div >
    <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">Khu Ẩm Thực</a>  |  <a href="#">Chương trình liên kết</a> |<br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; LK Restaurant 2018. All Rights Reserved</div>
</div>
</div>
</div>
</body>
</html>