<?php
    require_once("./utils.php");
    session_start();
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //actualizo el registro de la bbdd
    $con->query("UPDATE usuarios 
                SET password='".$_SESSION['user']['password']."'
                WHERE alias='".$_SESSION['user']['alias']."'");

    //actializo la variable de sesion en caso de que la necesite luego
    $_SESSION['user']['password'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    

?>