<?php
session_start();
// session_unset($_SESSION["usernamelogin"]);
session_destroy();
header( "Location: ../index.php" );