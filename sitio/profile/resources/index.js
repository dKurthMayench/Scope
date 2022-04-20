var control = true;
$(document).ready(
    function () {
        $("#submitDatos .btnDescartarDatos, #submitPwd .btnDescartarPwd").click(function () {
            location.reload();
        });
        $("#submitDatos .btnGuardarDatos").click(function () {
            validarFormularioDatos();
        });
        $("#submitPwd .btnGuardarPwd").click(function () {
            validarFormularioPwd();
        });
        $("#cerrarSesion").click(function(){
            cerrarSesion();
        });
        cambiarPfp();
        
        
        $("#btnBuscar").click(function () {
            validarBusqueda();
        });
    }
);


function validarBusqueda(){
    if($("#buscar").val() == ""){
        $('#errorBuscarVacio').css({"display" : "block"});
        $('#fieldsetBuscar').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetBuscar legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else $("#formBuscar").submit();
}
function cambiarPfp(){
    $('#titulo').html("Cambiar foto de perfil");
    //añado los event listeners
    $('#pfp').click(function () { $('#imgUpload').trigger('click'); });
    //compruebo si el usuario tiene foto de perfil
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //recupero el nombre de usuario
            var usuario = $("#alias").contents().filter(function() {
                return this.nodeType == Node.TEXT_NODE;
            }).text();
            //elimino espacios que sobran en el string
            usuario = usuario.replace(/\s+/g, '');
            //compruebo si existe una foto de perfil, y su extensión
            if (this.responseText == "jpg")  $(".pfp").attr("src", "../../resources/img/pfp/"+usuario+".jpg");
            else if (this.responseText == "jpeg")  $(".pfp").attr("src", "../../resources/img/pfp/"+usuario+".jpeg");
            else if (this.responseText == "png")  $(".pfp").attr("src", "../../resources/img/pfp/"+usuario+".png");
            else if (this.responseText == "gif")  $(".pfp").attr("src", "../../resources/img/pfp/"+usuario+".gif");
            else  $(".pfp").attr("src", "../../resources/img/pfp/(default).jpg");
        }
    };
    xhttp.open("GET", "../../conexion/existeImagen.php", true);
    xhttp.send();
    
    //event listener del formulario
    $('#formImg').on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert(data);
                console.log(data);
                location.reload();
            },
            error: function (data) {
                console.log("error al procesar la imagen");
                console.log(data);
            }
        });
    }));
    //event listener del input
    $("#imgUpload").on("change", function () {
        $("#formImg").submit();
    });

    $("#formImg").css("display", "");
}

function cambiarUsuario(){
    $('#titulo').html("Cambiar datos");
    $("#formData").css("display", "block");
    //event listener del formulario
    $('#formData').on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log("error al procesar los datos");
                console.log(data);
            }
        });
    }));
}

function cambiarPwd(){
    $('#titulo').html("Cambiar contraseña");
    $("#formPwd").css("display", "block");
    //event listener del formulario
    $('#formPwd').on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log("error al procesar los datos");
                console.log(data);
            }
        });
    }));
}

function validarDescripcion(){
    if ($("#desc").val().length > 255) {
        $('#descripcionLarga').css("display", "block");
        $('#fieldsetDesc').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetDesc legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
}

function validarOldPwd() {
    if ($("#oldpwd").val() == "") {
        $('#errorOldPwdVacio').css({"display" : "block"});
        $('#fieldsetOldPwd').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetOldPwd legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else{
        var pwd = $("#oldPwd").val();
        var user = $("#user").val();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                if(this.responseText != "0") {
                    $('#errorOldPwdIncorrecto').css({"display" : "block"});
                    $('#fieldsetOldPwd').css({"border-color" : "rgb(247, 94, 94)"});
                    $('#fieldsetOldPwd legend').css({"color" : "rgb(247, 94, 94)"});
                    correcto(false);
                }
            }
        };
        xhttp.open("GET","../../conexion/validarPwd.php?pwd="+pwd+"&user="+user, false);
        xhttp.send();
    }
}

function validarPwd() {
    if ($("#pwd").val() == "") {
        $('#errorPwdVacio').css({ "display": "block" });
        $('#fieldsetPwd').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetPwd legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);

    }
    else if (!pwdSeguro($("#pwd").val())) {
        $('#errorPwdSeguro').css({ "display": "block" });
        $('#fieldsetPwd').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetPwd legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
    else {
        correcto(true);
    }
}

function validarPwdConfirm() {
    if ($("#pwd").val() == "") {
        $('#errorPwdConfirmVacio').css({ "display": "block" });
        $('#fieldsetPwdConfirm').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetPwdConfirm legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
    else if ($("#pwd").val() != $('#pwdConfirm').val()) {
        $('#errorPwdConfirmDiferentes').css({ "display": "block" });
        $('#fieldsetPwdConfirm').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetPwdConfirm legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
    else {
        correcto(true);
    }
}

function pwdSeguro(pwd) {
    if (pwd.length > 31 || pwd.length < 8) return false;
    var expr = /(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/;
    return expr.test(pwd);
}

function correcto(x){
    //si x = false, hay un error en el formulario
    if (!x) control = false;
}

function validarNombre(){
    if ($("#nombre").val().length > 100){
        $('#errorNombreLargo').css({ "display": "block" });
        $('#fieldsetNombre').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetNombre legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
    else if (!(/^[A-Z\s]*$/i.test($("#nombre").val()))){
        $('#errorNombreFalso').css({ "display": "block" });
        $('#fieldsetNombre').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetNombre legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
}

function validarApellidos(){
    if ($("#apellidos").val().length > 100){
        $('#errorApellidosLargo').css({ "display": "block" });
        $('#fieldsetApellidos').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetApellidos legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
    else if (!(/^[A-Z\s]*$/i.test($("#apellidos").val()))){
        $('#errorApellidosFalso').css({ "display": "block" });
        $('#fieldsetApellidos').css({ "border-color": "rgb(247, 94, 94)" });
        $('#fieldsetApellidos legend').css({ "color": "rgb(247, 94, 94)" });
        correcto(false);
    }
}

function validarFormularioDatos(){
    validarDescripcion();
    validarNombre();
    validarApellidos();
    //si control = false, el formulario tiene un error
    if (control){
        $("#formData").submit();
    }else{
        //reinicio la variable ya que sino se quedará en false aunque esté bien el formulario
        control = true;
    }
}

function validarFormularioPwd(){
    validarOldPwd();
    validarPwd();
    validarPwdConfirm();
    //si control = false, el formulario tiene un error
    if (control){
        $("#formPwd").submit();
    }else{
        //reinicio la variable ya que sino se quedará en false aunque esté bien el formulario
        control = true;
    }
}

function alertCambiosDatos(){
    $("#submitDatos").css("display", "block");
}

function alertCambiosPwd(){
    $("#submitPwd").css("display", "block");
}

function cerrarSesion(){
    location.replace("../login/");
}