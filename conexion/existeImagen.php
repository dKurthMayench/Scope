<?php
    session_start();
    $user = $_SESSION['user']['alias'];
    if(file_exists("../resources/img/pfp/".$user.".jpg")) echo "jpg";
    else if(file_exists("../resources/img/pfp/".$user.".jpeg")) echo "jpeg";
    else if(file_exists("../resources/img/pfp/".$user.".png")) echo "png";
    else if(file_exists("../resources/img/pfp/".$user.".gif")) echo "gif";
    else echo "error";
?>