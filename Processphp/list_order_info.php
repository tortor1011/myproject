<!-- //echo $_GET["tablenum"];
//echo $_GET["radiostatus"];
//echo $_GET["menu"];
//echo $_GET["qaunt"];
//echo $_GET["date2"];  -->

<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

include('./config.php');

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $sql = "INSERT INTO `co_orders`( `Date_Ord`, `TebleNum`, `menu`, `Qauntity`, `Status`) VALUES (?,?,?,?,?)";
  // $query = $conn->prepare($sql);
  // $query->execute([$_POST["date2"],$_POST["tablenum"],$_POST["menu"],$_POST["qaunt"],$_POST["radiostatus"]]);
  // $_SESSION["Status_Insert"]="บันทึกสำเร็จ!";
  // header( "Location: ../7saveinfo2.php" ); 

  $tablenumber     = isset($_POST['tablenum']) ? $_POST['tablenum'] : '';
  $product_id   = isset($_POST['menu'])     ? $_POST['menu'] : '';
  $product_price   = isset($_POST['price'])    ? $_POST['price'] : 1;
  $product_amount   = isset($_POST['qaunt'])  ? $_POST['qaunt'] : 1;
  $_SESSION['TABLENUMBER'] =   $tablenumber;
  $_SESSION['DATE1'] =   $_POST['date2'];
  $_SESSION['RADIO'] = $_POST['radiostatus'];
  $food_name = $conn->query("SELECT MenuID,MenuName ,Unit_price FROM `menu` where MenuID = '".$product_id."' ");
  $data_name = $food_name->fetch(PDO::FETCH_ASSOC);

  
  if(empty($_SESSION['CART'])){
      $_SESSION['CART'] = array();
  }
  $total = $product_amount * $product_price;

  if(!empty($_SESSION['CART'][$product_id])){
      if($product_amount == 1){
          $_SESSION['CART'][$product_id]['qaunt'] += $product_amount;
  
      }else{
          $_SESSION['CART'][$product_id]['qaunt'] += $product_amount;     
  }
  
  }else{
      if($product_amount != 1){
          $_SESSION['CART'][$product_id] = array(
              "menu"          => $product_id,
              'qaunt'         =>  $product_amount,
              'menu_name'     => $data_name['MenuID'],
              'menu_name1'     => $data_name['MenuName'],
              'price'        => $data_name['Unit_price']
          );   
      }else{
          $_SESSION['CART'][$product_id] = array(
              "menu"          => $product_id,
              'qaunt'         =>  $product_amount,
              'menu_name'     => $data_name['MenuID'],
              'menu_name1'     => $data_name['MenuName'],
              'price'           => $data_name['Unit_price']
          );
      }  
  }

header("Location: ../7saveinfo2.php");
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
