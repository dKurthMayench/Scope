var control = true;

var ed;

$(document).ready(function() {
    //editor de texto
    ClassicEditor
        .create( document.querySelector( '#editor' ), { 
            mediaEmbed: {
                removeProviders: [ 'googleMaps', ]
            }
        } )
        .then( editor => {
            ed = editor;
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
    //como he hecho los inputs sin bordes, no se ve dónde hay que hacer click para poder escribir en ellos.
    //aquí hago que aunque le des click al fieldset, haga como si le hubieras dado al input
    $("#fieldsetCat").click(function (){
        $("#cat").focus();
    });
    $("#fieldsetArt").click(function (){
        $("#art").focus();
    });
    $("#fieldsetCategoria").click(function (){
        $("#categoria").focus();
    });
    //cambiar a ruta absoluta si me acuerdo
    $("#header .perfil").click(function (){
        location.href = "../profile/";
    });
    $("#btnBuscar").click(function () {
        validarBusqueda();
    });
    //barra de búsqueda dinámica(?) en el apartado de publicar
    $("#categoria").keyup(function () {
        //recupero el valor del input
        var cat = $("#categoria").val();
        //si está vacío, no mostraré nada
        if (cat == "") {
            $("#resultados").html("");
            $("#resultados").css("display", "none");
            $("#linea").removeClass("desplegar");
            $("#linea").addClass("replegar");
        }
        //si no está vacío, irá a un php que devolverá 5 categorías que tengan un substring igual que la variable "cat"
        else{
            $.ajax({
                type: "POST",
                url: "../../conexion/buscar.php",
                data:{
                    buscar: cat
                },
                success: function(json){
                    //si el php devuelve 0 significa que la categoria no existe en la bbdd
                    if (json == "0") {
                        $("#resultados").html("<div class='resultadoError'>No existe la categoría "+$("#categoria").val()+"</div>");
                        $("#resultados").css("display", "");
                        $("#linea").removeClass("replegar");
                        $("#linea").addClass("desplegar");
                    }
                    //si no devuelve 0, genero una lista de máximo 5 elementos, con un onclick (véase linea 52).
                    else{
                        $("#resultados").html("");
                        $("#resultados").css("display", "");
                        $("#linea").removeClass("replegar");
                        $("#linea").addClass("desplegar");
                        JSON.parse(json).forEach(categoria => {
                            var div = document.createElement("div");
                            var text = document.createTextNode(categoria.nombre);
                            div.appendChild(text);
                            div.classList.add("resultado");
                            //al hacer click en un elemento de la lista, el valor del input pasará a ser el valor del elemento de la lista
                            div.addEventListener("click", function () {
                                document.getElementById("categoria").value = text.nodeValue;
                                //elimino los elementos anteriores para que no me ponga 5 elementos repetidos
                                $("#resultados").html("");
                                $("#resultados").css("display", "none");
                                $("#linea").removeClass("desplegar");
                                $("#linea").addClass("replegar");
                                $("#fieldsetCategoria, #fieldsetCategoria legend").css({"border-color" : "", "color" : ""});
                                $("#errorCategoriaVacia, #errorCategoriaNoExiste").css({"display" : "none"});
                            }, false);
                            document.getElementById("resultados").appendChild(div);
                        });
                    }
                }
            });
        }
    });

    $('#form').on('submit', (function (e) {
        $.ajax({
            type: 'POST',
            url: "../../conexion/addArticulo.php",
            data: {
                content: ed.getData(),
                tituloArt: $("#tituloArt").val(),
                categoria: $("#categoria").val(),
            },
            success: function (data){
                location.href="../inicio";
            },
            error: function (data) {
                console.log("error al procesar los datos");
                console.log(data);
            }
        });
    }));
    $("#continuar").click(function () {
        validarPublicacion();
    });

});

function validarCategoria(){
    //si esta vacia, error
    if($("#categoria").val() == ""){
        $('#errorCategoriaVacia').css({"display" : "block"});
        $('#fieldsetCategoria').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetCategoria legend').css({"color" : "rgb(247, 94, 94)"});
        correcto(false);
    }
    else{
        $.ajax({
            type: 'POST',
            url: "../../conexion/existeCategoria.php",
            async: false,
            data:{
                nombre: $("#categoria").val(),
            },
            cache: false,
            success: function (data) {
                if (data != 0){
                    $('#errorCategoriaNoExiste').css({ "display": "block" });
                    $('#fieldsetCategoria').css({ "border-color": "rgb(247, 94, 94)" });
                    $('#fieldsetCategoria legend').css({ "color": "rgb(247, 94, 94)" });
                    correcto(false);
                }
            },
            error: function (data) {
                console.log("error al procesar los datos");
                console.log(data);
            }
        });
    }
}


function validarBusqueda(){
    if($("#buscar").val() == ""){
        $('#errorBuscarVacio').css({"display" : "block"});
        $('#fieldsetBuscar').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetBuscar legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else $("#formBuscar").submit();
}
function validarTitulo(){
    //si esta vacio, error
    if($("#tituloArt").val() == ""){
        $('#errorTituloVacio').css({"display" : "block"});
        $('#fieldsetTituloArt').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetTituloArt legend').css({"color" : "rgb(247, 94, 94)"});
        correcto(false);
    }
    //si es demasiado largo, error
    else if ($("#tituloArt").val().length > 150){
        $('#errorTituloLargo').css({"display" : "block"});
        $('#fieldsetTituloArt').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetTituloArt legend').css({"color" : "rgb(247, 94, 94)"});
        correcto(false);
    }
}

function correcto(x){
    //si x = false, hay un error en el formulario
    if (!x) control = false;
}
function validarPublicacion(){
    validarCategoria();
    validarTitulo();
    if(control){
        $("#form").submit();
    }
}