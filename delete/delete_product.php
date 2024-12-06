<?php
 include(dirname(__DIR__).'/App/Delete.php');
 $delete = new Delete;

// config อ้างอิจาก ฐานข้อมูล
// config 1
$primaryKeyName = 'MenuID';
// config 2
$tableName      = 'menu';
// config 3
$redirect = '../4monthly_sumeditable.php';



$delete->connect();
$category = $delete->pdo->query("
    SELECT * FROM menu
    JOIN detail_co_orders ON menu.MenuID = detail_co_orders.MenuID 
    WHERE detail_co_orders.MenuID   = '".$_GET['id']."' 
");
$category->execute();
$count = $category->rowCount();
if($count > 0){
    echo "คุณไม่สามารถลบสินค้านี้ได้ เนื่องจากมีข้อมูลอยู่ตารางอื่นแล้ว<br>";
    echo "<a href='../4monthly_sumeditable.php'>กลับไป</a>";
    exit;
}else{
    $delete->setTable($tableName);
    $delete->setID($primaryKeyName , @$_GET['id']);
    $delete->start_delete();
    header('Location: '.$redirect);
    exit;
}
?>