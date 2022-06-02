<?php
    require_once("../../conexion/utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    if($_POST['type'] == "categorias" || $_POST['type'] == "usuarios") $res = $con->query("SELECT * FROM ".$_POST['type']." ORDER BY fecha_creacion");
    else  $res = $con->query("SELECT * FROM ".$_POST['type']." ORDER BY fecha_publicacion");
    while ($row = mysqli_fetch_assoc($res)) $elem[] = $row;
    if($res->num_rows == 0) echo "vacio";
    else {
        if($_POST['type'] == "articulos"){
            for ($i = 0; $i < count($elem); $i++){
                //recupero el numero de comentarios
                $res = $con->query("SELECT * FROM comentarios WHERE articulo = ".$elem[$i]['id']);
                $comentarios = $res->num_rows;

                $elem[$i]['nComentarios'] = $comentarios;
                
                //recupero la informacion de la categoria
                $res = $con->query("SELECT * FROM categorias WHERE id = ".$elem[$i]['categoria']);
                $cat = mysqli_fetch_assoc($res);
                $elem[$i]['nombreCat'] = $cat['nombre'];
                $elem[$i]['idCat'] = $cat['id'];
                
                //recupero todos los votos y calculo la diferencia de los positivos y negativos
                $res = $con->query("SELECT (SELECT COUNT(*) FROM votosxarticulos WHERE positivo=1 AND art=".$elem[$i]['id'].") - (SELECT COUNT(*) FROM votosxarticulos WHERE positivo=0 AND art=".$elem[$i]['id'].") AS votos");
                $votos = mysqli_fetch_assoc($res);
                $elem[$i]['votos'] = $votos['votos'];
            }
        }
        else if($_POST['type'] == "categorias"){
            for ($i = 0; $i < count($elem); $i++){
                //recupero el numero de seguidores
                $res = $con->query("SELECT * FROM usuariosxcategorias WHERE idCat = ".$elem[$i]['id']);
                $seguidores = $res->num_rows;

                $elem[$i]['seguidores'] = $seguidores;
            }
        }
        else if($_POST['type'] == "comentarios"){
            for($i = 0; $i < count($elem); $i++){
                $consultaVotos = $con->query("SELECT (SELECT COUNT(*) FROM votosxcomentarios WHERE positivo=1 AND comentario=".$elem[$i]['id'].") - (SELECT COUNT(*) FROM votosxcomentarios WHERE positivo=0 AND comentario=".$elem[$i]['id'].") AS votos;");
                $votosComentario = mysqli_fetch_assoc($consultaVotos);
                if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".jpg")) $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".jpg";
                else if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".jpeg")) $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".jpeg";
                else if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".png")) $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".png";
                else if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".gif"))  $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".gif";
                else $elem[$i]['foto'] = "../../resources/img/pfp/(default).jpg";
            }
        }
        else if($_POST['type'] == "comentarios"){
            for($i = 0; $i < count($elem); $i++){
                $consultaVotos = $con->query("SELECT (SELECT COUNT(*) FROM votosxcomentarios WHERE positivo=1 AND comentario=".$elem[$i]['id'].") - (SELECT COUNT(*) FROM votosxcomentarios WHERE positivo=0 AND comentario=".$elem[$i]['id'].") AS votos;");
                $votosComentario = mysqli_fetch_assoc($consultaVotos);
                if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".jpg")) $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".jpg";
                else if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".jpeg")) $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".jpeg";
                else if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".png")) $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".png";
                else if(file_exists("../../resources/img/pfp/".$elem[$i]['comentador'].".gif"))  $elem[$i]['foto'] = "../../resources/img/pfp/".$elem[$i]['comentador'].".gif";
                else $elem[$i]['foto'] = "../../resources/img/pfp/(default).jpg";
            }
        }
        echo json_encode($elem);
    }