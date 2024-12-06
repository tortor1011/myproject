<?php
session_start();
if (@$_SESSION["usernamelogin"]=="เจ้าของร้าน"){
    header( "Location: ../owner.php" );
}elseif(@$_SESSION["usernamelogin"]=="พนักงาน"){
    
}
else{header( "Location: ./index.php" );
}

if ($_SESSION["Status_Insert"]=="บันทึกสำเร็จ!"){
    echo "<script>alert('บันทึกสำเร็จ!')</script>"; 
    // session_unset($_SESSION["Status_Insert"]);
    session_destroy();

}
include('./Processphp/config.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <link rel="stylesheet" href="saveinfo2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
</head>
<DIV class="rightbutton">
    <a href="employee.php"><input class="btn-submit rightbutton1" type="submit" value="หน้าแรก"></a>
    <a href="7saveinfo2.php"><input class="btn-submit rightbutton2" value="รับคำสั่งซื้อ"></a>
    <a href="./11Search_baiset.php"><input class="btn-submit rightbutton1" value="ค้นหาใบเสร็จ"></a>
    <a href="./3.1dd.php"><input class="btn-submit rightbutton1" value="สรุปยอดขายประจำวัน"></a>
    <!-- <a href="11Search_baiset.html"><input class="btn-submit rightbutton1" value="พิมพ์ใบเสร็จรับเงิน"></a>
    <a href="8Checkmenu.html"><input class="btn-submit rightbutton1" value="เช็คยอดเมนู"></a> -->
</DIV>
<body>
    
    <div class="main">
    <div class="box1">
            <div class="table_component" role="region" tabindex="0">
            <table>
                <tbody>
                <form action="Processphp/list_order_info.php" method='POST'>
                    <tr>
                        <?php 
                            date_default_timezone_set("Asia/Bangkok");
                            $setDates =  date("Y").'-'.date("m").'-'.date("d");
                        ?>
                        <td><input class="date1" type="date" name="date2" value='<?php echo $setDates; ?>' required></td>
                        <td>สถานะ
                            <?php if(@$_SESSION['RADIO'] == 'ทานที่ร้าน'){ ?>
                                <input class="status" type="radio" checked name="radiostatus" value="ทานที่ร้าน"> ทานที่ร้าน
                                <input class="status" type="radio" name="radiostatus" value="กลับบ้าน"> กลับบ้าน</td>
                            <?php }else{ ?>
                            <input class="status" type="radio" name="radiostatus" value="ทานที่ร้าน"> ทานที่ร้าน
                            <input class="status" type="radio" checked name="radiostatus" value="กลับบ้าน"> กลับบ้าน</td>
                            <?php } ?>
                    </tr>
                    <tr>
                        <td>ชื่อลูกค้า <br>
                            <input class="text" name="username" class="textbox" type="text" placeholder="ชื่อลูกค้า">
                        </td>
                        
                    </tr>
                    <tr>
                        <td><label for="" class="title-numtable">เลขโต๊ะ</label>
                            <select name="tablenum" id="tablenum">
                                <?php if(!empty($_SESSION['TABLENUMBER'])){ ?>
                                    <option value="<?=$_SESSION['TABLENUMBER'];?>"><?=$_SESSION['TABLENUMBER'];?></option>
                                <?php }else{ ?>
                                <option value="1">1</option><option value="2">2</option>
                                <option value="3">3</option><option value="4">4</option>
                                <option value="5">5</option><option value="6">6</option>
                                <option value="7">7</option><option value="8">8</option>
                                <?php } ?>
                            </select></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <td>เมนู
                            <select name="menu" id="">
                            <?php
                                $query = $conn->query("SELECT * FROM `menu` WHERE 1");
                                 while($row = $query->fetch()){
                            ?>
                            <option value="<?php echo $row['MenuID']; ?>"> 
                                <?php echo $row['MenuName']; ?> 
                            </option>

                            <!-- <input type="hidden" value="<?php echo $row['Unit_price'];?>" name="price" /> -->

                            <?php } ?>
                            </select></td>
                            <td>จำนวน
                            <select name="qaunt" id="">
                                <option value="1">1</option><option value="2">2</option>
                                <option value="3">3</option><option value="4">4</option>
                                <option value="5">5</option><option value="6">6</option>
                                <option value="7">7</option><option value="8">8</option>
                            </select></td>
                        
                    </tr>
                    <tr>
                        <td colspan="2"><center><input class="submit" type="submit" value="เพิ่มเมนู"></center></td>
                    </tr>
                    </form>
                    
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th style="width: 100px;">#</th>
                        <th>เมนู</th>
                        <th>จำนวน</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $number = 1;
                $cart = @$_SESSION['CART']; 
                if($cart == null){
                  
                }else{

                ?>
                <?php
                foreach ($cart as $key => $value) {
                    $menu = $value["menu"];
                    $qaun = $value["qaunt"];
                    $food_name = $value["menu_name1"];
               ?>
                    <tr>
                        <td><?=$number++?></td>
                        <td><?=$food_name?></td>
                        <td><?=$qaun?> หน่วย</td>
                    </tr>
                    
                <?php 
                    }
                } 
                ?>
                </tbody>
            </table>

            <form class="formcolum" action="./8Checkmenu.php" method="post">
                        <tr>
                            <input class="" type="hidden" name="date2" value='<?php echo $_SESSION['DATE1']; ?>'>
                            <input class="" type="hidden" name="radio2" value='<?php echo $_SESSION['RADIO']; ?>'>
                            <input class="" type="hidden" name="tablenumber2" value='<?php echo $_SESSION['TABLENUMBER']; ?>'>
                                                                                                              
                            <td><a href="./Processphp/cancel_order.php"><input class="submit color1" value="ยกเลิกออเดอร์"></a></td>
                            <td><input class="submit color2" type="submit" value="บันทึก"></td>
                        </tr>
            </form>
    </div>
    </div>
    <script>
        let status = document.querySelectorAll('.status');
        let tablenum = document.querySelector('#tablenum');
        let title  = document.querySelector('.title-numtable');
        tablenum.style.display = "none"
        title.style.display = "none"
        status.forEach(element => {
            element.addEventListener('click',()=>{
                if(element.value == 'กลับบ้าน'){
                    tablenum.style.display = "none"
                    title.style.display = "none"
                }else{
                    tablenum.style.display = "block"
                    title.style.display = "block"
                }
            })
            
        });
    </script>
</body>
</html> 