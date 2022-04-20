<?php
    session_start();

    //ejemplo >> usuario = David, imagenSubida = descarga1.jpg

    $target_dir = "../resources/img/pfp/";
    
    //target_file = ../resources/img/pfp/ + descarga1.jpg
    $target_file = $target_dir . basename($_FILES["imgUpload"]["name"]);
    $uploadOk = 1;
    //imageFileType = pathinfo(../resources/img/pfp/descarga1.jpg) = jpg
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //name = ../resources/img/pfp/ + David + . + [extension]
    $name = $target_dir.$_SESSION['user']['alias'].".".$imageFileType;
    $user = $_SESSION['user']['alias'];
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) $uploadOk = 0;
    else{
        /*
        Si ya tiene foto de perfil, borra la anterior y la sustituye por la actual.
        Esto es necesario ya que al admitir más de 1 tipo de imagen, puede haber usuario.jpg y usuario.png a la vez,
        y eso daría problemas al recuperarla mas tarde.
        */
        if (file_exists("../resources/img/pfp/".$_SESSION['user']['alias'].".jpg")) unlink("../resources/img/pfp/".$_SESSION['user']['alias'].".jpg");
        if (file_exists("../resources/img/pfp/".$_SESSION['user']['alias'].".jpeg")) unlink("../resources/img/pfp/".$_SESSION['user']['alias'].".jpeg");
        if (file_exists("../resources/img/pfp/".$_SESSION['user']['alias'].".png")) unlink("../resources/img/pfp/".$_SESSION['user']['alias'].".png");
        if (file_exists("../resources/img/pfp/".$_SESSION['user']['alias'].".gif")) unlink("../resources/img/pfp/".$_SESSION['user']['alias'].".gif");
    }

    if ($uploadOk == 0) echo "error";
    else if (!move_uploaded_file($_FILES["imgUpload"]["tmp_name"], $name)) echo "error";
?>