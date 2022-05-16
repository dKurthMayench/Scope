<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    
    //comprueba si el usuario ha guardado la publicacion
    $res = $con->query("SELECT * FROM publicacionesguardadas WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['id']);
    
    //si la tiene guardada, la borrará de la lista de guardadas y viceversa
    if ($res->num_rows == 1) $con->query("DELETE FROM publicacionesguardadas WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['id']);
    else $con->query("INSERT INTO publicacionesguardadas VALUES ('".$_SESSION['user']['alias']."', ".$_POST['id'].")");
?>