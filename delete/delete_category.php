<?php
 include(dirname(__DIR__).'/App/Delete.php');
 $delete = new Delete;

// config อ้างอิจาก ฐานข้อมูล
// config 1
$primaryKeyName = 'CategoryID';
// config 2
$tableName      = 'category';
// config 3
$redirect = '../catagory.php';

$delete->connect();
$category = $delete->pdo->query("
    SELECT * FROM menu
    JOIN category ON menu.CategoryID = category.CategoryID 
    WHERE category.CategoryID  = '".$_GET['id']."' 
");
$category->execute();
$count = $category->rowCount();
if($count > 0){
    echo "คุณไม่สามารถลบประเภทสินค้านี้ได้ เนื่องจากมีข้อมูลอยู่ตารางอื่นแล้ว<br>";
    echo "<a href='../catagory.php'>กลับไป</a>";
    exit;
}else{
    $delete->setTable($tableName);
    $delete->setID($primaryKeyName , @$_GET['id']);
    $delete->start_delete();
    header('Location: '.$redirect);
}
exit;
?>