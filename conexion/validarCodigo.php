<?php
    session_start();
    require_once("./utils.php");
    if (!isset($_SESSION['codigo'])) echo "not set";
    else {
        if ($_SESSION['codigo'] != $_GET['codigo']) echo "not match";
        else {
            //compruebo si el codigo ha expirado o no
            $session_life = time() - $_SESSION['timeout'];
            if($session_life > (60*5)) {
                session_destroy();
                echo "expired";
            }
            }else{
                activate($_GET['email']);
                echo 0;
            }
        }
    }
?>