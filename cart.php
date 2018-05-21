<?php
    require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');

    
//define default values for flag_0
$flag_0 = 0;
    
//get member_id from session
$member_id = $_SESSION['SESS_MEMBER_ID'];

//selecting particular records from the food_details and cart_details tables. Return an error if there are no records in the tables
$result=mysqli_query($db,"SELECT food_name,food_description,food_price,food_photo,cart_id,quantity,total,flag,category_name FROM food_details,cart_details,categories WHERE cart_details.member_id='$member_id' AND cart_details.flag='$flag_0' AND cart_details.food_id=food_details.food_id AND food_details.food_category=categories.category_id")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    if(isset($_POST['Submit'])){
        $id = $_POST['category'];
        
        //selecting all records from the food_details table based on category id. Return an error if there are no records in the table
        $result=mysqli_query($db,"SELECT * FROM food_details WHERE food_category='$id'")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    }
?>
<?php
    $flag_0 = 0;
    $items=mysqli_query($db,"SELECT * FROM cart_details WHERE member_id='$member_id' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error($db)); 
?>
<?php
    $flag_1 = 1;
    $currencies=mysqli_query($db,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Đơn hàng</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
 <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
  <script language="JavaScript" src="validation/user.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function orderExcute(clicked_id) {
      $.ajax({
            url: "order-exec.php",
            method: "POST",
            data: {
              cart_id: clicked_id
            },
            success: function(response) {
              var dataRes = JSON.parse(response);
              if (dataRes.status) {
                alert(dataRes.message);
                window.open("member-index.php","_self",false);
              } else {
                if (dataRes.billing) {
                  alert("Bạn chưa có thông tin giao hàng. Vui lòng cập nhật trong profile");
                  window.open("member-profile.php","_self",false);
                } else {
                  alert(dataRes.message);
                }
              }
            }
          })
    }

    function deleteOrder(clicked_id) {
      $.ajax({
            url: "delete-order.php",
            method: "POST",
            data: {
              cart_id: clicked_id
            },
            success: function(response) {
              var dataRes = JSON.parse(response);
              if (dataRes.status) {
                alert("Hủy đặt hàng thành công.");
                location.reload();
              } else {
                alert(dataRes.message);
              }
            }
          })
    }
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
 <h1>ĐƠN HÀNG CỦA TÔI</h1>
    <hr>
            <div >
              <table width="910" height="auto" style="text-align:center" class="table table-bordered">
            <tr>
                <th>Mã số</th>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Miêu tả</th>
                <th>Thể loại</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Action(s)</th>
            </tr>

            <?php
                //loop through all table rows
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                while ($row=mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['cart_id']."</td>";
                    echo '<td><a href=images/'. $row['food_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['food_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['food_name']."</td>";
                    echo "<td>" . $row['food_description']."</td>";
                    echo "<td>" . $row['category_name']."</td>";
                    echo "<td>" . $row['food_price']."" . $symbol['currency_symbol']. "</td>";
                    echo "<td>" . $row['quantity']."</td>";
                    echo "<td>" . $row['total']."" . $symbol['currency_symbol']. "</td>";
                    echo "<td><button id = ".$row["cart_id"]." onclick='orderExcute(this.id)' class='btn btn-primary'>Thanh Toán</button><button id = ".$row["cart_id"]." onclick='deleteOrder(this.id)' class='btn btn-danger'>Hủy</button></td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
                mysqli_close($db);
            ?>
          </table>
    </div>
</div>
<div >
    <div class="bottom_menu"><a href="index.php">Trang chủ</a>  |  <a href="aboutus.php">Về chúng tôi</a>  |  <a href="specialdeals.php">Ưu đãi đặc biệt</a>  |  <a href="foodzone.php">Khu ẩm thực</a>  |  <a href="#">Chương trình liên kết</a> |<br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; LK Restaurant 2018. All Rights Reserved</div>
</div>
</div>
</body>
</html>