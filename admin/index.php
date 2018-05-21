<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');

    
    //define default value for flag
    $flag_1 = 1;
    
    //defining global variables
    $qry="";
    $excellent_qry="";
    $good_qry="";
    $average_qry="";
    $bad_qry="";
    $worse_qry="";
    
//count the number of records in the members, orders_details, and reservations_details tables
$members=mysqli_query($db,"SELECT * FROM members")
or die("There are no records to count ... \n" . mysqli_error($db)); 

$orders_placed=mysqli_query($db,"SELECT * FROM orders_details")
or die("There are no records to count ... \n" . mysqli_error($db)); 

$orders_processed=mysqli_query($db,"SELECT * FROM orders_details WHERE flag='$flag_1'")
or die("There are no records to count ... \n" . mysqli_error($db)); 

$tables_reserved=mysqli_query($db,"SELECT * FROM reservations_details WHERE table_flag='$flag_1'")
or die("There are no records to count ... \n" . mysqli_error($db)); 

$partyhalls_reserved=mysqli_query($db,"SELECT * FROM reservations_details WHERE partyhall_flag='$flag_1'")
or die("There are no records to count ... \n" . mysqli_error($db)); 

$tables_allocated=mysqli_query($db,"SELECT * FROM reservations_details WHERE flag='$flag_1' AND table_flag='$flag_1'")
or die("There are no records to count ... \n" . mysqli_error($db)); 

$partyhalls_allocated=mysqli_query($db,"SELECT * FROM reservations_details WHERE flag='$flag_1' AND partyhall_flag='$flag_1'")
or die("There are no records to count ... \n" . mysqli_error($db)); 

//get food names and ids from food_details table
$foods=mysqli_query($db,"SELECT * FROM food_details")
or die("Something is wrong ... \n" .mysqli_error($db)); 
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysqli_real_escape_string($str);
        }
        //get category id
        $id = clean($_POST['food']);
        
        //get ratings ids
        $ratings=mysqli_query($db,"SELECT * FROM ratings")
        or die("Something is wrong ... \n" . mysql_error());
        $row_1=mysqli_fetch_array($ratings);
        $row_2=mysqli_fetch_array($ratings);
        $row_3=mysqli_fetch_array($ratings);
        $row_4=mysqli_fetch_array($ratings);
        $row_5=mysqli_fetch_array($ratings);
        if($row_1){
            $excellent=$row_1['rate_id'];
        }
        if($row_2){
            $good=$row_2['rate_id'];
        }
        if($row_3){
            $average=$row_3['rate_id'];
        }
        if($row_4){
            $bad=$row_4['rate_id'];
        }
        if($row_5){
            $worse=$row_5['rate_id'];
        }
        
        //selecting all records from the food_details and polls_details tables based on food id. Return an error if there are no records in the table
        $qry=mysqli_query($db,"SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id'")
        or die("Something is wrong ... \n" . mysql_error());
        
        $excellent_qry=mysqli_query($db,"SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$excellent'")
        or die("Something is wrong ... \n" . mysql_error()); 
        
        $good_qry=mysqli_query($db,"SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$good'")
        or die("Something is wrong ... \n" . mysql_error()); 
        
        $average_qry=mysqli_query($db,"SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$average'")
        or die("Something is wrong ... \n" . mysql_error()); 
        
        $bad_qry=mysqli_query($db,"SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$bad'")
        or die("Something is wrong ... \n" . mysql_error());
        
        $worse_qry=mysqli_query($db,"SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$worse'")
        or die("Something is wrong ... \n" . mysql_error());  
        
        $no_rate_qry=mysqli_query($db,"SELECT * FROM food_details WHERE food_id='$id'")
        or die("Something is wrong ... \n" . mysql_error());
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Index</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Administrator Control Panel</h1>
<a href="profile.php">Thông tin cá nhân</a> | <a href="categories.php">Thể loại</a> | <a href="foods.php">Thức ăn</a> | <a href="accounts.php">Tài khoản</a> | <a href="orders.php">Đơn hàng</a> | <a href="reservations.php">Đặt bàn/hội trường</a> | <a href="specials.php">Ưu đãi</a> | <a href="messages.php">Tin nhắn</a> | <a href="logout.php">Đăng xuất</a>
</div>
<div id="container">
<table width="950" align="center" style="text-align:center" border="1">
<CAPTION><h3>TRẠNG THÁI HIỆN TẠI</h3></CAPTION>
<tr>
    <th>Thành viên</th>
    <th>Đơn hàng đã đặt</th>
    <th>Đơn hàng đã xử lý</th>
    <th>Đơn hàng chưa xử lý</th>  
    <th>Bàn đã đặt</th>
    <th>Bàn đang sử dụng</th>
    <th>Bàn chưa xử lý</th>
    <th>Hội trường đã đặt</th>
    <th>Hội trường đang sử dụng</th>
    <th>Hội trường chưa xử lý</th>    
