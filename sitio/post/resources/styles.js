$(document).ready(function () {

    $("#tituloArt").on('input', function() {
        $("#fieldsetTituloArt, #fieldsetTituloArt legend").css({"border-color" : "", "color" : ""});
        $("#errorTituloVacio, #errorTituloLargo").css({"display" : "none"});
    });
    $("#categoria").on('input', function() {
        $("#fieldsetCategoria, #fieldsetCategoria legend").css({"border-color" : "", "color" : ""});
        $("#errorCategoriaVacia, #errorCategoriaNoExiste").css({"display" : "none"});
    });

    //ajax para recuperar la foto de perfil
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //elimino espacios que sobran en el string
            //compruebo si existe una foto de perfil, y su extensión
            if (this.responseText == "error")  $("#fotoPerfil").attr("src", "../../resources/img/pfp/(default).jpg");
            else $("#fotoPerfil").attr("src", this.responseText);
        }
    };
    xhttp.open("GET", "../../conexion/existeImagen.php", true);
    xhttp.send();
});
