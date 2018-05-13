<?php
//checking connection and connecting to a database
require_once('connection/config.php');


//selecting all records from the food_details table. Return an error if there are no records in the table
$result=mysqli_query($db, "SELECT * FROM food_details,categories WHERE food_details.food_category=categories.category_id ")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    //retrive categories from the categories table
    $categories=mysqli_query($db, "SELECT * FROM categories")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($db, "SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysql_real_escape_string($str);
        }
        //get category id
        $search = clean($_POST['search']);
        $id = clean($_POST['category']);
        if($id == 0) $id = "";
        
        //selecting all records from the food_details and categories tables based on category id. Return an error if there are no records in the table
        $result=mysqli_query($db, "SELECT * FROM food_details,categories WHERE food_category LIKE '%$id%' AND (food_name LIKE'%$search%' OR food_description LIKE '%$search%') AND food_details.food_category=categories.category_id ")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Khu ẩm thực</title>
  <script type="text/javascript" src="swf/swfobject.js"></script>
  <link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
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
<div id="center">
 <h1>MỜI BẠN CHỌN THỨC ĂN</h1>
 <hr>
 <h3>Bạn hãy chọn danh mục bên dưới để nhanh chóng tìm được thức ăn mong muốn:</h3>
 <form name="categoryForm" id="categoryForm" method="post" action="foodzone.php" >
 <!-- onsubmit="return categoriesValidate(this)" -->
     <table width="300" align="center" class="table table-striped">
     <tr>
        <td width="100" align="center">
          <input type="text" name="search" value="" placeholder="Mời nhập..." class="form-control">
        </td>
        <td width="100">
          <select name="category" id="category" class="form-control">
            <option value="select">- chọn danh mục -
              <?php 
              //loop through categories table rows
                while ($row=mysqli_fetch_array($categories)){
                  echo "<option value=$row[category_id]>$row[category_name]"; 
                }
              ?>
          </select>
        </td>
        <td width="100"><button class="btn btn-primary" type="submit" name="Submit">Xem</button></td>
     </tr>
     </table>
 </form>
  <div style="padding:4px 6px 2px 6px" align="center">
      <table width="860" height="auto" style="align-content: center;" class="table table-bordered">
        <thead>
          <tr>
            <th>Hình ảnh</th>
            <th>Tên</th>
            <th width="350">Miêu tả</th>
            <th>Thể loại</th>
            <th>Giá</th>
            <th>Action(s)</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $count = mysqli_num_rows($result);
            if(isset($_POST['Submit']) && $count < 1){
                echo "<html><script language='JavaScript'>alert('Không tìm thấy thức ăn nào trong thể loại này, bạn hãy quay lại sau.')</script></html>";
            }
            else{
                //loop through all table rows
                //$counter = 3;
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                while ($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=images/'. $row['food_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['food_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['food_name']."</td>";
                    echo "<td>" . $row['food_description']."</td>";
                    echo "<td>" . $row['category_name']."</td>";
                    echo "<td>" . $row['food_price']."" . $symbol['currency_symbol']. "</td>";
                    echo '<td><a href="cart-exec.php?id=' . $row['food_id'] . '">Đặt</a></td>';
                    echo "</td>";
                    echo "</tr>";
                    }      
                }
        ?>
        </tbody>
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