</tr>

<?php
        $result1=mysqli_num_rows($members);
        $result2=mysqli_num_rows($orders_placed);
        $result3=mysqli_num_rows($orders_processed);
        $result4=$result2-$result3; //gets pending order(s)
        $result5=mysqli_num_rows($tables_reserved);
        $result6=mysqli_num_rows($tables_allocated);
        $result7=$result5-$result6; //gets pending table(s)
        $result8=mysqli_num_rows($partyhalls_reserved);
        $result9=mysqli_num_rows($partyhalls_allocated);
        $result10=$result8-$result9; //gets pending partyhall(s)
        echo "<tr align=>";
            echo "<td>" . $result1."</td>";
            echo "<td>" . $result2."</td>";
            echo "<td>" . $result3."</td>";
            echo "<td>" . $result4."</td>";
            echo "<td>" . $result5."</td>";
            echo "<td>" . $result6."</td>";
            echo "<td>" . $result7."</td>";
            echo "<td>" . $result8."</td>";
            echo "<td>" . $result9."</td>";
            echo "<td>" . $result10."</td>";
        echo "</tr>";
?>
</table>
<hr>
<form name="foodStatusForm" id="foodStatusForm" method="post" action="index.php" onsubmit="return statusValidate(this)">
    <table width="360" align="center" >
    <CAPTION><h3>ĐÁNH GIÁ CỦA KHÁCH HÀNG (100%)</h3></CAPTION>
         <tr>
            <td>Thức ăn</td>
            <td width="168"><select name="food" id="food">
            <option value="select">- chọn thức ăn -
            <?php 
            //loop through food_details table rows
            while ($row=mysqli_fetch_array($foods)){
            echo "<option value=$row[food_id]>$row[food_name]"; 
            }
            ?>
            </select></td>
            <td><input type="submit" name="Submit" value="Hiển thị" /></td>
         </tr>
    </table>
</form>
<table width="900" align="center">
<tr>
    <th></th>
    <th>Rất ngon</th>
    <th>Ngon</th>
    <th>Bình thường</th>
    <th>Tệ</th>
    <th>Quá tệ</th>
</tr>

<?php
    if(isset($_POST['Submit'])){
        //actual values
        $excellent_value=mysqli_num_rows($excellent_qry);
        $good_value=mysqli_num_rows($good_qry);
        $average_value=mysqli_num_rows($average_qry);
        $bad_value=mysqli_num_rows($bad_qry);
        $worse_value=mysqli_num_rows($worse_qry);
        //percentile rates
        $total_value=mysqli_num_rows($qry);
        if($total_value != 0){
            $excellent_rate=$excellent_value/$total_value*100;
            $good_rate=$good_value/$total_value*100;
            $average_rate=$average_value/$total_value*100;
            $bad_rate=$bad_value/$total_value*100;
            $worse_rate=$worse_value/$total_value*100;
        }
        else{
            $excellent_rate=0;
            $good_rate=0;
            $average_rate=0;
            $bad_rate=0;
            $worse_rate=0;
        }
        //get food name
        if(mysqli_num_rows($qry)>0){
            $row=mysql_fetch_array($qry);
            $food_name=$row['food_name'];
        }
        else{
            $row=mysqli_fetch_array($no_rate_qry);
            $food_name=$row['food_name'];
        }
        echo "<tr>";
        echo "<th>" .$food_name."</th>";
        echo "<td>" .$excellent_value."(". $excellent_rate."%)"."</td>";
        echo "<td>" .$good_value."(". $good_rate."%)"."</td>";
        echo "<td>" .$average_value."(". $average_rate."%)"."</td>";
        echo "<td>" .$bad_value."(". $bad_rate."%)"."</td>";
        echo "<td>" .$worse_value."(". $worse_rate."%)"."</td>";
        echo "</tr>";
    }
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
