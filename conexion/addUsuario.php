<?php
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    //encripto la contraseña y añado el usuario a la bbdd
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $con->query("INSERT INTO usuarios (alias, password, email) VALUES ('".$_POST['user']."','".$pwd."','".$_POST['email']."')");
?>