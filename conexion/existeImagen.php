<?php
    session_start();
    if (isset($_GET['alias'])) $user = $_GET['alias'];
    else $user = $_SESSION['user']['alias'];
    if(file_exists("../resources/img/pfp/".$user.".jpg")) echo "../../resources/img/pfp/".$user.".jpg";
    else if(file_exists("../resources/img/pfp/".$user.".jpeg")) echo "../../resources/img/pfp/".$user.".jpeg";
    else if(file_exists("../resources/img/pfp/".$user.".png")) echo "../../resources/img/pfp/".$user.".png";
    else if(file_exists("../resources/img/pfp/".$user.".gif")) echo "../../resources/img/pfp/".$user.".gif";
    else echo "error";
?>