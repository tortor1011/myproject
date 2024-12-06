<?php
    include(dirname(__DIR__).'/App/Select.php');
    $show = new Select();
   
    // Config  อ้างอิงจากในฐานข้อมูล
    $tableName = 'category';
    $option = ' * '; // * คือดึงมาทุกคอลัมน์ในตารางฐานข้อมูล
    // $option = ' field1, field2 ';  คือดึงมาเฉพาะคอลัมน์ที่ต้องการในตารางฐานข้อมูล


    $show->setOption($option); 
    $show->setTable($tableName);
    $stmt = $show->query();
?>

<table>
    <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
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
                <?php echo $r['CategoryName'] ?>
            </td>

            <td>
                <!-- <a href="./edit/edit_product.php?id=<?php echo $r['id'] ?>" class="btn btn-warning" >แก้ไขข้อมูล</a> -->
                <a href="./delete/delete_category.php?id=<?php echo $r['CategoryID'] ?>" class="btn btn-danger" onclick="return confirm('ต้องการลบข้อมูลหรือไม่?');">ลบข้อมูล</a>
            </td>

        </tr>
    <?php endwhile; ?>
</table>
