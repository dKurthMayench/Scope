<?php
    session_start();
    require_once("../../conexion/utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    //compruebo si el usuario sigue alguna categoria
    $res = $con->query("SELECT * FROM usuariosxcategorias WHERE alias='".$_SESSION['user']['alias']."'");
    if($res->num_rows == 0) $siguiendo = false;
    else $siguiendo = true;

    //si el usuario sigue alguna categoría, recupero los articulos de esas categorias
    if($siguiendo) $res = $con->query("SELECT * FROM articulos WHERE categoria IN (SELECT id FROM categorias WHERE id IN (SELECT idCat FROM usuariosxcategorias WHERE alias='".$_SESSION['user']['alias']."')) ORDER BY fecha_publicacion");
    //sino, recupero los articulos de todas las categorias
    else $res = $con->query("SELECT * FROM articulos ORDER BY fecha_publicacion;");
   
    if($res->num_rows < 1) echo "vacio";
    else{
        while ($row = mysqli_fetch_assoc($res)) $publicaciones[] = $row;
    
        //recupero la ingormacion de cada publicacion para luego enviarla en formato json
        for ($i = 0; $i < count($publicaciones); $i++){
            
            $res = $con->query("SELECT * FROM comentarios WHERE articulo = ".$publicaciones[$i]['id']);
            $comentarios = $res->num_rows;
    
            $publicaciones[$i]['nComentarios'] = $comentarios;
            
            $res = $con->query("SELECT * FROM categorias WHERE id = ".$publicaciones[$i]['categoria']);
            $cat = mysqli_fetch_assoc($res);
            $publicaciones[$i]['nombreCat'] = $cat['nombre'];
            $publicaciones[$i]['idCat'] = $cat['id'];
            
            //recupero todos los votos y calculo la diferencia de los positivos y negativos
            $res = $con->query("SELECT (SELECT COUNT(*) FROM votosxarticulos WHERE positivo=1 AND art=".$publicaciones[$i]['id'].") - (SELECT COUNT(*) FROM votosxarticulos WHERE positivo=0 AND art=".$publicaciones[$i]['id'].") AS votos");
            $votos = mysqli_fetch_assoc($res);
            $publicaciones[$i]['votos'] = $votos['votos'];
        }
        echo json_encode($publicaciones);
    }
?>