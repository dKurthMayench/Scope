<?php
    require_once("../../conexion/utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    $res = $con->query("SELECT * FROM ".$_POST['type']);
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
        echo json_encode($elem);
    }