$(document).ready(function() {
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