$(document).ready(function() {
    $("#btnBuscar").click(function () {validarBusqueda();});
    //recupero el nombre de usuario
    var usuario = $("#aliasUsuario").val();
    //mostrar la foto de perfil del usuario ajeno
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "error")  $("#pfpUSer").attr("src", "../../resources/img/pfp/(default).jpg");
            else $("#pfpUSer").attr("src", this.responseText);
        }
    };
    xhttp.open("GET", "../../conexion/existeImagen.php?alias="+usuario, true);
    xhttp.send();

    $("#follow").on("click", function(){
        $.ajax({
            type: 'POST',
            url: "../../conexion/followUsuario.php",
            data: {
                alias: $("#aliasUsuario").val(),
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


function validarBusqueda(){
    if($("#buscar").val() == ""){
        $('#errorBuscarVacio').css({"display" : "block"});
        $('#fieldsetBuscar').css({"border-color" : "rgb(247, 94, 94)"});
        $('#fieldsetBuscar legend').css({"color" : "rgb(247, 94, 94)"});
    }
    else $("#formBuscar").submit();
}