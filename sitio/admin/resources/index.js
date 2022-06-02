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

    //se mostrará la pestaña "Categorias" al cargar la pagina
    getElementos("categorias");

    $(".categorias").on("click", function () { getElementos("categorias");});
    $(".articulos").on("click", function () { getElementos("articulos");});
    $(".comentarios").on("click", function () { getElementos("comentarios");});
    $(".usuarios").on("click", function () { getElementos("usuarios");});
});

function getElementos(tipo){
    $(".list").empty();
    if(tipo == "categorias") $(".list").html("<h3>Categorías</h3><hr/>");
    else if(tipo == "articulos") $(".list").html("<h3>Publicaciones</h3><hr/>");
    else if(tipo == "comentarios") $(".list").html("<h3>Comentarios</h3><hr/>");
    else if(tipo == "usuarios") $(".list").html("<h3>Usuarios</h3><hr/>");
    $.ajax({
        type: 'POST',
        url: "../../resources/admin/getElementos.php",
        async: false,
        data:{
            type: tipo
        },
        success: function (data) {
            console.log(data);
            if (data != "vacio") generarPagina(JSON.parse(data), tipo);
            else vacio();
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

function generarPagina(elementos, tipo){
    if (tipo == "caetgorias"){
        for(let i = 0; i < elementos.length; i++) crearCat(elementos[i]);
    }
    else if (tipo == "articulos"){
        for(let i = 0; i < elementos.length; i++) crearPub(elementos[i]);
    }
    else if (tipo == "comentarios"){
        for(let i = 0; i < elementos.length; i++) crearComentario(elementos[i]);
    }
    else if (tipo == "usuarios"){
        for(let i = 0; i < elementos.length; i++) crearUsuario(elementos[i]);
    }
}

//mediante DOM creo la lista de publicaciones
function crearPub(publicacion){
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
    comentarios.setAttribute("class", "nCom");

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
    $(".list").append(articulo);
}


function vacio(){
    $(".list").append("Que oscuro y vacío está esto...");
}