<?php
session_start();
if (@$_SESSION["usernamelogin"]=="เจ้าของร้าน"){
    header( "Location: ./owner.php" );
}elseif(@$_SESSION["usernamelogin"]=="พนักงาน"){
    
}
else{header( "Location: ./index.php" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="employee.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
</head>
<body>

    <form class="container">

    <a href="7saveinfo2.php"><input class="btn-submit" value="รับคำสั่งซื้อ"></a>
    <a href="11Search_baiset.php"><input class="btn-submit" value="ค้นหาใบเสร็จ"></a>
    <a href="./3.1dd.php"><input class="btn-submit" value="รายงานประจำวัน"></a>
    <!-- <a href="8Checkmenu.html"><input class="btn-submit" value="เช็คยอดเมนู"></a> -->
    <a href="Processphp/logout.php"><input class="btn-submit"  value="ออกจากระบบ"></a>
    </form>
    <img src="./Picture/status_employee.png" class="status-owner">
</body>
</html>