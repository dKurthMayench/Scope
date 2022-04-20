$(document).ready(function() {

    //control del formulario con el teclado pq se hace muy pesado tener que estar dandole con el raton para hacer pruebas.
    /**
     * con enter vas desde el input usuario al input password.
     * tambien vas desde el input password a validarPwd();.
     * si estas con el focus en el input password, con el esc vuelves al input usuario.
     */
    $(document).on('keyup',function(k) {
        if(k.which == 13) {
            if ($("#pwd").is(":focus")) validarPwd();
            else if($("#user").is(":focus")) validarUsuario();
        }
        else if(k.which == 27) {
            if ($("#pwd").is(":focus")) displayUserInput();
        }
    });
    
});

function validarUsuario(){
    //usuario vacío = error
    if ($("#user").val() == "") {
        $('#errorUsuarioVacio').css("display", "block");
        $('#fieldsetUser').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetUser legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else{
        var user = $("#user").val();
        //si al crear la cuenta han conseguido poner simbolos raros en el usuario, 
        //con encodeURIComponent evitare problemas con la url
        user = encodeURIComponent(user);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                
                //usuario existe = muestra input password
                if(this.responseText == "0") displayPwdInput();

                //usuario no existe en la bbdd = error
                else {
                    $('#errorUsuarioNoExiste').css({"display" : "block"});
                    $('#fieldsetUser').css({"border-color" : "rgb(247, 94, 94)"});
                    $('#fieldsetUser legend').css({"color" : "rgb(247, 94, 94)"});
                }
            }
        };
        xhttp.open("GET","../../conexion/existeUsuario.php?user="+user, true);
        xhttp.send();
    }
}

function validarPwd(){
    //pwd vacio = error
    if ($("#pwd").val() == "") {
        $('#errorPwdVacio').css({"display" : "block"});
        $('#fieldsetPwd').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetPwd legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else{
        var pwd = $("#pwd").val();
        //al admitir simbolos en la contraseña, 
        //tengo que utilizar el encodeURIComponent para evitar problemas con la url
        pwd = encodeURIComponent(pwd);
        var user = $("#user").val();
        user = encodeURIComponent(user);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                
                //contraseña correcta = iniciar sesión
                if(this.responseText == "0") submit();
                
                //contraseña incorrecta = error
                else {
                    $('#errorPwdIncorrecta').css({"display" : "block"});
                    $('#fieldsetPwd').css({"border-color" : "rgb(247, 94, 94)"});
                    $('#fieldsetPwd legend').css({"color" : "rgb(247, 94, 94)"});
                }
            }
        };
        var url = "../../conexion/validarPwd.php?pwd="+pwd+"&user="+user;
        xhttp.open("GET",url, false);
        xhttp.send();
    }
}

function submit(){
    $("#formInicio").submit();
}