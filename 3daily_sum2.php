<?php
session_start();
if ($_SESSION["usernamelogin"]=="เจ้าของร้าน"){

}elseif($_SESSION["usernamelogin"]=="พนักงาน"){
    header( "Location: ./employee.php" );
}
else{header( "Location: ./index.php" );
}
  include('./Processphp/config.php');

  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="dailysum.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cocoamore</title>
</head>

<body>
  <form class="container" action="" method="get">

      <div class="inputwithicon">
        <h1>สรุปยอดขายรายวัน</h1>
      </div>

      <?php 
        date_default_timezone_set("Asia/Bangkok");
        $setDates =  date("Y").'-'.date("m").'-'.date("d");
      ?>
      <input class="date1" type="date" name="date2" value='<?php echo $setDates; ?>' required>
      <input class="btn-submit" type="submit" name="submit" value="สรุปยอดขาย">
  
    
    <div class="table_component" role="region" tabindex="0">
      <table>
        <caption>
          <p>รายงานสรุปยอดขายประจำวัน <?php echo @$_GET['date2'] ?></p>
        </caption>
        <thead>
          <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวนสินค้า
            </th>
            <th>ราคาต่อหน่วย (บาท)</th>
            <th>จำนวนเงินรวม (บาท)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "
          SELECT 
            co_orders.Date_Ord,
              menu.MenuID,
              menu.MenuName,
              SUM(detail_co_orders.Qty) SumAmount,
              SUM(detail_co_orders.Sellprice) AS SumPrice
          FROM `co_orders` 
          
          JOIN detail_co_orders on `co_orders`.`OrdersID` = detail_co_orders.OrdersID
          JOIN menu on detail_co_orders.MenuID = menu.MenuID
          
          WHERE co_orders.Date_Ord = '".$_GET['date2']."'
  
          GROUP BY 
            co_orders.Date_Ord,
            menu.MenuID,
            menu.MenuName
          
          ORDER BY co_orders.Date_Ord DESC";
            $data = $conn->query($sql); 
            $sumall = 0;
              while($r = $data->fetch()){ 
            ?>
              <tr>
                <td><?php echo $r['MenuID']; ?></td>
                <td><?php echo $r['MenuName']; ?></td>
                <td><?php echo $r['SumAmount']; ?></td>
                <td>
                  <p><?php echo $r['SumPrice']; ?></p>
                </td>
                <?php
                
                $sum = ($r['SumAmount'] * $r['SumPrice']);
              $sumall1 = $sumall += $sum;
              ?>
              <td><?php echo  number_format($sum,2); ?></td>
            </tr>
          <?php } ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td> </td>
            <td><?php echo  '฿'.number_format($sumall1,2); ?></td>
          </tr>
         </tbody>
      </table>
    </div>
  </form>
</body>
<DIV class="rightbutton">
  <a href="./owner.php"><input class="btn-submit rightbutton1" type="submit" value="หน้าแรก"></a>
  <!-- <a href="./3daily_sum.php"><input class="btn-submit rightbutton4" type="submit" value="รายงานประจำวัน"></a>
  <a href="./4.1monthly_sum.php"><input class="btn-submit rightbutton2" type="submit" value="รายงานประจำเดือน"></a>
  <a href="./4.2yearsum.php"><input class="btn-submit rightbutton1"  value="รายงานประจำปี"></a>
  <a href="./4monthly_sumeditable.php"><input class="btn-submit rightbutton3" type="submit" value="จัดการข้อมูลสินค้า" ></a> -->
</DIV>
</html>
<!-- 
<script>
  document.querySelector("form").addEventListener('submit', function (e) {
    // e.preventDefault();
    document.querySelector(".table_component").style.display = 'block'
  })
</script> -->