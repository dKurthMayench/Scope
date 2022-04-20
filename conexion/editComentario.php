<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    
    //codifico el contenido del comentairo en bas64 para evitar problemas con caracteres especiales
    $comentario = dataready($_POST['contenido']);

    //actualizo el comentario con el id especificado
    $con->query("UPDATE comentarios SET contenido = '".$comentario."' WHERE id=".$_POST['idCom']);
?>