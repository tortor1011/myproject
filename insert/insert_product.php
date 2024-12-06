<?php
    include(dirname(__DIR__).'/App/Insert.php');
    
    // config 1
    $tableName = "menu";
    // config 2
    $redirect = "../4monthly_sumeditable.php";
    
    
    $insert = new Insert($tableName);
    $insert->insert();
    header("Location: $redirect");
    exit;

?>