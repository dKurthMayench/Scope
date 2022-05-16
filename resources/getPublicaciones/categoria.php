<?php
    session_start();
    require_once("../../conexion/utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");

    //recupero los articulos con la categoria especificada
    $res = $con->query("SELECT * FROM articulos WHERE categoria = ".$_POST['idCat']);
    if($res->num_rows < 1) echo "vacio";
    else{
        while ($row = mysqli_fetch_assoc($res)) $publicaciones[] = $row;
        
        for ($i = 0; $i < count($publicaciones); $i++){
            //recupero el numero de comentarios
            $res = $con->query("SELECT * FROM comentarios WHERE articulo = ".$publicaciones[$i]['id']);
            $comentarios = $res->num_rows;

            $publicaciones[$i]['nComentarios'] = $comentarios;
            
            //recupero la informacion de la categoria
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