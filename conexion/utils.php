<?php

    //ya se que podría utilizar directamente base64_encode, pero antes la funcion tenia más cosas y no veo necesario
    //buscar en todos los archivos y cambiarla asi que la dejo como está
    function dataready($data) {
        $data = base64_encode($data);
        return $data;
    }

    //redirige al usuario a la url especificada
    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }

    //activa el usuario con el email especificado
    function activate($email){
        if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
        $con->query("UPDATE usuarios SET activo=1 WHERE email='".$email."'");
        session_destroy();
    }
?>