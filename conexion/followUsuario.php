<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    $res = $con->query("SELECT * FROM siguiendo WHERE seguidor='".$_SESSION['user']['alias']."' AND siguiendo='".$_POST['alias']."'");

    if($res->num_rows == 0) $con->query("INSERT INTO siguiendo VALUES ('".$_SESSION['user']['alias']."','".$_POST['alias']."')");
    else $con->query("DELETE FROM siguiendo WHERE seguidor='".$_SESSION['user']['alias']."' AND siguiendo='".$_POST['alias']."'");
?>