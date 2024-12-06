<?php
include('./Processphp/config.php');
session_start();
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$sql = "SELECT * FROM `co_orders` WHERE OrdersID='".$_GET['id']."' OR bill_number='".$_GET['id']."'";
$data = $conn->query($sql);
while($row=$data->fetch()):

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="baiset2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    
        <div class="table_component" role="region" tabindex="0">
        <table>
        
            <thead>
                
            </thead>
            <tbody>
                <tr>
                    <td><h1><img src='./Picture/Logo_cocoamore.png' > </img> </h1></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h1>ใบเสร็จรับเงิน</h1></td>
                </tr>
                <tr>
                    <th><h3>ร้าน CocoaMore</h3></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>เลขที่ <?php echo $row["bill_number"] ?></td>
                </tr>
                <tr>
                    <td>ถนนเลียบกำแพงหลังมข.วัดป่าโนนม่วง,Khon Kaen, Thailand, 40000<p>โทร. 089 252 5133</p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>วันที่ <?php 
                    // date_default_timezone_set("Asia/Bangkok");
                    // $setDates =  date("Y").'-'.date("m").'-'.date("d");
                    // $time = time();
                    // $actual_time = date(' H:i:s / ',$time);
                    // echo $actual_time ;
                    echo $row["date_time_stamp"];?></td>
                </tr>
                
                <tr class="border">
                    <th>ลำดับที่ </th>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>รวมเงิน</th>
                </tr>
                <?php
                $sql = "
                    SELECT 
                    me_nu.food_name ,
                    me_nu.price , 
                    co_orders.
                    `Qauntity`,
                    (co_orders.`Qauntity` * me_nu.price) AS sumall 
                
                    FROM `co_orders` 
                    JOIN me_nu on co_orders.menu = me_nu.id 
                    WHERE `bill_number` = '".$row["bill_number"]."' ";
                    
                $data = $conn->query($sql);
                $number = 0;
                $qaun  = 0;
                $price = 0;
                $sumall = 0;
                while($row1=$data->fetch()):
                    $number++;
                ?>
               
                <tr>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $row1['food_name'] ?></td>
                    <td><?php echo $row1['Qauntity'] ?></td>
                    <td>
                    <?php 
                            
                            echo $row1['price'];
                    
                    ?>
                    </td>
                    <td><?php echo $row1['sumall'] ?></td>
                </tr>

                <?php
                
                    $qaun += $row1['Qauntity'];
                    $sumall += $row1['sumall'];
                ?>

                <?php endwhile; ?>
               
                <tr class="border">
                    <td ><p>รวมเป็นเงิน</p>
                    <p>ภาษีมูลค่าเพิ่ม 7%</p>
                    <p>รวมทั้งสิ้น</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>
                       
                        <p> <?=(number_format($sumall,2))?> บาท </p>
                        <?php $vat = ($sumall * 0.07) ?>
                        <p> <?php echo number_format($vat,2) ?> บาท </p>
                        <?php $vat2 = ($sumall * 0.07) + $sumall ?>
                        <p> <?=(number_format($vat2,2))?> บาท </p> 
                    </th>
                </tr>
            </tbody>
        </table>
        <!-- <DIV class="rightbutton">
            <a href="./employee.php"><input class="btn-submit rightbutton1" type="submit" value="หน้าแรก"></a>
            <a href="7saveinfo2.php"><input class="btn-submit rightbutton1" value="รับคำสั่งซื้อ"></a>
            <a href="10baiset.html"><input class="btn-submit rightbutton2" value="พิมพ์ใบเสร็จรับเงิน"></a>
            <a href="8Checkmenu.html"><input class="btn-submit rightbutton1" value="เช็คยอดเมนู"></a>
        </DIV> -->
</body>
</html>
<?php endwhile; ?>

<script>
$(document).ready(function(){
//   $(".table_component").load(function(){
    window.print();
});
</script>