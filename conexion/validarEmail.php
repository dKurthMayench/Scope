<?php
    require_once("./utils.php");
    session_start();
    if(isset($_GET['email'])){
        //si el correo introducido es del propio usuario, que no salte el error de que ya existe
        if($_SESSION['user']['email'] != $_GET['email']){
            if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
            $res = $con->query("SELECT * FROM usuarios WHERE email='".$_GET['email']."'");
            if($res->num_rows === 0) echo "1";
            else echo "0";
        }
        else echo "1";
    }
?>