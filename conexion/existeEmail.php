<?php
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //si existe un usuario con el email especificado, devuelve 0. Si no, 1.
    $res = $con->query("SELECT * FROM usuarios WHERE email='".$_GET['email']."'");
    if($res->num_rows == 0) echo "1";
    else echo "0";
?>