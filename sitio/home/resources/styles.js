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
    $(".siguiendo").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesSiguiendo();
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