<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de usuario</title>
    <!--jquery-->
    <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>
    <script src="resources/index.js"></script>
    <script src="resources/styles.js"></script>
    <link rel="stylesheet" href="resources/styles.css">
</head>
<body>
    <?php 
        require_once("../../conexion/utils.php");
        session_start();
    ?>
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
            <img class="pfp" id="fotoPerfil">
            <div id="alias">
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
    <div class="nav">
        <div class="cambiarPfp">
            Foto de perfil
        </div>
        <div class="cambiarUsuario">
            Información general
        </div>
        <div class="cambiarPwd">
            Cambiar contraseña
        </div>
    </div>
    <h1 id="titulo"></h1>
    <div id="informacion">
        <form action="../../conexion/uploadImg.php" enctype="multipart/form-data" method="post" id="formImg" style="display:none">
            <div id="foto">
                <input type="file" name="imgUpload" id="imgUpload" accept=".jpg,.jpeg,.png,.gif" style="display:none"/> 
                <img class="pfp" id="pfp" alt="Foto de perfil">
            </div>
        </form>

        <form action="../../conexion/editUsuarioData.php" method="post" id="formData" style="display:none">
            <div id="datos">
                <div class="fila">
                    <div class="datosAlias">
                        <fieldset id="fieldsetUser" class="instruccion disabled">
                            <legend>Usuario</legend>
                            <input type="text" class="input usuario" id="user" name="user" placeholder="Usuario" value="<?php echo $_SESSION["user"]["alias"]; ?>" disabled>
                        </fieldset>
                    </div>
                    <div class="datosRep">
                        <fieldset id="fieldsetRep" class="instruccion disabled">
                            <legend>Reputación</legend>
                            <input type="text" class="input repInput" id="rep" name="rep" placeholder="Reputación" value="<?php if(!isset($con)) $con = new mysqli("localhost", "root", "", "Scope");
                    $res = $con->query("SELECT (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$_SESSION['user']['alias']."') AND positivo=1) - (SELECT COUNT(*) FROM votosxarticulos WHERE art IN (SELECT id FROM articulos WHERE op='".$_SESSION['user']['alias']."') AND positivo=0) as rep");
                    $rep = mysqli_fetch_assoc($res);
                    echo $rep['rep']; ?>" disabled>
                        </fieldset>
                    </div>
                    <div class="datosEmail">
                        <fieldset id="fieldsetEmail" class="instruccion disabled">
                            <legend>Correo electrónico</legend>
                            <input type="text" class="input email" id="email" name="email" placeholder="Email" value="<?php echo $_SESSION["user"]["email"]; ?>" disabled>
                        </fieldset>
                    </div>
                </div>
                <div class="datosDescripcion">
                    <fieldset id="fieldsetDesc" class="instruccion">
                        <legend>Sobre tí</legend>
                        <textarea class="input desc" id="desc" name="desc" rows="4" placeholder="Sobre tí..."><?php echo $_SESSION["user"]["descripcion"]; ?></textarea>
                    </fieldset>
                    <div class="error" id="descripcionLarga">
                        Máximo 255 caracteres
                    </div>
                </div>
                <div class="fila">
                    <div class="datosNombre">
                        <fieldset id="fieldsetNombre" class="instruccion">
                            <legend>Nombre</legend>
                            <input type="text" class="input nombre" id="nombre" name="nombre" placeholder="Nombre" value="<?php if(isset($_SESSION['user']['nombre'])) echo $_SESSION["user"]["nombre"]; ?>">
                        </fieldset>
                        <div class="error" id="errorNombreFalso">Introduce un nombre real.</div>
                        <div class="error" id="errorNombreLargo">Máximo 100 caracteres.</div>
                    </div>
                    <div class="datosApellidos">
                        <fieldset id="fieldsetApellidos" class="instruccion">
                            <legend>Apellidos</legend>
                            <input type="text" class="input apellidos" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php if(isset($_SESSION['user']['apellidos'])) echo $_SESSION["user"]["apellidos"]; ?>">
                        </fieldset>
                        <div class="error" id="errorApellidosFalso">Introduce apellidos reales.</div>
                        <div class="error" id="errorApellidosLargo">Máximo 100 caracteres.</div>
                    </div>
                </div>
            </div>
            <div id="submitDatos" style="display: none">
                Tienes cambios sin guardar!
                <button type="button" class="btn btnDescartarDatos">Revertir</button>
                <button type="button" class="btn btnGuardarDatos">Guardar</button>
            </div>
        </form>

        <form action="../../conexion/editUsuarioPwd.php" method="post" id="formPwd" style="display:none">
            <div id="datos">
                
            <div class="item itemOldPwd">
                    <fieldset id="fieldsetOldPwd" class="instruccion">
                        <legend>Introduce tu contraseña actual</legend>
                        <input type="password" class="input oldPwd" id="oldPwd" name="oldPwd" placeholder="Contraseña actual">
                    </fieldset>
                    <div class="error" id="errorOldPwdVacio">
                        Este campo es obligatorio.
                    </div>
                    <div class="error" id="errorOldPwdIncorrecto">
                        La contraseña no es correcta.
                    </div>
                </div>

                <div class="item itemPwd">
                    <fieldset id="fieldsetPwd" class="instruccion">
                        <legend>Introduce tu contraseña nueva</legend>
                        <input type="password" class="input pwd" id="pwd" name="pwd" placeholder="Contraseña">
                    </fieldset>
                    <div class="error" id="errorPwdVacio">
                        Este campo es obligatorio.
                    </div>
                    <div class="error" id="errorPwdSeguro">
                        La contraseña debe tener al menos 8 caracteres, máximo 32, y al menos 1 minúscula, 1 mayúscula y 1 número.
                    </div>
                </div>
                <div class="item itemPwdConfirm">
                    <fieldset id="fieldsetPwdConfirm" class="instruccion">
                        <legend>Confirma la contraseña nueva</legend>
                        <input type="password" class="input pwdConfirm" id="pwdConfirm" name="pwdConfirm"
                            placeholder="Confirmar contraseña">
                    </fieldset>
                    <div class="error" id="errorPwdConfirmVacio">
                        Este campo es obligatorio.
                    </div>
                    <div class="error" id="errorPwdConfirmDiferentes">
                        Las contraseñas no coinciden
                    </div>
                </div>
            </div>
            <div id="submitPwd" style="display: none">
                Tienes cambios sin guardar!
                <button type="button" class="btn btnDescartarPwd">Revertir</button>
                <button type="button" class="btn btnGuardarPwd">Guardar</button>
            </div>
        </form>
    </div>
    <div class="cerrarSesion">
        <button id="cerrarSesion" class="btn btnCerrarSesion">
            Cerrar Sesión
        </button>
    </div>
</body>
</html>