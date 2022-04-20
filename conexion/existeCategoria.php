<?php
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //si existe la categoría con el id especificado, devuelve 0. Si no, 1.
    $res = $con->query("SELECT * FROM categorias WHERE nombre='".$_POST['nombre']."'");
    if($res->num_rows == 0) echo "1";
    else echo "0";
?>