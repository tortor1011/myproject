<?php
    session_start();
    unset($_SESSION['TABLENUMBER']);
    unset($_SESSION['DATE1']);
    unset($_SESSION['RADIO']);
    unset($_SESSION['CART']);
    header('Location: ../7saveinfo2.php')

?>