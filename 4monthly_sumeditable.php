<?php
session_start();
if ($_SESSION["usernamelogin"]=="เจ้าของร้าน"){

}elseif($_SESSION["usernamelogin"]=="พนักงาน"){
    header( "Location: ./employee.php" );
}
else{header( "Location: ./index.php" );
}
 header('Content-Type: text/html; charset=utf-8');
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
<html>

<head>
  <link rel="stylesheet" href="monthly_sumeditable.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cocoamore</title>
</head>

<body>
  <center><div class="box"><center>

    

    
      <center><div class="table_component" role="region" tabindex="0"></center>
        
        <center><form action="./insert/insert_product.php" method="post">
          <center><div class='box2'>
          <h1>จัดการข้อมูลสินค้า</h1>
          <h3>**เพิ่มสินค้า**</h3>
            <input name="MenuName" class="textbox" type="text" placeholder="กรอกสินค้า">
          <br><br>
          <select name="CategoryID"  class="textbox">
            <!-- <option>เลือกประเภท</option> -->
            <?php 
              $sql = "SELECT * FROM `category` ORDER BY `CategoryID` ASC";
              $stmt = $conn->query($sql);
              $stmt->execute();
              while($r = $stmt->fetch()):
            ?>
            <option value="<?php echo $r['CategoryID']?>"><?php echo $r['CategoryName']?></option>
            <?php endwhile; ?>
          </select>
          <br><br>
          <input name="Unit_price" class="textbox" type="text" placeholder="กรอกราคา">
          <br><br>
          <input name="Unit_cost" class="textbox" type="text" placeholder="กรอกราคาต้นทุน">
          <br><br>
          <button  class="sub" type="submit" >ยืนยัน</button></div></center>
        </form></center>
      <div class="box3">
        <center><?php
        include("./select/select_product.php");
        ?></center> <div>
      <!-- <center><table>
          
          <thead>
              <tr>
                  <th>รหัสสินค้า</th>
                  <th>ชื่อสินค้า</th>
                  <th>ราคา/หน่วย</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>00001<br></td>
                  <td>iceberge coco</td>
                  <td>100</td>
              </tr>
              <tr>
                  <td>00002</td>
                  <td>iceberge greentea</td>
                  <td>45</td>
              </tr>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
          </tbody>
      </table></center> -->
      </div>

      <div class="rightbutton">
      <p><a href="./owner.php"><input class="btn-submit rightbutton3" type="submit" value="หน้าแรก"></a></p>
       <p><a href="./3daily_sum.php"><input class="btn-submit rightbutton3" type="submit" value="รายงานประจำวัน"></a></p>
       <p><a href="./4.1monthly_sum.php"><input class="btn-submit rightbutton2" type="submit" value="รายงานประจำเดือน"></a></p>
       <p><a href="./4.2yearsum.php"><input class="btn-submit rightbutton2"  value="รายงานประจำปี"></a></p>
       <p><a href="./4monthly_sumeditable.php"><input class="btn-submit rightbutton4" type="submit" value="จัดการข้อมูลสินค้า" ></a></p>
      </div>
  </div>

  
  
</body>

</html>

<script>
  document.querySelector(".btn-submit").addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector(".table_component").style.display = 'block'
  })
</script>