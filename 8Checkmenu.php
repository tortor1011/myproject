<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Checkmenu.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocoamore</title>
</head>

<body>
    <div class="main">
    <!-- <div class="mycolum"> -->
        <div class="colum1">

                <div class="table_component" role="region" tabindex="0">
                <!-- <table class="table1">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 0px;">เช็คยอดเมนู</td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"> <input class="date1" type="date"> </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"> <input class="search" type="text">
                            <button>ค้นหา</button> </td>
                        </tr>
                        <tr>
                            <td class="bg">โต๊ะ 01 - 6:00 PM</td>
                        </tr>
                        <tr>
                            <td class="bg">โต๊ะ 01 - 6:00 PM</td>
                        </tr>
                        <tr>
                            <td class="bg">โต๊ะ 01 - 6:00 PM</td>
                        </tr>
                        <tr>
                            <td class="bg">โต๊ะ 01 - 6:00 PM</td>
                        </tr>
                    </tbody>
                </table> -->
               <!--  -->
        </div>
        <div class="colum2">
            <div class="table_component" role="region" tabindex="0">
                <table>

                    <tbody >
                        <tr>
                            <td class="bg" colspan="6" ><center><h1>โต๊ะ <?=$_SESSION['TABLENUMBER'];?> - 6:00 PM</h1></center></td>
                            
                        </tr>
                        <tr style="background-color: #d7d7ff; color:white !important;">
                            <td>#</td>
                            <td>รายการ</td>
                            <td>จำนวน / หน่วย</td>
                            <td>ราคา / หน่วย</td>
                            <td>ราคารวม</td>
                            <td></td>
                        </tr>
                        <?php
                            $number = 1;
                            $cart = @$_SESSION['CART']; 
                            if($cart == null){
                            
                            }else{

                            ?>
                            <?php
                            $sumPrice = 0;
                            $amount = 0;
                            foreach ($cart as $key => $value) {
                                $menu = $value["menu"];
                                $qaun = $value["qaunt"];
                                $food_name = $value["menu_name1"];
                                $price = $value['price'];
                                $sumPrice +=  ($qaun*$price);
                                $amount += $qaun; 
                        ?>
                                <tr  class="bg">
                                    <td><?=$number++?></td>
                                    <td><?=$food_name?></td>
                                    <td><?=$qaun?> </td>
                                    <td>
                                        <?php 
                                            if( $qaun > 1){
                                               echo  $price;
                                             }else{

                                            }
                                        ?>
                                    </td>
                                    <tD><?=($qaun*$price)?></td>
                                    <td class="bg"><a href="./Processphp/delete_row_cart.php?id=<?=$menu?>"><button class="delete">ลบรายการ</button></td>
                                </tr>
                                
                            <?php 
                                }
                            } 
                            ?>
                        <!-- <tr>
                            <td class="bg">
                                <p>iceberge coco ×1</p>
                                
                            </td>
                            
                            <td class="bg">
                                <p>฿ 89 .00</p>
                            </td>
                            <td class="bg"><button class="delete">ลบรายการ</button></td>
                        </tr>
                        <tr>
                            <td class="bg">
                                
                                <p>iceberge greentea ×1</p>
                                
                            </td>
                            
                            <td class="bg">
                                
                                <p> ฿ 89 .00</p>  

                            </td>
                            
                            <td class="bg"><button class="delete">ลบรายการ</button></td>
                        </tr>
                        <tr>
                            <td class="bg">
                                
                                <p>iceberge milk ×1</p>
                            </td>
                            
                            <td class="bg">
                                
                                <p>฿ 149 .00</p>
                            </td>
                            <td class="bg"><button class="delete">ลบรายการ</button></td>
                        </tr> -->
                        <tr>
                            <td class="bg">รวมทั้งหมด</td>
                            <td class="bg"></td>
                            <td class="bg"><?=$amount; ?></td>
                            <td class="bg"></td>
                            <td class="bg"><?php echo  '฿'.number_format($sumPrice,2); ?></td>
                            <td class="bg" ></td>
                        </tr>
                        <tr>
                        <form class="formcolum" action="./Processphp/save_order.php" method="post">
                            <tr>
                                <input class="" type="hidden" name="date2" value='<?php echo $_SESSION['DATE1']; ?>'>
                                <input class="" type="hidden" name="radio2" value='<?php echo $_SESSION['RADIO']; ?>'>
                                <input class="" type="hidden" name="tablenumber2" value='<?php echo $_SESSION['TABLENUMBER']; ?>'>
                                <input type="hidden" name='billnum' value="<?php echo rand(1,100000);?>">
                                <td class="bg" colspan="6"><center><button class="payment" type="submit">ชำระเงิน</button></center></td>    
                            </tr>
                        </form>  
                    </tbody>
                </table>

        </div>
    <!-- </div> -->
    </div>
    <DIV class="rightbutton">
    <a href="employee.php"><input class="btn-submit rightbutton1" type="submit" value="หน้าแรก"></a>
    <!-- <a href="7saveinfo2.php"><input class="btn-submit rightbutton2" value="รับคำสั่งซื้อ"></a>
    <a href="./11Search_baiset.php"><input class="btn-submit rightbutton1" value="ค้นหาใบเสร็จ"></a>
    <a href="./3.1dd.php"><input class="btn-submit rightbutton1" value="สรุปยอดขายประจำวัน"></a> -->
</DIV>
</body>

</html>