<?php
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    //elimino la categoría con el id especificado
    $con->query("DELETE FROM articulos WHERE id = ".$_POST['idArt']);
?>