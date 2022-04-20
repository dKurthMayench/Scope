<?php
    function dataready($data) {
        $data = base64_encode($data);
        return $data;
    }

    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }

    function activate($email){
        if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
        $con->query("UPDATE usuarios SET activo=1 WHERE email='".$email."'");
        session_destroy();
    }

    function send_mail($to_email, $codigo){
        $subject = "Activa tu cuenta de Scope";
        $body = "Hola :b aquí tienes el código de verificación: $codigo";
        $headers = "From: Scope";
        mail($to_email, $subject, $body, $headers);
    }
?>