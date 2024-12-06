<?php
session_start();
unset($_SESSION['CART'][$_GET['id']]);
header("Location: ../8Checkmenu.php");
?>