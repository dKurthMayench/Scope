<?php
    require_once("./utils.php");
    session_start();
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    $_SESSION['user']['password'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    
    $con->query("UPDATE usuarios 
                SET password='".$_SESSION['user']['password']."'
                WHERE alias='".$_SESSION['user']['alias']."'");

?>