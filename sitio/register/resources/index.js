var control = true;
$(document).ready(function () {
  $("#btnBuscar").click(function () {
    validarBusqueda();
  });
  $("#validar").click(function () {
    validarFormulario();
  });
});

function validarBusqueda() {
  if ($("#buscar").val() == "") {
    $("#errorBuscarVacio").css({ display: "block" });
    $("#fieldsetBuscar").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetBuscar legend").css({ color: "rgb(247, 94, 94)" });
  } else $("#formBuscar").submit();
}
function validarUsuario() {
  //usuario vacio = error
  if ($("#user").val() == "") {
    $("#errorUsuarioVacio").css("display", "block");
    $("#fieldsetUser").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetUser legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  }
  //si usuario > 16 caracteres = error
  else if ($("#user").val().length > 16) {
    $("#errorUsuarioLargo").css("display", "block");
    $("#fieldsetUser").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetUser legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  }
  //si usuario contiene caracteres ilegales = error
  else if (simbolosIlegalesUsuario($("#user").val())) {
    $("#errorUsuarioSimbolos").css("display", "block");
    $("#fieldsetUser").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetUser legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  } else {
    var user = $("#user").val();
    //si al crear la cuenta han conseguido poner simbolos raros en el usuario,
    //con encodeURIComponent evitare problemas con la url
    user = encodeURIComponent(user);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //si el usuario existe = error
        if (this.responseText == 0) {
          $("#errorUsuarioExiste").css({ display: "block" });
          $("#fieldsetUser").css({ "border-color": "rgb(247, 94, 94)" });
          $("#fieldsetUser legend").css({ color: "rgb(247, 94, 94)" });
          correcto(false);
        }
      }
    };
    xhttp.open("GET", "../../conexion/existeUsuario.php?user=" + user, false);
    xhttp.send();
  }
}

function validarEmail() {
  //email vacio = error
  if ($("#email").val() == "") {
    $("#errorEmailVacio").css({ display: "block" });
    $("#fieldsetEmail").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetEmail legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  }
  //email falso = error
  else if (!emailReal($("#email").val())) {
    $("#errorEmailFalso").css({ display: "block" });
    $("#fieldsetEmail").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetEmail legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  } else {
    var email = $("#email").val();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //si email ya existe = error
        if (this.responseText != 1) {
          $("#errorEmailDuplicado").css({ display: "block" });
          $("#fieldsetEmail").css({ "border-color": "rgb(247, 94, 94)" });
          $("#fieldsetEmail legend").css({ color: "rgb(247, 94, 94)" });
          correcto(false);
        }
      }
    };
    xhttp.open("GET", "../../conexion/existeEmail.php?email=" + email, false);
    xhttp.send();
  }
}

function validarPwd() {
  //pwd vacio = error
  if ($("#pwd").val() == "") {
    $("#errorPwdVacio").css({ display: "block" });
    $("#fieldsetPwd").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetPwd legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  }
  //pwd no seguro = error
  else if (!pwdSeguro($("#pwd").val())) {
    $("#errorPwdSeguro").css({ display: "block" });
    $("#fieldsetPwd").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetPwd legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  }
}

function validarPwdConfirm() {
  //pwdConfirm vacio = error
  if ($("#pwdConfirm").val() == "") {
    $("#errorPwdConfirmVacio").css({ display: "block" });
    $("#fieldsetPwdConfirm").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetPwdConfirm legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  }
  //pwd diferente a pwdConfirm = error
  else if ($("#pwd").val() != $("#pwdConfirm").val()) {
    $("#errorPwdConfirmDiferentes").css({ display: "block" });
    $("#fieldsetPwdConfirm").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetPwdConfirm legend").css({ color: "rgb(247, 94, 94)" });
    correcto(false);
  }
}

function validarPolitica() {
  //si el usuario no ha aceptado la politica = error
  if (!$("#politica").is(":checked")) {
    correcto(false);
    $("#errorPolitica").css({ display: "block" });
    $("#labelAcuerdo").css({ color: "rgb(247, 94, 94)" });
  }
}

function simbolosIlegalesUsuario(usuario) {
  //usuario solo puede tener mayusculas, minusculas, números, "-", "_", o "."
  var expr = /[^A-Za-z0-9\-\._]/;
  return expr.test(usuario);
}

function pwdSeguro(pwd) {
  //pwd debe tener una longitud de > 7 y < de 32.
  //debe contener una mayuscula, una minúcula y un número.
  if (pwd.length > 31 || pwd.length < 8) return false;
  var expr = /(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/;
  return expr.test(pwd);
}

function emailReal(email) {
  //comprueba si es un email con un formato real
  var expr = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
  return expr.test(email);
}

function correcto(x) {
  //si x = false, hay un error en el formulario
  if (!x) control = false;
}

function validarFormulario() {
  validarUsuario();
  validarEmail();
  validarPwd();
  validarPwdConfirm();
  validarPolitica();
  //si control = false, el formulario tiene un error
  if (control) {
    $("#formRegistro").submit();
  } else {
    //reinicio la variable ya que sino se quedará en false aunque esté bien el formulario
    control = true;
  }
}

function validarCodigo(){
  if ($("#codigo").val() == ""){
    $("#errorCodigoVacio").css({ display: "block" });
    $("#fieldsetUser").css({ "border-color": "rgb(247, 94, 94)" });
    $("#fieldsetUser legend").css({ color: "rgb(247, 94, 94)" });
  }
  else{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText != 0) {
          $("#errorCodigoInvalido").css({ display: "block" });
          $("#fieldsetUser").css({ "border-color": "rgb(247, 94, 94)" });
          $("#fieldsetUser legend").css({ color: "rgb(247, 94, 94)" });
        }
        else{
          alert("Cuenta activada correctamente. Ya puedes iniciar sesión.");
          location.href = "../login/";
        }
      }
    };
    xhttp.open("GET", "../../conexion/validarCodigo.php?codigo="+$("#codigo").val()+"&email="+$("#email").val(), false);
    xhttp.send();
  }
}