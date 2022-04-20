$(document).ready(function (e) {
    $(".nav .cambiarPfp").addClass("selected");
    $(".nav").children().click(function () { 
        $(".nav").children().removeClass("selected");
        $(this).addClass("selected");
        $("#informacion").children().css("display", "none");
    });
    $(".cambiarPfp").click(function () {
        cambiarPfp()
    });
    $(".cambiarUsuario").click(function () {
        cambiarUsuario()
    });
    $(".cambiarPwd").click(function () {
        cambiarPwd()
    });
    $("#nombre").on('input', function() {
        $("#fieldsetNombre, #fieldsetNombre legend").css({"border-color" : "", "color" : ""});
        $("#errorNombreFalso, #errorNombreLargo").css({"display" : "none"});
        alertCambiosDatos();
    });
    $("#apellidos").on('input', function() {
        $("#fieldsetApellidos, #fieldsetApellidos legend").css({"border-color" : "", "color" : ""});
        $("#errorApellidosFalso, #errorApellidosLargo").css({"display" : "none"});
        alertCambiosDatos();
    });
    $("#desc").on('input', function() {
        $("#fieldsetDesc, #fieldsetDesc legend").css({"border-color" : "", "color" : ""});
        $("#descripcionLarga").css({"display" : "none"});
        alertCambiosDatos();
    });
    $("#oldPwd").on('input', function() {
        $("#fieldsetOldPwd, #fieldsetOldPwd legend").css({"border-color" : "", "color" : ""});
        $("#errorOldPwdIncorrecto, #errorOldPwdVacio").css({"display" : "none"});
        alertCambiosPwd();
    });
    $("#pwd").on('input', function() {
        $("#fieldsetPwdConfirm, #fieldsetPwdConfirm legend, #fieldsetPwd, #fieldsetPwd legend").css({"border-color" : "", "color" : ""});
        $("#errorPwdConfirmDiferentes, #errorPwdConfirmVacio, #errorPwdVacio, #errorPwdSeguro").css({"display" : "none"});
        alertCambiosPwd();
    });
    $("#pwdConfirm").on('input', function() {
        $("#fieldsetPwdConfirm, #fieldsetPwdConfirm legend").css({"border-color" : "", "color" : ""});
        $("#errorPwdConfirmDiferentes, #errorPwdConfirmVacio").css({"display" : "none"});
        alertCambiosPwd();
    });
});
 