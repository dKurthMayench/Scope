<!DOCTYPE html><html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="resources/styles.css">
    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <title>Document</title>
</head>
<body>

    <?php
        session_start();
        require_once("../../conexion/utils.php");
        if(!isset($_SESSION['codigo'])){

            $codigo = random_int(100000, 999999);
            
            //este echo es porque el mail() ha dejado de funcionar para aplicaciones "no seguras". Así puedo ver el código sin ir al correo y verificar si funciona todo.
            echo $codigo;
            //\\

            //meto el codigo en una variable de sesion y envio el mail con el codigo
            $_SESSION['codigo'] = $codigo;
            send_mail($_POST['email'], $codigo);
            
            //meto un time() en la variable de sesion
            $_SESSION['timeout'] = time();
        }
        echo "<input type='hidden' name='email' id='email' value='".$_POST['email']."'>";
        if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
        
        if(!isset($_SESSION['control']) || $_SESSION['control'] != 1){
            $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
            $con->query("INSERT INTO usuarios (alias, password, email) VALUES ('".$_POST['user']."','".$pwd."','".$_POST['email']."')");
            $_SESSION['control'] = 1;
        }
        echo '<div class="item divUsuario">
            <div class="header">
                Se ha enviado el codigo de verifiación a '.$_POST['email'].'
            </div>
            <fieldset id="fieldsetUser" class="instruccion">
                <legend>Introduce el código</legend>
                <input type="text" class="input usuario" id="codigo" name="codigo" placeholder="Código de verificación">
            </fieldset>
            <div class="error" id="errorCodigoVacio">
                Este campo es obligatorio
            </div>
            <div class="error" id="errorCodigoInvalido">
                El código no es correcto o ha expirado. 
            </div>
            <button type="button" class="btn validarUsuario" onclick="validarCodigo()">Comprobar</button>
        </div>';
    ?>
</body>
</html>