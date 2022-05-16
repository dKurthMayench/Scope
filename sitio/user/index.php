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
            <div class="alias">
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
        </div>
        <div class="right">
            <div class="fila">
                <div id="alias">
                    <div class="subtitulo">Alias</div>
                    <div class="contenido"><?php echo $usuario['alias']; ?></div>
                </div>
                <div id="rep">
                    <div class="subtitulo">Reputación</div>
                    <div class="contenido"><?php 
                        $res = $con->query("SELECT (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$usuario['alias']."') AND positivo=1) - (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$_SESSION['user']['alias']."') AND positivo=0) as rep");
                        $rep = mysqli_fetch_assoc($res);
                        echo $rep['rep']; ?></div>
                </div>
            </div>
            <div class="fila">
                <div id="nombre">
                    <div class="subtitulo">Nombre</div>
                    <div class="contenido"><?php if(isset($usuario['nombre'])) echo $usuario['nombre']; else echo "Sin nombre" ?></div>
                </div>
                <div id="apellidos">
                    <div class="subtitulo">Apellidos</div>
                    <div class="contenido"><?php if(isset($usuario['apellidos'])) echo $usuario['apellidos']; else echo "Sin apellidos" ?></div>
                </div>
            </div>
            <div class="fila">
                <div id="descripcion">
                    <div class="subtitulo">Descripción</div>
                    <div class="contenido"><?php if(isset($usuario['descripcion'])) echo $usuario['descripcion']; else echo "Sin descripción" ?></div>
                </div>
            </div>
            <div class="fila">
                <div id="seguidores">
                    <div class="subtitulo">Seguidores</div>
                    <div class="contenido"><?php 
                        $res = $con->query("SELECT * FROM siguiendo WHERE siguiendo='".$usuario['alias']."'");
                        echo $res->num_rows;
                    ?></div>
                </div>
                <button id="follow" 
                    <?php
                        $res = $con->query("SELECT * FROM siguiendo WHERE seguidor='".$_SESSION['user']['alias']."' AND siguiendo='".$usuario['alias']."'");
                        if($res->num_rows == 0) echo " class='seguir btnSeguir'>Seguir";
                        else echo " class='siguiendo btnSeguir'>Dejar de seguir";
                    ?>
                </button>
                <!-- cierro la etiqueta en el php por eso lo muestra como un error pero esta bien en el html final -->
            </div>
        </div>
    </div>
</body>
</html>