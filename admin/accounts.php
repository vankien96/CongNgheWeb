<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');

//selecting all records from the members table. Return an error if there are no records in the tables
$result=mysqli_query($db,"SELECT * FROM members")
or die("There are no records to display ... \n" . mysqli_error($db)); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Members</title>
<script src="js/bootstrap.min.js"></script>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Quản lý thành viên </h1>
<a href="profile.php">Thông tin cá nhân</a> | <a href="categories.php">Thể loại</a> | <a href="foods.php">Thức ăn</a> | <a href="accounts.php">Tài khoản</a> | <a href="orders.php">Đơn hàng</a> | <a href="reservations.php">Đặt bàn/hội trường</a> | <a href="specials.php">Ưu đãi</a> | <a href="messages.php">Tin nhắn</a> | <a href="logout.php">Đăng xuất</a>
</div>
<div id="container">
<table width="620" align="center" class="table table-hover">
<CAPTION><h3>DANH SÁCH THÀNH VIÊN</h3></CAPTION>
<tr>
<th>Mã số</th>
<th>Họ</th>
<th>Tên</th>
<th>Email</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['member_id']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo '<td><a href="delete-member.php?id=' . $row['member_id'] . '">Xóa thành viên</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($db);
?>
</table>
<hr>
</div>
<div id="footer">
<div class="bottom_addr"><a href="index.php" title="">VỀ TRANG CHỦ</a></div>
</div>
</div>
</body>
</html>