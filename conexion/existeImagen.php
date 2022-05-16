<?php
    session_start();
    
    if (isset($_GET['alias'])) $user = $_GET['alias'];
    else $user = $_SESSION['user']['alias'];

    //comprueba si existe una imagen de perfil con los formatos jpg, jpeg, png o gif.
    if(file_exists("../resources/img/pfp/".$user.".jpg")) echo "../../resources/img/pfp/".$user.".jpg";
    else if(file_exists("../resources/img/pfp/".$user.".jpeg")) echo "../../resources/img/pfp/".$user.".jpeg";
    else if(file_exists("../resources/img/pfp/".$user.".png")) echo "../../resources/img/pfp/".$user.".png";
    else if(file_exists("../resources/img/pfp/".$user.".gif")) echo "../../resources/img/pfp/".$user.".gif";
    else echo "error";
?>