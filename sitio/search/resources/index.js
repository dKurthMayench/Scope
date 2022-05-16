$(document).ready(function() {
    $("#fieldsetCat").click(function (){
        $("#cat").focus();
    });
    $("#fieldsetArt").click(function (){
        $("#art").focus();
    });
    $("#publicar").click(function (){
        location.href = "../post/";
    });
    $("#header .perfil").click(function (){
        location.href = "../profile/";
    });
    $("#btnBuscar").click(function () {
        validarBusqueda();
    });

    //oculto los errores de la barra de busqueda
    $("#buscar").on("input", function (){
        $('#errorBuscarVacio').css({"display" : ""});
        $('#fieldsetBuscar').css({"border-color" : ""});
        $('#fieldsetBuscar legend').css({"color" : ""});
    });

    $(".articulo").click(function (){
        location.href = "../art/index.php?id="+$(this).attr("id");
    });

    $(".categoria").click(function (){
        location.href = "../cat/index.php?id="+$(this).attr("id");
    });
});

function validarBusqueda(){
    if($("#buscar").val() == ""){
        $('#errorBuscarVacio').css({"display" : "block"});
        $('#fieldsetBuscar').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetBuscar legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else $("#formBuscar").submit();
}