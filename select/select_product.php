<?php
    include(dirname(__DIR__).'/App/Select.php');
    $show = new Select();
    
    // Config  อ้างอิงจากในฐานข้อมูล
    $tableName = 'menu';
    $option = ' * '; // * คือดึงมาทุกคอลัมน์ในตารางฐานข้อมูล
    // $option = ' field1, field2 ';  คือดึงมาเฉพาะคอลัมน์ที่ต้องการในตารางฐานข้อมูล

    $show->connect();
    // $show->setOption($option); 
    // $show->setTable($tableName);
    // $stmt = $show->query();
    $category = $r['CategoryID'];
    $stmt = $show->pdo->query("
        SELECT 
            menu.`MenuID` as MenuID,
            menu.`MenuName` AS MenuName,
            menu.`Unit_price` AS Unit_price,
            menu.`Unit_cost` AS Unit_cost,
            category.CategoryName  AS CategoryName,
            category.CategoryID  AS CategoryID 
        FROM menu 
        JOIN category ON menu.CategoryID = category.CategoryID
        ORDER BY menu.`MenuID` DESC
    ");
    $stmt->execute();
   
?>

<table>
    <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>ประเภทสินค้า</th>
        <th>ราคาต่อหน่วย</th>
        <th>ราคาต้นทุน</th>
        <th></th>
    </tr>
    <?php
        $NUMBER = 0;
        while($r = $stmt->fetch(PDO::FETCH_ASSOC)): 
        $NUMBER++;
    ?>
        <tr>
            <td>
                <?php echo $NUMBER; ?>
            </td>
            <td>
                <?php echo $r['MenuName'] ?>
            </td>
            <td>
               
                <?php echo $r['CategoryName'] ?>
         
            </td>
            <td>
                <?php echo $r['Unit_price'] ?>
            </td>
            <td>
                <?php echo $r['Unit_cost'] ?>
            </td>

            <td>
                <a href="./edit/edit_product.php?id=<?php echo $r['MenuID'] ?>" class="btn btn-warning" >แก้ไขข้อมูล</a>
                <a href="./delete/delete_product.php?id=<?php echo $r['MenuID'] ?>" class="btn btn-danger" onclick="return confirm('ต้องการลบข้อมูลหรือไม่?');">ลบข้อมูล</a>
            </td>

        </tr>
    <?php endwhile; ?>
</table>
