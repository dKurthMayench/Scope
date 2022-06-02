<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <!--jquery-->
    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <link rel="stylesheet" href="resources/styles.css">
</head>
<body>
    <?php 
        require_once("../../conexion/utils.php");
        session_start();
        //si no eres admin, te redirige al inicio
        if (isset($_SESSION['user'])){
            if ($_SESSION['user']['alias'] != "admin") redirect("../home");
        }
        else{
            redirect("../login");
        }
    ?>
    <div id="header">
        <div class="inicio">
            <button class="btn btnInicio" onclick="location.href='../home/'">INICIO</button>
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
            <img id="fotoPerfil">
            <div class="alias">
                <?php echo $_SESSION['user']['alias']; ?>
                <div class="rep"><?php
                    //calculo la reputación del usuario
                    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
                    $res = $con->query("SELECT (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$_SESSION['user']['alias']."') AND positivo=1) - (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$_SESSION['user']['alias']."') AND positivo=0) as rep");
                    $rep = mysqli_fetch_assoc($res);
                    echo $rep['rep'];
                ?> rep</div>
            </div>
        </div>
    </div>
    <div id="nav">
        <div class="categorias">
            Categorías
        </div>
        <div class="articulos">
            Publicaciones
        </div>
        <div class="comentarios">
            Comentarios
        </div>
        <div class="usuarios">
            Usuarios
        </div>
        <div class="volver">
            Volver
        </div>
    </div>
    <div class="list">
        
    </div>
</body>
</html>