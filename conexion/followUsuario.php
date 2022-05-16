<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //comprueba si el usuario sigue al otro usuario
    $res = $con->query("SELECT * FROM siguiendo WHERE seguidor='".$_SESSION['user']['alias']."' AND siguiendo='".$_POST['alias']."'");

    //si ya le sigue, dejará de seguirlo y viceversa
    if($res->num_rows == 0) $con->query("INSERT INTO siguiendo VALUES ('".$_SESSION['user']['alias']."','".$_POST['alias']."')");
    else $con->query("DELETE FROM siguiendo WHERE seguidor='".$_SESSION['user']['alias']."' AND siguiendo='".$_POST['alias']."'");
?>