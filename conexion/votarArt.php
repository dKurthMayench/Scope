<?php
    session_start();
    require_once("./utils.php");
    if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
    
    //$res = información sobre si el usuario ha votado o no, y en caso afirmativo, si el voto es positivo o negativo
    $res = $con->query("SELECT * FROM votosxarticulos WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['idArt']);
    
    //en caso de haber dado like...
    if($_POST['voto'] == "like"){
    
        //...si ya habia votado antes...
        if ($res->num_rows == 1){
            $voto = mysqli_fetch_assoc($res);
    
            //..en caso de que el voto anterior fuese positivo también, se eliminará el registro de la tabla. (Se quita el like)
            if ($voto['positivo'] == 1) $con->query("DELETE FROM votosxarticulos WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['idArt']);
    
            //..en caso de que el voto anterior fuese negativo, se actualizará el registro.
            else $con->query("UPDATE votosxarticulos SET positivo=1 WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['idArt']);
        }
    
        //..si no habia votado antes, se insertará el registro
        else $con->query("INSERT INTO votosxarticulos VALUES ('".$_SESSION['user']['alias']."', ".$_POST['idArt'].", 1)");
    }
    
    //en caso de haber dado dislike...
    else if($_POST['voto'] == "dislike"){
    
        //...si ya habia votado antes...
        if ($res->num_rows == 1){
            $voto = mysqli_fetch_assoc($res);
    
            //..en caso de que el voto anterior fuese negativo también, se eliminará el registro de la tabla. (Se quita el dislike)
            if ($voto['positivo'] == 0) $con->query("DELETE FROM votosxarticulos WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['idArt']);
    
            //..en caso de que el voto anterior fuese positivo, se actualizará el registro.
            else $con->query("UPDATE votosxarticulos SET positivo=0 WHERE alias='".$_SESSION['user']['alias']."' AND art=".$_POST['idArt']);
        }
    
        //..si no habia votado antes, se insertará el registro
        else $con->query("INSERT INTO votosxarticulos VALUES ('".$_SESSION['user']['alias']."', ".$_POST['idArt'].", 0)");
    }
?>