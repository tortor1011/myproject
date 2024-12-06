<?php
session_start();
if (@$_SESSION["usernamelogin"]=="เจ้าของร้าน"){
    header( "Location: ./owner.php" );
}elseif($_SESSION["usernamelogin"]=="พนักงาน"){
    header( "Location: ./employee.php" );
}
?>
<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
</head>
<body>    
    <form method="GET" action="./Processphp/login.php" class="container">
        <img src="./Picture/Logo_cocoamore.png" alt="">
        <img src="./Picture/logo_Login.png" class="logo_Login">
    <div class="inputwithicon">
        <input name="username" class="textbox" type="text" placeholder="Username">
        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
    </div>
    <div class="inputwithicon">
        <input name="pass" class="textbox" type="password" placeholder="Password">
        <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
    </div>
    <input class="btn-submit" type="submit" value="Login">
</form>
</body>
</html>
