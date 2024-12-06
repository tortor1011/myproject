<?php
include(dirname(__DIR__)."/App//config.php");
     $host   = HOST;
     $user   = USER;
     $pass   = PASS;
     $dbname = DBNAME;
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;",$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));     
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
    // echo "Connection Success";
   
} catch (PDOException $err) {
    echo $err->getMessage();
}
$sql = "UPDATE `menu` SET `MenuName`= ? ,`CategoryID`= ?, `Unit_price`= ? ,`Unit_cost`= ? WHERE MenuID = ? ";
// $sql = "UPDATE me_nu SET food_name = ? , price = ? WHERE id = ?";
$update = $pdo->prepare($sql);

$update->execute(array($_GET['MenuName'] , $_GET['CategoryID'] , $_GET['Unit_price'],$_GET['Unit_cost'],$_GET['id']));
header("Location: ../4monthly_sumeditable.php");
?>