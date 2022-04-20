<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    //recupero una lista de 5 nombres que coincidan con lo introducido por el usuario.
    /**
     * las ordeno por longitud, así, si hay más de 5 categorías que coincidan con lo introducido, no habrá forma de que una categoría sea
     * imposible de ver
     * 
     * ejemplo:
     * 
     * hay 7 cateogrías:
     * 
     * 1-a
     * 2-ab
     * 3-abc
     * 4-abcd
     * 5-abcde
     * 6-abcdef
     * 7-abcdefg
     * 
     * si el usuario introduce "ab", la lista podría quedar así:
     * 
     * abc
     * abcd
     * abcde
     * abcdef
     * abcdefg
     * 
     * es decir, la categoría "ab" no aparecería en la lista. Al ordenarlas por longitud, aparecerán primero las más cortas, por lo que esto
     * no podrá ocurrir de ninguna manera.
     *  
     * esto es necesario ya que mysql ordena como le da la gana en caso de no especificar:
     * 
     * <<In the SQL world, order is not an inherent property of a set of data. 
     * Thus, you get no guarantees from your RDBMS that your data will come 
     * back in a certain order -- or even in a consistent order -- unless 
     * you query your data with an ORDER BY clause.>>
     * 
     */
    $res = $con->query("SELECT nombre FROM categorias WHERE nombre LIKE '%".$_POST['buscar']."%' ORDER BY LENGTH(nombre) ASC LIMIT 5");
    
    //si no existe ninguna categoría con el nombre introducido, devuelve 0. Si no, devuelve un json de la categoría.
    if (mysqli_num_rows($res) === 0) echo "0";
    else{
        while ($row = mysqli_fetch_assoc($res)) $categorias[] = $row;
        echo json_encode($categorias);
    }
?>
