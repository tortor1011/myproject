<?php
session_start();
if (@$_SESSION["usernamelogin"]=="เจ้าของร้าน"){
    header( "Location: ../owner.php" );
}elseif(@$_SESSION["usernamelogin"]=="พนักงาน"){
    
}
else{header( "Location: ./index.php" );
}
include('./Processphp/config.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$bill=$_GET['bill'];

$sql = "SELECT * FROM `co_orders` WHERE OrdersID='".$_GET['id']."' ";
$data = $conn->query($sql);
while($row=$data->fetch()):

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="baiset.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    
        <div class="table_component" role="region" tabindex="0">
        <table>
        
            <thead>
                <center><a href='./10.1baiset.php?id=<?php echo  $_GET['id'] ?>'><button>สั่งพิมพ์</button></a></center>
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
                    <th><h3></h3></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>เลขที่ <?php echo $row["OrdersID"] ?></td>
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
                    echo $row["Date_Ord"];?></td>
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
                    SELECT * FROM `detail_co_orders`
                    JOIN menu ON detail_co_orders.MenuID = menu.MenuID
                    WHERE `OrdersID` ='".$row["OrdersID"]."' 
                ";
                    
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
                    <td><?php echo $row1['MenuName'] ?></td>
                    <td><?php echo $row1['Qty'] ?></td>
                    <td>
                        <?php 
                            
                                    echo $row1['Unit_price'];
                            
                        ?>
                    </td>
                    <td><?php echo number_format(($row1['Qty']*$row1['Unit_price']),2) ?></td>
                </tr>

                <?php
                
                    $qaun += $row1['Qty'];
                    $sumall += ($row1['Qty']*$row1['Unit_price']);
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
        <DIV class="rightbutton">
            <a href="./employee.php"><input class="btn-submit rightbutton1" type="submit" value="หน้าแรก"></a>

        </DIV>
</body>
</html>
<?php endwhile; ?>
<!-- <script>
$(document).ready(function(){
  $("p").load('./10.1baiset.php',function(){
    window.print();
  });
});
</script> -->