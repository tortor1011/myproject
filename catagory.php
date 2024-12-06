<?php
session_start();
if ($_SESSION["usernamelogin"]=="เจ้าของร้าน"){

}elseif($_SESSION["usernamelogin"]=="พนักงาน"){
    header( "Location: ./employee.php" );
}
else{header( "Location: ./index.php" );
}
 header('Content-Type: text/html; charset=utf-8');
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
        
        <center><form action="./insert/insert_category.php" method="post">
          <center><div class='box2'>
          <h1>จัดการประเภทสินค้า</h1>
          <h3>**เพิ่มประเภทสินค้า**</h3>
            <input name="CategoryName" class="textbox" type="text" placeholder="กรอกประเภท">
          <br><br>
        
          <button  class="sub" type="submit" >ยืนยัน</button></div></center>
        </form></center>
      <div class="box3">
        <center><?php
        include("./select/select_catagory.php");
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
       <p><a href="./owner.php"><input class="btn-submit rightbutton1" type="submit" value="หน้าแรก"></a></p>
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