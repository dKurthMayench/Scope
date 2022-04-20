<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    
    $res = $con->query("SELECT * FROM publicacionesguardadas WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['id']);
    
    if ($res->num_rows == 1) $con->query("DELETE FROM publicacionesguardadas WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['id']);
    else $con->query("INSERT INTO publicacionesguardadas VALUES ('".$_SESSION['user']['alias']."', ".$_POST['id'].")");
?>