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
    <title>Inicio</title>
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
        //si el usuario no ha activado su cuenta, será redirigido a la página de verificación de código
        if (isset($_SESSION['user'])){
            if ($_SESSION['user']['activo'] != 1) redirect("../register/finalizarRegistro.php");
        }
        if (isset($_SESSION['success'])){
            echo "<script>alert('Publicación creada correctamente')</script>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['successCat'])){
            echo "<script>alert('Categoría creada correctamente')</script>";
            unset($_SESSION['successCat']);
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
        <div class="general">
            General
        </div>
        <div class="guardados">
            Publicaciones guardadas
        </div>
        <div class="votados">
            Publicaciones votadas
        </div>
        <div class="publicados">
            Publicaciones propias
        </div>
        <div class="siguiendo">
            Siguiendo
        </div>
    </div>
    <div class="wrapper">
        <div id="content">
            <div class="crearArt">
                <div id="crearPublicacion" class="item itemPublicar">
                    <button id="publicar" type="button" class="btn publicar">Crear publicación</button>
                </div>
            </div>
            <div class="articulos">
            </div>
        </div>
        <hr/>
        <div id="aside">
            <form id="formCrearCat">
                <h1>Crear Categoría</h1>
                <hr/>
                <div class="nombreCategoria">
                    <fieldset id="fieldsetNombreCategoria" class="instruccion">
                        <legend>Nombre</legend>
                        <input type="text" class="input nombreCategoria" id="nombreCategoria" name="nombreCategoria" placeholder="Nombre de la categoria">
                    </fieldset>
                    <div class="error" id="errorNombreNoDisponible">
                        Esta categoría ya existe.
                    </div>
                    <div class="error" id="errorNombreVacio">
                        Este campo es obligatorio.
                    </div>
                    <div class="error" id="errorNombreIlegal">
                        No se admiten simbolos en el nombre de la categoría.
                    </div>
                </div>
                <div class="descCategoria">
                    <fieldset id="fieldsetDescCategoria" class="instruccion">
                        <legend>Descripción</legend>
                        <textarea class="input descCategoria" id="descCategoria" name="descCategoria" rows="4" placeholder="Descripción de la categoría (opcional)"></textarea>
                    </fieldset>
                    <div class="error" id="descripcionLarga">
                        Máximo 255 caracteres.
                    </div>
                </div>
                <button type="button" id="btnCrearCat" class="btn">Crear categoría</button>
            </form>
        </div>
    </div>
</body>
</html>