<?php
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    //elimino el comentario con el id especificado
    $con->query("DELETE FROM comentarios WHERE id=".$_POST['idCom']);
?>