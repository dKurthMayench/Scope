$(document).ready(function() {
    //estilos de la barra de navegación
    $(".general").addClass("selected");
    $(".general").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesGeneral();
    });
    $(".guardados").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesGuardadas();
    });
    $(".votados").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesVotadas();
    });
    $(".publicados").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesPropias();
    });

    //ajax para recuperar la foto de perfil
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //recupero el nombre de usuario
            var usuario = $(".alias").contents().filter(function() {
                return this.nodeType == Node.TEXT_NODE;
            }).text();
            //elimino espacios que sobran en el string
            usuario = usuario.replace(/\s+/g, '');
            //compruebo si existe una foto de perfil, y su extensión
            if (this.responseText == "jpg")  $("#fotoPerfil").attr("src", "../../resources/img/pfp/"+usuario+".jpg");
            else if (this.responseText == "jpeg")  $("#fotoPerfil").attr("src", "../../resources/img/pfp/"+usuario+".jpeg");
            else if (this.responseText == "png")  $("#fotoPerfil").attr("src", "../../resources/img/pfp/"+usuario+".png");
            else if (this.responseText == "gif")  $("#fotoPerfil").attr("src", "../../resources/img/pfp/"+usuario+".gif");
            else  $("#fotoPerfil").attr("src", "../../resources/img/pfp/(default).jpg");
        }
    };
    xhttp.open("GET", "../../conexion/existeImagen.php", true);
    xhttp.send();
});