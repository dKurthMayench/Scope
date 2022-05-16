$(document).ready(function() {
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
    
    //al escribir en el input de comentar, aparecera el boton de publicar comentario.
    $("#comentar").on("input", function () {
        $("#fieldsetComment, #fieldsetComment legend").css({"border-color" : "", "color" : ""});
        $("#errorComentarioLargo").css({"display" : "none"});
        if($("#comentar").val() == ""){
            $("#btnComentar").css("display", "none");
            $("#fieldsetComment").css("width", "100%");
        }
        else{
            $("#btnComentar").css("display", "block");
            $("#fieldsetComment").css("width", "80%");
        }
    });

    //control de votos de articulos y comentarios (quitar/añadir votos)
    $("#articulo .likeA").click(function (){
        if($("#articulo").hasClass("liked")) $("#articulo").removeClass("liked");
        else $("#articulo").addClass("liked").removeClass("disliked");
        votarArt("like", $("#idArticulo").val());
    });

    $("#articulo .dislikeA").click(function (){
        if($("#articulo").hasClass("disliked")) $("#articulo").removeClass("disliked");
        else $("#articulo").addClass("disliked").removeClass("liked");
        votarArt("dislike", $("#idArticulo").val());
    });

    $(".comentario .likeC").click(function (){
        if($(this).parent().parent().hasClass("liked")) $(this).parent().parent().removeClass("liked");
        else $(this).parent().parent().addClass("liked").removeClass("disliked");
        votarCom("like", $(this).parent().parent().attr("id"));
    });

    $(".comentario .dislikeC").click(function (){
        if($(this).parent().parent().hasClass("disliked")) $(this).parent().parent().removeClass("disliked");
        else $(this).parent().parent().addClass("disliked").removeClass("liked");
        votarCom("dislike", $(this).parent().parent().attr("id"));
    });

    
});