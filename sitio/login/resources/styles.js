$(document).ready(function() {
    //esto es simplemente para que el área de clic de los inputs sea más grande
    $("#fieldsetUser").click(function (){
        $("#user").focus();
    });
    $("#fieldsetPwd").click(function (){
        $("#pwd").focus();
    });

    //el input del usuario se seleccionará automáticamente
    $("#user").focus();

    //en caso de que hubieran saltado errores, al escribir algo se ocultarán
    $("#user").on('input', function() {
        $("#fieldsetUser, #fieldsetUser legend").css({"border-color" : "", "color" : ""});
        $("#errorUsuarioNoExiste, #errorUsuarioVacio").css({"display" : "none"});
    });
    $("#pwd").on('input', function() {
        $("#fieldsetPwd, #fieldsetPwd legend").css({"border-color" : "", "color" : ""});
        $("#errorPwdIncorrecta, #errorPwdVacio, #errorPwdIlegal").css({"display" : "none"});
    });
});

//animación en caso de que el input del usuario sea válido
function displayPwdInput(){
    setTimeout(function () {
        $("#pwd").focus();
    }, 500);
    $("#formInicio .divUsuario").addClass("slide-left-usuario").removeClass("slide-right-usuario");
    $("#formInicio .divPwd").addClass("slide-left-pwd").removeClass("slide-right-pwd");
}

//animación en caso de que se tenga que volver al input del usuario estando en el del password
function displayUserInput(){
    setTimeout(function () {
        $("#user").focus();
    }, 500);
    $("#formInicio .divUsuario").addClass("slide-right-usuario").removeClass("slide-left-usuario");
    $("#formInicio .divPwd").addClass("slide-right-pwd").removeClass("slide-left-pwd");
}
