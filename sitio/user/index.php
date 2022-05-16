<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>

    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <link rel="stylesheet" href="resources/styles.css">

    <?php
        session_start();
        require_once("../../conexion/utils.php");
        if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
        $resUsuario = $con->query("SELECT * FROM usuarios WHERE alias = '".$_GET['alias']."'");
        $usuario = mysqli_fetch_assoc($resUsuario);
        if($usuario['alias'] == $_SESSION['user']['alias']) header("Location: ../profile");
    ?>
    <title><?php echo $usuario['alias']; ?></title>
</head>
<body>
    <input id='aliasUsuario' type="hidden" value="<?php echo $usuario['alias']; ?>">
    <div id="header">
        <div class="inicio">
            <button class="btn btnInicio" onclick="location.href='../home'">INICIO</button>
        </div>
        <form id='formBuscar' class="busqueda" method='post' action="../search/">
            <div id="divFieldset">
                <fieldset id="fieldsetBuscar">
                    <legend>Buscar</legend>
                    <input type="text" class="input buscar" id="buscar" name="buscar" placeholder="Búsqueda">
                </fieldset>
                <div class="error" id="errorBuscarVacio">
                    Este campo es obligatorio.
                </div>
            </div>
            <button type="button" class='btn btnBuscar' id='btnBuscar'>
                ➤
            </button>
        </form>
        <div class="perfil">
            <img class="pfp" id="fotoPerfil">
            <div id="alias">
                <?php echo $_SESSION['user']['alias']; ?>
                <div class="rep"><?php
                    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
                    $res = $con->query("SELECT (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$_SESSION['user']['alias']."') AND positivo=1) - (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$_SESSION['user']['alias']."') AND positivo=0) as rep");
                    $rep = mysqli_fetch_assoc($res);
                    echo $rep['rep'];
                ?> rep</div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="left">
            <div id="foto">
            <img class="pfpUSer" id="pfpUSer" alt="Foto de perfil del usuario">
            </div>
            <div id="descripcion">
                <?php echo $usuario['descripcion']; ?>
            </div>
        </div>
        <div class="right">
            <div id="alias">
                <?php echo $usuario['alias']; ?>
            </div>
            <div id="nombre">
                <?php echo $usuario['nombre']; ?>
            </div>
            <div id="apellidos">
                <?php echo $usuario['apellidos']; ?>
            </div>
        </div>
    </div>
</body>
</html>