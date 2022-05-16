$(document).ready(function() {
    //ajax para recuperar la foto de perfil
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "error")  $("#fotoPerfil").attr("src", "../../resources/img/pfp/(default).jpg");
            else $("#fotoPerfil").attr("src", this.responseText);
        }
    };
    xhttp.open("GET", "../../conexion/existeImagen.php", true);
    xhttp.send();
});