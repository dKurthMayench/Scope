$(document).ready(function() {
    $("#header .perfil").click(function (){
        location.href = "../perfil/";
    });

    $("#guardar").click(function () {
        guardar();
    });
    $("#eliminar").click(function () {
        eliminar();
    });
    $("#btnComentar").click(function (){
        if ($("#comentar").val().length > 100){
            $('#fieldsetComment').css({ "border-color": "rgb(247, 94, 94)" });
            $('#fieldsetComment legend').css({ "color": "rgb(247, 94, 94)" });
            $("#errorComentarioLargo").css("display", "block");
        }
        else{
            var articulo = $("#idArticulo").val();
            var comentario = encodeURIComponent($("#comentar").val());
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xhttp.open("GET", "../../conexion/addComentario.php?articulo="+articulo+"&comentario="+comentario, true);
            xhttp.send();
        }
    });

    $("#btnBuscar").click(function () {
        validarBusqueda();
    });
    $(".editarComentario").click(function (){
        var id = $(this).parent().attr("id");
        var textoOld = $(this).parent().find(".cuerpo .contenido").text();
        $("#"+id).find(".cuerpo .contenido").html("<input id='"+id+"_input' class='input' type='text' value='"+textoOld+"'>");
        $("#"+id).find(".editarComentario, .borrarComentario").css("display", "none");
        $("#"+id).find(".guardar, .descartar").css("display", "block");
        $("#"+id+" input").focus().select().css({"border" : "1px solid white", "border-radius" : "5px"});
        $("#"+id+" .guardar").click(function (){
            $(".editarComentario, .borrarComentario").css("display", "block");
            $("#"+id).find(".guardar, .descartar").css("display", "none");
            $.ajax({
                type: 'POST',
                url: "../../conexion/editComentario.php",
                async: false,
                data: {
                    idCom: $(this).parent().attr("id").slice($(this).parent().attr("id").indexOf("_")+1),
                    contenido: $("#"+id+"_input").val(),
                },
                success: function (data){
                    $("#"+id).find(".cuerpo .contenido").html($("#"+id+"_input").val());
                },
                error: function (data) {
                    console.log("error al procesar los datos");
                    console.log(data);
                }
            });
        });
        $("#"+id+" .descartar").click(function (){
            $("#"+id).find(".cuerpo .contenido").html(textoOld);
            $(".editarComentario, .borrarComentario").css("display", "block");
            $("#"+id).find(".guardar, .descartar").css("display", "none");
        });
    });
    $(".borrarComentario").click(function (){
        var id = $(this).parent().attr("id").slice($(this).parent().attr("id").indexOf("_")+1);
        $.ajax({
            type: 'POST',
            url: "../../conexion/deleteComentario.php",
            async: false,
            data: {
                idCom: id,
            },
            success: function (data){
                location.reload();
            },
            error: function (data) {
                console.log("error al procesar los datos");
                console.log(data);
            }
        });
    });
});

function votarArt(voto, idArt){
    $.ajax({
        type: 'POST',
        url: "../../conexion/votarArt.php",
        async: false,
        data: {
            voto,
            idArt,
        },
        success: function (data){
            location.reload();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}

function votarCom(voto, idCom){
    idCom = idCom.slice(idCom.indexOf("_")+1);
    $.ajax({
        type: 'POST',
        url: "../../conexion/votarCom.php",
        async: false,
        data: {
            voto,
            idCom,
        },
        success: function (data){
            location.reload();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}

function validarBusqueda(){
    if($("#buscar").val() == ""){
        $('#errorBuscarVacio').css({"display" : "block"});
        $('#fieldsetBuscar').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetBuscar legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else $("#formBuscar").submit();
}

function guardar(){
    var id = $("#idArticulo").val();
    $.ajax({
        type: 'POST',
        url: "../../conexion/guardar.php",
        data: {
            id,
        },
        success: function (data){
            location.reload();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}

function eliminar(){
    var id = $("#idArticulo").val();
    $.ajax({
        type: 'POST',
        url: "../../conexion/deleteArticulo.php",
        data: {
            idArt: id,
        },
        success: function (data){
            location.href="../home/";
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}