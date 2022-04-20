<!DOCTYPE html>
<html lang="es">

<head>
    
<?php session_start(); ?>
    <meta charset="utf-8">
    <title>Publicar</title>

    <script src="resources/ckeditor/build/ckeditor.js"></script>
    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <script charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key=ec3b18b7d775ee7976245e17d8e1e46b"></script>

    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <link rel="stylesheet" href="resources/styles.css">
    <link rel="stylesheet" href="resources/editor.css">

    <style>
        .iframely-responsive {
            top: 0; left: 0; width: 100%; height: 0;
            position: relative; padding-bottom: 56.25%;
        }
        .iframely-responsive>* {
            top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;
        }
    </style>
</head>

<body>
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
            <img id="fotoPerfil">
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
    <h1 id="titulo">Crear publicación</h1>
    <form id='form' action="../inicio/" method="post">
        <div class="selectCategoria">
            <div id="iCategoria" class="item itemCategoria">
                <fieldset id="fieldsetCategoria" class="instruccion">
                    <legend>Selecciona una categoría</legend>
                    <input type="text" class="input categoria" id="categoria" name="categoria" autocomplete="off" placeholder="Categoria">
                    <div id="linea"></div>
                    <div id="resultados" style="display: none"></div>
                </fieldset>
                <div class="error" id="errorCategoriaVacia">
                    Este campo es obligatorio
                </div>
                <div class="error" id="errorCategoriaNoExiste">
                    Esta categoria no existe, <a href="../home/" style="color: #7289DA">¿Quieres crearla tú?</a>
                </div>
            </div>
        </div>
        <div class="titulo">
            <fieldset id="fieldsetTituloArt" class="instruccion">
                <legend>Título</legend>
                <input type="text" class="input tituloArt" id="tituloArt" name="tituloArt" autocomplete="off" placeholder="Título">
            </fieldset>
            <div class="error" id="errorTituloVacio">
                Este campo es obligatorio
            </div>
            <div class="error" id="errorTituloLargo">
                Máximo 150 caracteres
            </div>
        </div>
        <textarea name="content" id="editor" placeholder="Cuerpo del artículo (opcional)"></textarea>
        <button id="continuar" type="button" class="btn vistaPrevia">Publicar</button>
    </form>
</body>

</html>