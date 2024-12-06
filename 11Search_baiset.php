<?php
session_start();
if (@$_SESSION["usernamelogin"]=="เจ้าของร้าน"){
    header( "Location: ../owner.php" );
}elseif(@$_SESSION["usernamelogin"]=="พนักงาน"){
    
}
else{header( "Location: ./index.php" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Search_baiset.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
</head>
<BODY> 
    <form action="10.3baiset.php" method="get">
        <input class="textbox" type="text" name="id" placeholder="กรอกช่องค้นหาใบเสร็จ">
        <button class="btn-submit" type="submit">ค้นหา</button>
    </form>
    <DIV class="rightbutton">
    <a href="employee.php"><input class="btn-submit rightbutton1" type="submit" value="หน้าแรก"></a>
    <a href="7saveinfo2.php"><input class="btn-submit rightbutton1" value="รับคำสั่งซื้อ"></a>
    <a href="./11Search_baiset.php"><input class="btn-submit rightbutton2" value="ค้นหาใบเสร็จ"></a>
    <a href="./3.1dd.php"><input class="btn-submit rightbutton1" value="สรุปยอดขายประจำวัน"></a>
    <!-- <a href="11Search_baiset.html"><input class="btn-submit rightbutton1" value="พิมพ์ใบเสร็จรับเงิน"></a>
    <a href="8Checkmenu.html"><input class="btn-submit rightbutton1" value="เช็คยอดเมนู"></a> -->
</DIV>
</body>
</html>
