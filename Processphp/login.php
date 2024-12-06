<?php
session_start();
include('./config.php');                                                                       

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$username=$_GET['username'];
$password=$_GET['pass'];
$sql = "SELECT * FROM `user_interface` WHERE UserName='".$username."' AND Password='".$password."' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
      
    while ($row=mysqli_fetch_assoc($result)) {
        $_SESSION["usernamelogin"]=$row['Position'];
        if ($row['Position']=="เจ้าของร้าน") {
            header( "Location: ../owner.php" );
        } else {
            header( "Location: ../employee.php" );
        }
    }
    
    
  // output data of each row
  
} else {
    echo "ล็อคอินไม่สำเร็จ";
}

mysqli_close($conn);
?>