<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--jquery-->
    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <link rel="stylesheet" href="resources/styles.css">
</head>
<body>
    <?php
        session_start();
        require_once("../../conexion/utils.php");
        $busqueda = $_POST['buscar'];
        if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    ?>
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
    <h1>Resultados de la búsqueda...</h1>
    <hr/>
    <div class="resultado">
        <div class="categorias">
            <h1>Categorías</h1>
            <hr/>
            <?php
                $res = $con->query("SELECT * FROM categorias WHERE nombre LIKE '%".$busqueda."%'");
                if($res->num_rows < 1) echo "No se han encontrado categorías...";
                else{
                    while ($row = mysqli_fetch_assoc($res)) $categorias[] = $row;
                    for ($i = 0; $i < count($categorias); $i++){
                        $res = $con->query("SELECT * FROM usuariosxcategorias WHERE idCat = ".$categorias[$i]['id']);
                        $categorias[$i]['nSeguidores'] = $res->num_rows;
                        echo "<div class='categoria' id='".$categorias[$i]['id']."'>
                            <div class='nombre'>".$categorias[$i]['nombre']."</div>
                            <div class='nSeguidores'>Miembros: ".$categorias[$i]['nSeguidores']."</div>
                            <div class='descripcion'>"; if ($categorias[$i]['descripcion'] == "") echo "(Sin descripción)"; else echo base64_decode($categorias[$i]['descripcion']); echo "</div>
                        </div>";
                    }
                }
            ?>
        </div>
        <div class="articulos">
            <h1>Publicaciones</h1>
            <hr/>
            <?php
                $res = $con->query("SELECT * FROM articulos WHERE titulo LIKE '%".$busqueda."%'");
                if($res->num_rows < 1) echo "No se han encontrado publicaciones...";
                else{
                    while ($row = mysqli_fetch_assoc($res)) $publicaciones[] = $row;
                    for ($i = 0; $i < count($publicaciones); $i++){
                        $res = $con->query("SELECT * FROM comentarios WHERE articulo = ".$publicaciones[$i]['id']);
                        $comentarios = $res->num_rows;
                
                        $publicaciones[$i]['nComentarios'] = $comentarios;
                        
                        $res = $con->query("SELECT nombre FROM categorias WHERE id = ".$publicaciones[$i]['categoria']);
                        $nombreCat = mysqli_fetch_assoc($res);
                        $publicaciones[$i]['nombreCat'] = $nombreCat['nombre'];
                        
                        //recupero todos los votos y calculo la diferencia de los positivos y negativos
                        $res = $con->query("SELECT (SELECT COUNT(*) FROM votosxarticulos WHERE positivo=1 AND art=".$publicaciones[$i]['id'].") - (SELECT COUNT(*) FROM votosxarticulos WHERE positivo=0 AND art=".$publicaciones[$i]['id'].") AS votos");
                        $votos = mysqli_fetch_assoc($res);
                        $publicaciones[$i]['votos'] = $votos['votos'];

                        echo "<div class='articulo' id='".$publicaciones[$i]['id']."'>
                            <div class='nombreCat'>".$publicaciones[$i]['op']." ha publicado en ".$publicaciones[$i]['nombreCat']." el ".$publicaciones[$i]['fecha_publicacion']."</div>
                            <div>".
                                $publicaciones[$i]['titulo']
                                ."
                                <div class='artAside'>
                                    <div class='comentarios'>
                                        <div>Comentarios</div>
                                        <div>".$publicaciones[$i]['nComentarios']."</div>
                                    </div>
                                    <div class='votos'>
                                        <div>Votos</div>
                                        <div>".$publicaciones[$i]['votos']."</div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                }
            ?>
        </div>
    </div>  
</body>
</html>