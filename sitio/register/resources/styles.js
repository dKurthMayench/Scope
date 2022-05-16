$(document).ready(function() {
    $("#fieldsetUser").click(function () {
        $("#user").focus();
    });
    $("#fieldsetEmail").click(function () {
        $("#email").focus();
    });
    $("#fieldsetPwd").click(function () {
        $("#pwd").focus();
    });
    $("#fieldsetPwdConfirm").click(function () {
        $("#pwdConfirm").focus();
    });

    //oculto los errores si el usuario teclea algo en un input
    $("#user").on('input', function() {
        $("#fieldsetUser, #fieldsetUser legend").css({"border-color" : "", "color" : ""});
        $("#errorUsuarioExiste, #errorUsuarioVacio, #errorUsuarioLargo, #errorUsuarioSimbolos").css({"display" : "none"});
    });
    $("#codigo").on('input', function() {
        $("#fieldsetUser, #fieldsetUser legend").css({"border-color" : "", "color" : ""});
        $("#errorCodigoVacio, #errorCodigoInvalido").css({"display" : "none"});
    });
    $("#email").on('input', function() {
        $("#fieldsetEmail, #fieldsetEmail legend").css({"border-color" : "", "color" : ""});
        $("#errorEmailDuplicado, #errorEmailVacio, #errorEmailFalso").css({"display" : "none"});
    });
    $("#pwd").on('input', function() {
        $("#fieldsetPwd, #fieldsetPwd legend").css({"border-color" : "", "color" : ""});
        $("#errorPwdSeguro, #errorPwdVacio, #errorPwdIlegal").css({"display" : "none"});
    });
    $("#pwdConfirm").on('input', function() {
        $("#fieldsetPwdConfirm, #fieldsetPwdConfirm legend").css({"border-color" : "", "color" : ""});
        $("#errorPwdConfirmDiferentes, #errorPwdConfirmVacio").css({"display" : "none"});
    });
    $("#politica").on('change', function (){
        $("#errorPolitica").css({"display" : "none"});
        $("#labelAcuerdo").css({"color" : ""});
    });
});