$(document).ready(function() {
    //recupero el nombre de usuario
    var usuario = $("#aliasUsuario").val();
    //mostrar la foto de perfil del usuario ajeno
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //compruebo si existe una foto de perfil, y su extensión
            $("#pfpUSer").attr("src", this.responseText);
        }
    };
    xhttp.open("GET", "../../conexion/existeImagen.php?alias="+usuario, true);
    xhttp.send();
});