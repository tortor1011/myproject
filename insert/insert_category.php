<?php
    include(dirname(__DIR__).'/App/Insert.php');
    
    // config 1
    $tableName = "category";
    // config 2
    $redirect = "../catagory.php";
    
    
    $insert = new Insert($tableName);
    $insert->insert();
    header("Location: $redirect");
    exit;

?>