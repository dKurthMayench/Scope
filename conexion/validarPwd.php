<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    
    //pwd = contraseña introducida
    $pwd = $_GET['pwd'];

    /**
     * Este if me sirve para poder usar el mismo archivo para validar la contraseña en el inicio de sesión (cuando el user se pasa por GET) y 
     * en la página de perfil (cuando el user está en la variable de sesion).
     * Si el usuario no ha iniciado sesión, se recogerá la variable de $_GET. Si ha iniciado sesión, se cogerá de $_SESSION.
     */
    if (isset($_SESSION['user']['alias'])) $user = $_SESSION['user']['alias'];
    else $user = $_GET['user'];

    //recupero la información del usuario introducido, y la guardo en una variable de sesión
    $res = $con->query("SELECT * FROM usuarios WHERE alias='".$user."'");
    $usuario = mysqli_fetch_assoc($res);

    //si la contraseña es correcta, devuelve 0. Si no, 1.
    if (password_verify($pwd, $usuario['password'])) {
        //inicio sesión
        $_SESSION['user'] = $usuario;
        echo "0";
    }
    else echo "1";
?>