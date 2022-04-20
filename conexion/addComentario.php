<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //codifico el contenido del comentario en base64 para evitar problemas con caracteres especiales
    $comentario = dataready($_GET['comentario']);
    
    //añado el comentario a la base de datos
    $con->query("INSERT INTO comentarios (comentador, articulo, contenido) VALUES ('".$_SESSION['user']['alias']."', ".$_GET['articulo'].", '".$comentario."')");
?>