$(document).ready(function() {
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