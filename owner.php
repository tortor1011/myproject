<?php
session_start();
if ($_SESSION["usernamelogin"]=="เจ้าของร้าน"){

}elseif($_SESSION["usernamelogin"]=="พนักงาน"){
    header( "Location: ./employee.php" );
}
else{header( "Location: ./index.php" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="owner.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
</head>
<body>

    <form class="container">

    <a href="./3daily_sum.php"><input class="btn-submit"  value="รายงานประจำวัน"></a>
    <a href="./4.1monthly_sum.php"><input class="btn-submit"  value="รายงานประจำเดือน"></a>
    <a href="./4.2yearsum.php"><input class="btn-submit"  value="รายงานประจำปี"></a>
    <a href="./4monthly_sumeditable.php"><input class="btn-submit"  value="จัดการข้อมูลสินค้า"></a>
    <a href="Processphp/logout.php"><input class="btn-submit"  value="ออกจากระบบ"></a>
    </form>
    <img src="./Picture/status_owner.png" class="status-owner">
    
</body>
</html>