$(document).ready(function() {
    //enlaces
    $("#publicar").click(function (){location.href = "../post/";});
    $("#header .perfil").click(function (){location.href = "../profile/";});

    $("#btnBuscar").click(function () {validarBusqueda();});
    $("#btnCrearCat").click(function (){validarFormCat();});
    
    //en caso de que hubiera errores, al escribir se ocultarán
    $("#buscar").on("input", function (){
        $('#errorBuscarVacio').css({"display" : ""});
        $('#fieldsetBuscar').css({"border-color" : ""});
        $('#fieldsetBuscar legend').css({"color" : ""});
    });
    $("#nombreCategoria").on("input", function (){
        $('#errorNombreNoDisponible, #errorNombreVacio, #errorNombreIlegal').css({"display" : ""});
        $('#fieldsetNombreCategoria').css({"border-color" : ""});
        $('#fieldsetNombreCategoria legend').css({"color" : ""});
    });
    $("#descCategoria").on("input", function (){
        $('#descripcionLarga').css({"display" : ""});
        $('#fieldsetDescCategoria').css({"border-color" : ""});
        $('#fieldsetDescCategoria legend').css({"color" : ""});
    });

    getPublicacionesGeneral();
});

function getPublicacionesGeneral(){
    $(".articulos").html("<h3>Publicaciones nuevas</h3><hr/>");
    $.ajax({
        type: 'POST',
        url: "../../resources/getPublicaciones/general.php",
        cache: false,
        contentType: false,
        success: function (data) {
            if (data != "vacio") generarPagina(JSON.parse(data));
            else vacio();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}

function getPublicacionesVotadas(){
    $(".articulos").html("<h3>Publicaciones votadas</h3><hr/>");
    $.ajax({
        type: 'POST',
        url: "../../resources/getPublicaciones/votadas.php",
        cache: false,
        contentType: false,
        success: function (data) {
            if (data != "vacio") generarPagina(JSON.parse(data));
            else vacio();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}

function getPublicacionesGuardadas(){
    $(".articulos").html("<h3>Publicaciones guardadas</h3><hr/>");
    $.ajax({
        type: 'POST',
        url: "../../resources/getPublicaciones/guardadas.php",
        cache: false,
        contentType: false,
        success: function (data) {
            if (data != "vacio") generarPagina(JSON.parse(data));
            else vacio();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}

function getPublicacionesPropias(){
    $(".articulos").html("<h3>Publicaciones propias</h3><hr/>");
    $.ajax({
        type: 'POST',
        url: "../../resources/getPublicaciones/propias.php",
        cache: false,
        contentType: false,
        success: function (data) {
            if (data != "vacio") generarPagina(JSON.parse(data));
            else vacio();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}
function getPublicacionesSiguiendo(){
    $(".articulos").html("<h3>Siguiendo</h3><hr/>");
    $.ajax({
        type: 'POST',
        url: "../../resources/getPublicaciones/siguiendo.php",
        cache: false,
        contentType: false,
        success: function (data) {
            if (data != "vacio") generarPagina(JSON.parse(data));
            else vacio();
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}

function generarPagina(publicaciones){
    for(let i = 0; i < publicaciones.length; i++){
        crearArticulo(publicaciones[i]);
    }
}

function crearArticulo(publicacion){
    var articulo = document.createElement("a");
    articulo.setAttribute("class", "articulo");

    var nombreCat = document.createElement("div");
    nombreCat.innerHTML = "<a href='../user/index.php?alias="+publicacion.op+"'>"+publicacion.op+"</a> ha publicado en <a href='../cat/index.php?id="+publicacion.idCat+"'>" + publicacion.nombreCat + "</a> el " + publicacion.fecha_publicacion;
    nombreCat.classList.add("nombreCat");
    articulo.appendChild(nombreCat);

    var titulo = document.createTextNode(publicacion.titulo);
    articulo.appendChild(titulo);

    var aside = document.createElement("div");
    aside.classList.add("artAside");

    var comentarios = document.createElement("div");
    comentarios.setAttribute("class", "comentarios");

    var divAux3 = document.createElement("div");
    var labelComentarios = document.createTextNode("Comentarios");
    divAux3.appendChild(labelComentarios);
    comentarios.appendChild(divAux3);

    var divAux4 = document.createElement("div");
    var labelComentarios = document.createTextNode(publicacion.nComentarios);
    divAux4.appendChild(labelComentarios);
    comentarios.appendChild(divAux4);


    var votos = document.createElement("div");
    votos.setAttribute("class", "votos");

    var divAux1 = document.createElement("div");
    var labelVotos = document.createTextNode("Votos");
    divAux1.appendChild(labelVotos);
    votos.appendChild(divAux1);

    var divAux2 = document.createElement("div");
    var nVotos = document.createTextNode(publicacion.votos);
    divAux2.appendChild(nVotos);
    votos.appendChild(divAux2);
    
    aside.appendChild(comentarios);
    aside.appendChild(votos);

    var divAux5 = document.createElement("div");    
    divAux5.appendChild(titulo);
    divAux5.appendChild(aside);
    articulo.appendChild(divAux5);
    articulo.setAttribute("href", "../art/index.php?id="+publicacion.id);
    $("#content .articulos").append(articulo);
}

function validarBusqueda(){
    if($("#buscar").val() == ""){
        $('#errorBuscarVacio').css({"display" : "block"});
        $('#fieldsetBuscar').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetBuscar legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else $("#formBuscar").submit();
}

function validarFormCat(){
    var correcto = true;
    if($("#nombreCategoria").val() == ""){
        $('#errorNombreVacio').css({"display" : "block"});
        $('#fieldsetNombreCategoria').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetNombreCategoria legend').css({"color" : "rgb(247, 94, 94)"});
        correcto = false;
    }
    if(!(/^[A-Z\s]*$/i.test($("#nombreCategoria").val()))){
        $('#errorNombreIlegal').css({"display" : "block"});
        $('#fieldsetNombreCategoria').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetNombreCategoria legend').css({"color" : "rgb(247, 94, 94)"});
        correcto = false;
    }
    else{
        $.ajax({
            type: 'POST',
            url: "../../conexion/existeCategoria.php",
            async: false,
            data:{
                nombre: $("#nombreCategoria").val(),
            },
            cache: false,
            success: function (data) {
                if (data != 1){
                    $('#errorNombreNoDisponible').css({"display" : "block"});
                    $('#fieldsetNombreCategoria').css({"border-color" : "rgb(247, 94, 94)"});
                    $('#fieldsetNombreCategoria legend').css({"color" : "rgb(247, 94, 94)"});
                    correcto = false;
                }
            },
            error: function (data) {
                console.log("error al procesar los datos");
                console.log(data);
            }
        });
    }
    if($("#descCategoria").val().length >= 255){
        $('#descripcionLarga').css({"display" : "block"});
        $('#fieldsetDescCategoria').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetDescCategoria legend').css({"color" : "rgb(247, 94, 94)"});
        correcto = false;
    }
    if(correcto){
        $.ajax({
            type: 'POST',
            url: "../../conexion/addCategoria.php",
            async: false,
            data:{
                nombre: $("#nombreCategoria").val(),
                desc: $("#descCategoria").val(),
            },
            cache: false,
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                alert("Error al crear la categoría");
                console.log(data);
            }
        });
    }
}

function vacio(){
    $(".articulos").append("Que oscuro y vacío está esto...");
}