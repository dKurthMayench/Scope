<!DOCTYPE html><html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <script charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key=115ddd89a06be5ab651b3c"></script>

    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <link rel="stylesheet" href="resources/styles.css">

    <?php
        session_start();
        require_once("../../conexion/utils.php");
        if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
        $resArt = $con->query("SELECT * FROM articulos WHERE id = ".$_GET['id']);
        $articulo = mysqli_fetch_assoc($resArt);

        $resCat = $con->query("SELECT * FROM categorias WHERE id = ".$articulo['categoria']);
        $categoria = mysqli_fetch_assoc($resCat);

        $resVoto = $con->query("SELECT * FROM votosxarticulos WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_GET['id']);
        if ($resVoto->num_rows == 1) $voto = mysqli_fetch_assoc($resVoto);

        //recupero todos los votos
        $resRep = $con->query("SELECT * FROM votosxarticulos WHERE art=".$_GET['id']);
        //si hay votos, calculo los puntos 
        $positivos = 0;
        if ($resRep->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($resRep)) $rep[] = $row;
            for ($i = 0; $i < count($rep); $i++){
                if ($rep[$i]['positivo'] == 1) $positivos++;
                else $positivos--;
            }
        }

        //id en vez de fecha de publicacion ya que si hay 2 fechas iguales, hace lo que le da la gana
        //como el id es autoincremental, estarán en orden
        $resCom = $con->query("SELECT * FROM comentarios WHERE articulo = ".$_GET['id']." ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($resCom)) $comentarios[] = $row;
    ?>
    <title><?php echo $articulo['titulo']; ?></title>
</head>
<body>
    <input id='idArticulo' type="hidden" value="<?php echo $articulo['id']; ?>">
    <div id="header">
        <div class="inicio">
            <button class="btn btnInicio" onclick="location.href='../home'">INICIO</button>
        </div>
        <form id='formBuscar' class="busqueda" method='post' action="../busqueda/">
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
    <div id="articulo" 
    <?php
        if (isset($voto)){
            if ($voto['positivo'] == 1) echo "class='liked'";
            else echo "class='disliked'";
        }
    ?>>
        <div class="cabecera">
            <div class="izqd">
                <div class="op">
                    <?php echo "<a href='../user/index.php?alias=".$articulo['op']."'>".$articulo['op']."</a> ha publicado en <a href='../cat/index.php?id=".$categoria['id']."'>".$categoria['nombre']."</a> el ".$articulo['fecha_publicacion']; ?>
                </div>
                <div class="titulo">
                    <h1><?php echo $articulo['titulo']; ?></h1>
                </div>
            </div>
            <div class="drch">
                <?php
                    if($_SESSION['user']['alias'] == "admin" || $_SESSION['user']['alias'] == $articulo['op']) echo "<button class='btn' id='eliminar'>Eliminar</button>";
                ?>
                <button id="guardar" class="btn 
                <?php 
                    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
                    $res = $con->query("SELECT * FROM publicacionesguardadas WHERE alias='".$_SESSION['user']['alias']."' AND art='".$articulo['id']."'");
                    if ($res->num_rows == 0) echo "guardar\">Guardar</button>";
                    else echo "guardada\">Guardado</button>";
                ?>
                <div class="like likeA">▲</div>
                <!--Esto lo marca como un error porque no cierro la comilla en el html sino en el trozo de php
                y no lo pilla el VSCode.
                -->
                <div class="nVotos"><?php echo $positivos; ?></div>
                <div class="dislike dislikeA">▼</div>
            </div>
        </div>
        <hr/>
        <div class="content">
            <?php 
                //busca patrones de texto, y los transforma en enlaces
                //(hola){https://google.es} -> <a href='https://google.es'>hola</a>;
                $contenido = base64_decode($articulo['contenido']);
                preg_match_all("/\(.+?\)\{(?:http(?:s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+\}/m", $contenido, $matches);
                for($i = 0; $i < count($matches[0]); $i++){
                    
                    //palabra en la cual esconder el enlace
                    $nombreUrlAux = substr($matches[0][$i],strrpos($matches[0][$i], "(")+1);
                    $nombreUrl = substr($nombreUrlAux, 0,strrpos($nombreUrlAux, ")"));
                    
                    //enlace
                    $linkUrlAux = substr($matches[0][$i],strrpos($matches[0][$i], "{")+1);
                    $linkUrl = substr($linkUrlAux, 0,strrpos($linkUrlAux, "}"));
                    
                    $prepared = "<a href='".$linkUrl."'>".$nombreUrl."</a>";
                    
                    $contenido = str_replace("(".$nombreUrl."){".$linkUrl."}", $prepared, $contenido);
                }
                echo $contenido;
            ?>
        </div>
    </div>
    <div class="comentarios">
        <h3>Añadir comentario</h3>
        <hr/>
        <div class="comment">
            <fieldset id="fieldsetComment">
                <legend>Comentar</legend>
                <textarea class="input comentar" id="comentar" name="comentar" rows="4" placeholder="Comentario"></textarea>
            </fieldset>
            <div class="error" id="errorComentarioLargo">
                Máximo 100 caracteres
            </div>
            <button class='btn btnComentar' id='btnComentar' style="display:none">
                Publicar comentario
            </button>
        </div>
        <h3>Comentarios</h3>
        <hr/>
        <?php
            if($resCom->num_rows < 1) echo "No hay comentarios";
            else{
                for($i = 0; $i < count($comentarios); $i++){
                    $consultaVotos = $con->query("SELECT (SELECT COUNT(*) FROM votosxcomentarios WHERE positivo=1 AND comentario=".$comentarios[$i]['id'].") - (SELECT COUNT(*) FROM votosxcomentarios WHERE positivo=0 AND comentario=".$comentarios[$i]['id'].") AS votos;");
                    $votosComentario = mysqli_fetch_assoc($consultaVotos);
                    echo "
                    <div class='comentario";
                    $votado = $con->query("SELECT * FROM votosxcomentarios WHERE comentario=".$comentarios[$i]['id']." AND alias='".$_SESSION['user']['alias']."'");
                    if ($votado->num_rows > 0) $votoCom = mysqli_fetch_assoc($votado);
                    if (isset($votoCom)){
                        if ($votoCom['positivo'] == 1){
                            echo " liked";
                            unset($votoCom);
                        }
                        else {
                            echo " disliked";
                            unset($votoCom);
                        }
                    }
                    echo "' id='comentario_".$comentarios[$i]['id']."'>
                        <div>
                            <img class='imagen' src='../../resources/img/pfp/";
                            $user = $comentarios[$i]['comentador'];
                            if(file_exists("../../resources/img/pfp/".$user.".jpg")) echo $user.".jpg'/>";
                            else if(file_exists("../../resources/img/pfp/".$user.".jpeg")) echo $user.".jpeg'/>";
                            else if(file_exists("../../resources/img/pfp/".$user.".png")) echo $user.".png'/>";
                            else if(file_exists("../../resources/img/pfp/".$user.".gif")) echo $user.".gif'/>";
                            else echo "(default).jpg'/>";
                            echo "
                            <div class='cuerpo'>
                                <div class='comentador'>".$comentarios[$i]['comentador']."</div>
                                <div class='contenido'>".base64_decode($comentarios[$i]['contenido'])."</div>
                            </div>
                        </div>
                        <div class='votos'>
                            <div class='like likeC'>▲</div>
                            <div class='nVotos'>".$votosComentario['votos']."</div>
                            <div class='dislike dislikeC'>▼</div>
                        </div>";
                        //el comentador podrá editar el comentario
                        if($comentarios[$i]['comentador'] == $_SESSION['user']['alias']){
                            echo "<button type='button' class='editarComentario'>Editar</button>
                            <button type='button' class='guardar' style='display: none'>Guardar</button>
                            <button type='button' class='descartar' style='display: none'>Cancelar</button>";
                        }
                        //el administrador y el comentador podran eliminar el comentario
                        if($comentarios[$i]['comentador'] == $_SESSION['user']['alias'] || $_SESSION['user']['alias'] == 'admin') echo "<button type='button' class='borrarComentario'>Borrar</button>";
                    echo "</div>";
                }
            }
        ?>
    </div>
    <script>
        document.querySelectorAll( 'oembed[url]' ).forEach( element => {
            iframely.load( element, element.attributes.url.value );
            iframely.on('error', function (element, url){
                alert("error");
            });
        } );
        document.querySelectorAll( 'div[data-oembed-url]' ).forEach( element => {
            // Vaciar el <div data-oembed-url="...">).
            while ( element.firstChild ) {
                element.removeChild( element.firstChild );
            }

            // Generar la vista previa con iframely.
            iframely.load( element, element.dataset.oembedUrl ) ;
        } );
    </script>
</body>
</html>