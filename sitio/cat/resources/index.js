$(document).ready(function() {
    $("#header .perfil").click(function (){
        location.href = "../profile/";
    });

    //seguirr/dejar de seguir categoria
    $("#seguir").click(function (){
        $.ajax({
            type: 'POST',
            url: "../../conexion/followCategoria.php",
            data: {
                idCat: $("#idCat").val(),
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

    //eliminar categoria
    $("#delCat").click(function (){
        if(prompt("Esta acción es irreversible y todos los artículos de esta categoría serán eliminados.\nTeclea 'ELIMINAR' para eliminar la categoria") == 'ELIMINAR'){
            $.ajax({
                type: 'POST',
                url: "../../conexion/deleteCategoria.php",
                data: {
                    idCat: $("#idCat").val(),
                },
                success: function (){
                    location.href="../home";
                },
                error: function (data) {
                    console.log("error al procesar los datos");
                    console.log(data);
                }
            });
        }
    });

    getPublicaciones($("#idCat").val());

    $("#btnBuscar").click(function () {
        validarBusqueda();
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
function generarPagina(publicaciones){
    for(let i = 0; i < publicaciones.length; i++){
        crearArticulo(publicaciones[i]);
    }
}

//mediante DOM creo la lista de articulos
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

//recupero las publicaciones de la categoria especificada
function getPublicaciones(idCat){
    $.ajax({
        type: 'POST',
        url: "../../resources/getPublicaciones/categoria.php",
        data: {
            idCat,
        },
        success: function (json){
            generarPagina(JSON.parse(json));
        },
        error: function (data) {
            console.log("error al procesar los datos");
            console.log(data);
        }
    });
}