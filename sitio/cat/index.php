<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    session_start();
    require_once("../../conexion/utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    $res = $con->query("SELECT * FROM categorias WHERE id=".$_GET['id']);
    $categoria = mysqli_fetch_assoc($res);
    $res = $con->query("SELECT * FROM usuariosxcategorias WHERE idCat=".$_GET['id']);
    $categoria['nSeguidores'] = $res->num_rows;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $categoria['nombre']; ?></title>
    <!--jquery-->
    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <link rel="stylesheet" href="resources/styles.css">
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
    <div class="categoria">
        <input type="hidden" id='idCat' value="<?php echo $categoria['id']; ?>">
        <div class="banner">
            <div class="nombre"><h1>Bienvenido a <?php echo $categoria['nombre']; ?></h1></div>
            <button class="
            <?php
                $res = $con->query("SELECT * FROM usuariosxcategorias WHERE alias='".$_SESSION['user']['alias']."' AND idCat=".$categoria['id']);
                if ($res->num_rows > 0) echo "siguiendo";
                else echo "seguir";
            ?>
            " id='seguir'>
            <?php if ($res->num_rows > 0) echo "Siguiendo"; else echo "Seguir"; ?>
        </button>
            <?php
                if ($categoria['propietario'] == $_SESSION['user']['alias'] || $_SESSION['user']['alias'] == 'admin') echo "<button type='button' id='delCat'>Eliminar categoría</button>";
            ?>
        </div>
    </div>
    
    <div id="content">
        <div class="articulos">
            <h3>Publicaciones</h3>
            <hr/>
        </div>
    </div>
    <hr/>
    <div id="aside">
        <h3>Acerca de <?php echo $categoria['nombre'] ?></h3>
        <hr/>
        <div class="descripcion">
            <h5>Descripción</h5>
            <div class="textDesc"><?php echo base64_decode($categoria['descripcion']); ?></div>
        </div>
        <div class="nSeguidores">
            <h5>Miembros</h5>
            <div class="textSeg"><?php echo $categoria['nSeguidores']; ?></div>
        </div>
    </div>

</body>
</html>