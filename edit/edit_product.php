<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../monthly_sumeditable.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูล</title>
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br><br>
    <center><div class='box2'>
    <center><div class="inputwithicon">
          <h1>แก้ไขข้อมูล</h1>
        </div></center>

<?php
    include(dirname(__DIR__).'/App/Edit.php');
    $edit = new Edit;
    $id = isset($_GET['id']) ? htmlspecialchars(trim($_GET['id'])) : '';
    $type_submit = isset($_POST['submit']) ? htmlspecialchars(trim($_POST['submit'])) : '';


    //config 1
    $primaryKeyName = "MenuID";
    //config 2
    $tableName = "menu";
 
    $edit->connect();
    $selectUpdate = "SELECT * FROM $tableName WHERE $primaryKeyName = '".$id."' ";
    $selectUpdate = $edit->pdo->query($selectUpdate);
    while($data=$selectUpdate->fetch()):
?>
<form method="get" action="./processEdit.php">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input name="MenuName" class="textbox" type="text" value="<?=$data['MenuName']?>" placeholder="กรอกสินค้า">
          <br><br>
          <select name="CategoryID"  class="textbox">
            <!-- <option>เลือกประเภท</option> -->
            <?php 
              $sql = "SELECT * FROM `category` ORDER BY `CategoryID` ASC";
              $stmt = $edit->pdo->query($sql);
              $stmt->execute();
              while($r = $stmt->fetch()):
            ?>
            <option value="<?php echo $r['CategoryID']?>"><?php echo $r['CategoryName']?></option>
            <?php endwhile; ?>
          </select>
          <br><br>
          <input name="Unit_price" class="textbox" type="text" value="<?=$data['Unit_price']?>" placeholder="กรอกราคา">
          <br><br>
          <input name="Unit_cost" class="textbox" type="text" value="<?=$data['Unit_cost']?>" placeholder="กรอกราคาต้นทุน">
          <br><br>
            <button  class="sub" type="submit" value="update" >ยืนยันการแก้ไข</button></div></center>
</form></center>
<?php endwhile; ?>
</div>
</body>
</html>
