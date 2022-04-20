<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //codifico el contenido en base64 para evitar que caracteres como por ejemplo " causen problemas al insertarlo en la base de datos
    $contenido = dataready($_POST['content']);

    //recupero el id de la categoría seleccionada
    $res = $con->query("SELECT id FROM categorias WHERE nombre = '".$_POST['categoria']."'");
    $cat = mysqli_fetch_assoc($res);
    
    //inserto el articulo en la base de datos
    if ($con->query("INSERT INTO articulos (titulo, contenido, op, categoria) VALUES ('".$_POST['tituloArt']."','".$contenido."','".$_SESSION['user']['alias']."',".$cat['id'].")")) $_SESSION['postSuccess'] = true;
    else $_SESSION['postSuccess'] = false;
    //postSuccess lo utilizaré para informar al usuario si todo ha salido bien o no
?>
