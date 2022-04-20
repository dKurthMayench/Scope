<?php
    require_once("./utils.php");
    session_start();
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    $con->query("UPDATE usuarios SET descripcion='".$_POST['desc']."',nombre='".$_POST['nombre']."',apellidos='".$_POST['apellidos']."'WHERE alias='".$_SESSION['user']['alias']."'");
    $res = $con->query("SELECT * FROM usuarios WHERE alias='".$_SESSION['user']['alias']."'");
    $usuario = mysqli_fetch_assoc($res);
    $_SESSION['user'] = $usuario;
?>