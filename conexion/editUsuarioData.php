<?php
    require_once("./utils.php");
    session_start();
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    if(isset($_POST['desc'])) $desc = $_POST['desc'];
    else $desc = NULL;
    if(isset($_POST['nombre'])) $nombre = $_POST['nombre'];
    else $nombre = NULL;
    if(isset($_POST['apellidos'])) $apellidos = $_POST['apellidos'];
    else $apellidos = NULL;

    $stmt = $con->prepare("UPDATE usuarios SET descripcion=?, nombre=?, apellidos=? WHERE alias=?");
    $stmt->bind_param("ssss", $desc, $nombre, $apellidos, $_SESSION['user']['alias']);
    $stmt->execute();
    $res = $con->query("SELECT * FROM usuarios WHERE alias='".$_SESSION['user']['alias']."'");
    $usuario = mysqli_fetch_assoc($res);
    $_SESSION['user'] = $usuario;
    echo "UPDATE usuarios SET descripcion='".$desc."', nombre='".$nombre."', apellidos='".$apellidos."' WHERE alias='".$_SESSION['user']['alias']."'";
?>