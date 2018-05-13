<?php
//checking connection and connecting to a database
require_once('connection/config.php');

//retrive promotions from the specials table
$result=mysqli_query($db, "SELECT * FROM specials")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($db, "SELECT * FROM currencies WHERE flag='$flag_1'")
      or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Specials</title>
  <script type="text/javascript" src="swf/swfobject.js"></script>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
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
          <li><a href="index.php">Trang chủ</a></li>
          <li><a href="foodzone.php">Khu ẩm thực</a></li>
          <li class="active"><a href="specialdeals.php">Ưu đãi đặc biệt</a></li>
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

  <h1>SPECIAL DEALS</h1>
  <hr>
  <p>Những ưu đãi ở bên dưới và chúng có thời hạn. Hãy quyết định ngay bây giờ!</p>
  <h3>Chú ý: Bạn hãy vào LK Restaurant để đặt hàng các thức ăn đang có ưu đãi.</h3>
  <div>
<table width="850" align="center" class="table table-stride">
    <CAPTION><h3>ƯU ĐÃI ĐẶC BIỆT</h3></CAPTION>
        <tr>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Miêu tả</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Giá ưu đãi</th>
        </tr>
        <?php
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                while ($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=images/'. $row['special_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['special_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['special_name']."</td>";
                    echo "<td width='250' align='left'>" . $row['special_description']."</td>";
                    echo "<td>" . $row['special_start_date']."</td>";
                    echo "<td>" . $row['special_end_date']."</td>";
                    echo "<td>" . $row['special_price']."" . $symbol['currency_symbol']. "</td>";
                    echo "</td>";
                    echo "</tr>";
                    }
        ?>
</table>
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
