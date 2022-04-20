<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    /*
      codifico en base64 la descripcion evitar problemas con caracteres especiales, 
      y entre otras cosas para evitar inyeccion sql
    */
    $desc = dataready($_POST['desc']);
    $nombre = $_POST['nombre'];
    
    //hago el insert. catSuccess lo utilizaré para informar al usuario si se ha creado correctamente la categoría.
    if($con->query("INSERT INTO categorias (nombre, descripcion, propietario) VALUES ('".$nombre."', '".$desc."', '".$_SESSION['user']['alias']."')")) $_SESSION['catSuccess'] = true;
    else $_SESSION['catSuccess'] = false;
?>