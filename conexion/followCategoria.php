<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    $res = $con->query("SELECT * FROM usuariosxcategorias WHERE alias='".$_SESSION['user']['alias']."' AND idCat=".$_POST['idCat']);

    if($res->num_rows == 0) $con->query("INSERT INTO usuariosxcategorias VALUES ('".$_SESSION['user']['alias']."',".$_POST['idCat'].")");
    else $con->query("DELETE FROM usuariosxcategorias WHERE alias='".$_SESSION['user']['alias']."' AND idCat=".$_POST['idCat']);
?>