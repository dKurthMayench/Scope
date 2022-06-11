<!DOCTYPE html><html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="resources/styles.css">
    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <title>Activación de cuenta</title>
</head>
<body>

    <?php
        session_start();
        require_once("../../conexion/utils.php");
        if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
        //muevo la info a variables de sesión
        if (!isset($_SESSION['pwd'])) $_SESSION['pwd'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        if (!isset($_SESSION['alias'])) $_SESSION['alias'] = $_POST['user'];
        if (!isset($_SESSION['email'])) $_SESSION['email'] = $_POST['email'];

        //aunque el usuario recargue la página, mysql no insertará otro registro ya que la clave primaria estaría duplicandose así que no hace falta que compruebe si ya existe o no
        $con->query("INSERT INTO usuarios (alias, password, email) VALUES ('".$_SESSION['alias']."','".$_SESSION['pwd']."','".$_SESSION['email']."')");
        if(isset($_SESSION['timeout'])){
            if($_SESSION['timeout'] < time()) unset($_SESSION['codigo']);
        }
        if(!isset($_SESSION['codigo'])){
            //meto el codigo en una variable de sesion y envio el mail con el codigo
            $_SESSION['codigo'] = random_int(100000, 999999);

            $subject = "Activa tu cuenta de Scope";
            $body = "Código de verificación: ".$_SESSION['codigo'].". Si no has solicitado este correo, puedes ignorarlo.";
            $headers = "From: Scope";
            mail($_SESSION['email'], $subject, $body, $headers);

            //meto en la variable de sesion el momento actual + 5 minutos (el código expirará en 5 minutos)
            $_SESSION['timeout'] = time()+(60*5);
        }
        //este echo es porque el mail() ha dejado de funcionar para aplicaciones "no seguras". Así puedo ver el código sin ir al correo y verificar si funciona todo.
        echo $_SESSION['codigo'];
        //\\
        echo "<input type='hidden' name='email' id='email' value='".$_SESSION['email']."'>";
        echo '<div class="item divCodigo">
            <div class="header">
                Se ha enviado el codigo de verifiación a '.$_SESSION['email'].'
            </div>
            <div class="b2">
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
            </div>
            <button type="button" class="btn validarUsuario" onclick="validarCodigo()">Comprobar</button>
        </div>';
    ?>
</body>
</html>