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

    if(tipo == "comentarios") $(".list").html("<h3>Comentarios</h3><hr/>");
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
    if (tipo == "categorias"){
        $(".list").empty();
        $(".list").html("<h3>Categorías</h3><hr/>");
        for(let i = 0; i < elementos.length; i++) crearCat(elementos[i]);
    }
    else if (tipo == "articulos"){
        $(".list").empty();
        $(".list").html("<h3>Publicaciones</h3><hr/>");
        for(let i = 0; i < elementos.length; i++) crearPub(elementos[i]);
    }
    else if (tipo == "comentarios"){
        $(".list").empty();
        $(".list").html("<h3>Comentarios</h3><hr/>");
        for(let i = 0; i < elementos.length; i++) crearComentario(elementos[i]);
    }
    else if (tipo == "usuarios"){
        $(".list").empty();
        $(".list").html("<h3>Usuarios</h3><hr/>");
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

//mediante DOM creo la lista de categorias
function crearCat(categoria){
    var divcategoria = document.createElement("a");
    divcategoria.setAttribute("class", "categoria");
    divcategoria.setAttribute("id", categoria.id);

    var divAux1 = document.createElement("div");
    divAux1.setAttribute("class", "nombre");
    
    divAux1.appendChild(document.createTextNode(categoria.nombre));

    var divAux2 = document.createElement("div");
    divAux2.setAttribute("class", "nSeguidores");

    divAux2.appendChild(document.createTextNode("Miembros: "+categoria.seguidores));
    
    var divAux3 = document.createElement("div");
    divAux3.setAttribute("class", "descripcion");
    
    if(categoria.descripcion == "") divAux3.appendChild(document.createTextNode("(Sin descripción)"));
    else divAux3.appendChild(document.createTextNode(b64DecodeUnicode(categoria.descripcion)));
    
    divcategoria.setAttribute("href", "../cat/index.php?id="+categoria.id);

    divcategoria.appendChild(divAux1);
    divcategoria.appendChild(divAux2);
    divcategoria.appendChild(divAux3);

    $(".list").append(divcategoria);
}

//mediante DOM creo la lista de categorias
function crearComentario(comentario){
    var divcomentario = document.createElement("a");
    divcomentario.setAttribute("class", "comentario");
    divcomentario.setAttribute("id", comentario.id);

    var divAux1 = document.createElement("div");

    var pfp = document.createElement("img");
    pfp.setAttribute("src", comentario.foto);
    pfp.setAttribute("class", "imagen");
    divAux1.appendChild(pfp);
    
    var divAux2 = document.createElement("div");
    divAux2.setAttribute("class", "cuerpo");
    
    var divAux3 = document.createElement("div");
    divAux3.setAttribute("class", "comentador");
    divAux3.appendChild(document.createTextNode(comentario.comentador));

    var divAux4 = document.createElement("div");
    divAux4.setAttribute("class", "contenido");
    divAux4.appendChild(document.createTextNode(b64DecodeUnicode(comentario.contenido)));
    
    divAux2.appendChild(divAux3);
    divAux2.appendChild(divAux4);
    divAux1.appendChild(divAux2);

    var divAux5 = document.createElement("div");
    divAux5.setAttribute("class", "votos");

    divcomentario.setAttribute("href", "../art/index.php?id="+comentario.articulo);

    divcomentario.appendChild(divAux1);

    $(".list").append(divcomentario);
}

//mediante DOM creo la lista de categorias
function crearUsuario(usuario){

    var divusuario = document.createElement("a");
    divusuario.setAttribute("href", "../user/index.php?alias="+usuario.alias);
    divusuario.setAttribute("id", usuario.alias);
    divusuario.setAttribute("class", "usuario");

    var divAux1 = document.createElement("div");
    divAux1.classList.add("listAlias");
    divAux1.appendChild(document.createTextNode(usuario.alias));

    var divAux2 = document.createElement("div");
    divAux2.classList.add("listNombre");


    if(usuario.nombre == "" || usuario.nombre == null){
        if(usuario.apellidos != "" && usuario.apellidos != null){
            divAux2.appendChild(document.createTextNode("Sr/Sra "+usuario.apellidos));
        }
        else{
            divAux2.appendChild(document.createTextNode(""));
        }
    }
    else{
        if(usuario.apellidos != "" || usuario.apellidos != null){
            divAux2.appendChild(document.createTextNode(usuario.nombre+" "+usuario.apellidos));
        }
        else{
            divAux2.appendChild(document.createTextNode(usuario.nombre));
        }
    }

    var divAux3 = document.createElement("div");
    divAux3.classList.add("listRep");
    divAux3.appendChild(document.createTextNode("Reputación: "+usuario.rep));

    var divAux4 = document.createElement("div");
    divAux4.classList.add("listDate");
    divAux4.appendChild(document.createTextNode("Fecha de creación: "+usuario.fecha_creacion));

    divusuario.appendChild(divAux1);
    divusuario.appendChild(divAux2);
    divusuario.appendChild(divAux3);
    divusuario.appendChild(divAux4);
    $(".list").append(divusuario);
}


//decodificar tildes en base64
function b64DecodeUnicode(str) {
    // bytestream -> percent-encoding -> string original
    return decodeURIComponent(atob(str).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
}
function vacio(){
    $(".list").append("Que oscuro y vacío está esto...");
}