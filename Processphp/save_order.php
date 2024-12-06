<?php
include('./config.php');
session_start();
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
echo "<pre>";
print_r($_SESSION['CART']);
echo "</pre>";
$data = "";
$tablenumber2 = $_POST['tablenumber2'];
$radio2 = $_POST['radio2'];
$date2 = $_POST['date2'];

$sql = "INSERT INTO `co_orders`
(
    `Date_Ord`, 
    `TebleNum`, 
    `Status`
) VALUES (
    '".$date2."',
    '".$tablenumber2."',
    '".$radio2."'
)
";
$insert = $conn->query($sql);
$id=$conn->lastInsertID();
foreach ($_SESSION['CART'] as $key => $value) {
    echo $id;
    echo $value['menu_name'];
    echo "<pre>";
    print_r($value);
    
    echo "</pre>";
    $sql1 = "INSERT INTO `detail_co_orders`
(
    `Sellprice`, 
    `Qty`, 
    `MenuID`,
    OrdersID
) VALUES (
    '".$value['price']."',
    '".$value['qaunt']."',
    '".$value['menu_name']."',
    '".$id."'
)
";
$insert2 = $conn->query($sql1);
}

unset($_SESSION['CART']);
header("Location: ../10baiset.php?id=$id");

?>