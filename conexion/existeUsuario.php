<?php
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    
    //si existe el usuario con el alias especificado, devuelve 0. Si no, 1.
    $res = $con->query("SELECT * FROM usuarios WHERE alias='".$_GET['user']."'");
    if($res->num_rows == 0) echo "1";
    else echo "0";
?>