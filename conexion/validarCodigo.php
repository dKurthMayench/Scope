<?php
    session_start();
    require_once("./utils.php");
    if (!isset($_SESSION['codigo'])) echo "not set";
    else {
        if ($_SESSION['codigo'] != $_GET['codigo']) echo "not match";
        else {
            activate($_GET['email']);
            echo 0;
        }
    }
?>