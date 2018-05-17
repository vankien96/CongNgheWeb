<?php
  //checking connection and connecting to a database
  require_once('connection/config.php');
  require_once('auth.php');
  if (isset($_GET['id'])) {
    $food_id = $_GET['id'];
    $sql = "SELECT * FROM food_details WHERE food_id='$food_id'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Đặt hàng</title>
  <script type="text/javascript" src="swf/swfobject.js"></script>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
  <script language="JavaScript" src="validation/user.js"></script>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function numberChange() {
      var numberString = document.getElementById("number").value;
      var priceString =  document.getElementById("price").value;
      var price = Number(priceString);
      var number = Number(numberString);
      if (number < 1) {
        document.getElementById("number").value = 1;
      } else {
        var total = number * price;
        document.getElementById("total").value = total+"";
      }
    }

    function makeOrder() {
      var numberString = document.getElementById("number").value;
      var food_id = <?php echo $food_id; ?>;
      var total = document.getElementById("total").value;
      $.ajax({
        url: "add-to-cart-exec.php",
        method: "POST",
        data: {
          food_id: food_id,
          quantity: numberString,
          total: total
        },
        success: function(response) {
          var dataRes = JSON.parse(response);
          if (dataRes.status) {
            alert(dataRes.message);
            window.open ('cart.php','_self',false);
          } else {
            alert(dataRes.message);
          }
        }
      })
    }

    function cancel() {
      window.open("foodzone.php","_self",false);
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
          <li><a href="index.php">Trang chủ</a></li>
          <li class="active"><a href="foodzone.php">Khu ẩm thực</a></li>
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
<div id="center" align="center">
  <div class="form-group" align="center">
    <h2>Đặt hàng</h2>
    <div style=" margin-bottom: 8px">
      <img src="images/<?php echo $row['food_photo']?>" width="300px" height="300px">
    </div>

    <div style="width: 300px; margin-bottom: 8px">
      <label for="name"><h4>Tên Món</h4></label>
      <input type="text" name="name" id="name" readonly class="form-control" value="<?php echo $row['food_name']?>">
    </div>
    <div style="width: 300px; margin-bottom: 8px">
      <label for="price"><h4>Đơn giá: </h4></label>
      <input type="number" name="" id="price" value="<?php echo $row['food_price']?>" class="form-control" readonly>
    </div>
    <div style="width: 100px; margin-bottom: 8px">
      <label for="name"><h4>Số lượng</h4></label>
      <input type="number" name="number" id="number" class="form-control" onchange="numberChange()" value="1">
    </div>
    <div style="width: 300px; margin-bottom: 8px">
      <label for=""><h4>Thành Tiền: </h4></label>
      <input type="number" name="" id="total" value="<?php echo $row['food_price']?>" class="form-control" readonly>
    </div>
    <div style="width: 300px; margin-bottom: 8px">
      <button class="btn btn-primary" onclick="makeOrder()">Xác nhận</button>
      <button class="btn btn-danger" onclick="cancel()">Hủy bỏ</button>
    </div>
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