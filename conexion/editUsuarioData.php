<?php
    require_once("./utils.php");
    session_start();
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //recupero las variables de _POST
    if(isset($_POST['desc'])) $desc = $_POST['desc'];
    else $desc = NULL;
    if(isset($_POST['nombre'])) $nombre = $_POST['nombre'];
    else $nombre = NULL;
    if(isset($_POST['apellidos'])) $apellidos = $_POST['apellidos'];
    else $apellidos = NULL;

    //preparo la sentencia para actualizar la informacion de usuario
    $stmt = $con->prepare("UPDATE usuarios SET descripcion=?, nombre=?, apellidos=? WHERE alias=?");
    $stmt->bind_param("ssss", $desc, $nombre, $apellidos, $_SESSION['user']['alias']);
    $stmt->execute();

    //recupero la informacion de usuario actualizada
    $res = $con->query("SELECT * FROM usuarios WHERE alias='".$_SESSION['user']['alias']."'");
    $usuario = mysqli_fetch_assoc($res);
    $_SESSION['user'] = $usuario;
?>