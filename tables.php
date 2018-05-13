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
    $items=mysqli_query($db,"SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error($db)); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($db,"SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysqli_error($db)); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<?php
    //retrieve tables from the tables table
    $tables=mysqli_query($db,"SELECT * FROM tables")
    or die("Something is wrong ... \n" . mysql_error($db));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="swf/swfobject.js"></script>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
        <link type="text/css" href="stylesheets/bootstrap-timepicker.min.css" />
  <script language="JavaScript" src="validation/user.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
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
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
</div>
<div id="center">
<h1>RESERVE TABLE(S)</h1>
  <div style="border:#66FF99 solid 1px;padding:4px 6px 2px 6px">
<a href="member-profile.php">Thông tin cá nhân</a> | <a href="cart.php">Đơn hàng[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Tin nhắn[<?php echo $num_messages;?>]</a> | <a href="tables.php">Bàn</a> | <a href="partyhalls.php">Hội trường</a> | <a href="ratings.php">Đánh giá</a> | <a href="logout.php">Đăng xuất</a>
<p>&nbsp;</p>
<p>Ở đây bạn có thể đặt bạn ở nhà hàng của chúng tôi... Để biết thêm thông tin <a href="aboutus.php">Nhấn vào đây</a> để liên lạc với chúng tôi.
<hr>
<form name="tableForm" id="tableForm" method="post" action="reserve-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return tableValidate(this)">
    <table align="center" >
        <CAPTION><h2>ĐẶT BÀN</h2></CAPTION>
        <tr>
            <td class="navbar-brand">Bàn số/tên:</td>
            <td><select name="table" id="table" class="form-control">
            <option value="select">- chọn bàn -
            <?php 
            //loop through tables table rows
            while ($row=mysqli_fetch_array($tables)){
            echo "<option value=$row[table_id]>$row[table_name]"; 
            }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td class="navbar-brand"> Ngày:</td>
            <td><input type="date" name="date" id="date"  class="form-control"/></td></tr>
        <tr>
            <td class="navbar-brand">Thời gian:</td>
            <td>
              <input type="time" name="time" id="time" class="form-control input-small" class="form-control"/>
             </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Đặt"  class="btn btn-primary"></td>
        </tr>
    </table>
</form>
</div>
</div>
<div>
    <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">Food Zone</a>  |  <a href="#">Chương trình liên kết</a> |<br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; LK Restaurant 2018. All Rights Reserved</div>
</div>
</div>
</body>
</html>