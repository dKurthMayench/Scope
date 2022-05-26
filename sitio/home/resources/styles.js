$(document).ready(function() {
    //estilos de la barra de navegación
    $(".general").addClass("selected");
    $(".general").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesGeneral();
    });
    $(".guardados").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesGuardadas();
    });
    $(".votados").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesVotadas();
    });
    $(".publicados").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesPropias();
    });
    $(".siguiendo").click(function (){
        $(".nav div").removeClass("selected");
        $(this).addClass("selected");
        $(".articulos").empty();
        getPublicacionesSiguiendo();
    });

    //ajax para recuperar la foto de perfil
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //elimino espacios que sobran en el string
            //compruebo si existe una foto de perfil, y su extensión
            if (this.responseText == "error")  $("#fotoPerfil").attr("src", "../../resources/img/pfp/(default).jpg");
            else $("#fotoPerfil").attr("src", this.responseText);
        }
    };
    xhttp.open("GET", "../../conexion/existeImagen.php", true);
    xhttp.send();
    window.onresize = function () {fitText("nav")};
});


//no funciona (creo que porque es display: flex y pasa algo raro al calcular el width)
//comprueba si el texto se sale del div y cambia el tamaño de la fuente
function fitText(outputSelector){
    for (let i = 0; i < document.getElementById(outputSelector).getElementsByTagName("div"); i++){
        const maxFontSize = 50;
        let outputDiv = document.getElementById(outputSelector).getElementsByTagName("div")[i];
        let width = outputDiv.clientWidth;
        let contentWidth = outputDiv.scrollWidth;
        let fontSize = parseInt(window.getComputedStyle(outputDiv, null).getPropertyValue('font-size'),10);
        if (contentWidth > width){
            fontSize = Math.ceil(fontSize * width/contentWidth,10);
            fontSize =  fontSize > maxFontSize  ? fontSize = maxFontSize  : fontSize - 1;
            outputDiv.style.fontSize = fontSize+'px';   
        }else{
            while (contentWidth === width && fontSize < maxFontSize){
                fontSize = Math.ceil(fontSize) + 1;
                fontSize = fontSize > maxFontSize  ? fontSize = maxFontSize  : fontSize;
                outputDiv.style.fontSize = fontSize+'px';   
                width = outputDiv.clientWidth;
                contentWidth = outputDiv.scrollWidth;
                if (contentWidth > width){
                    outputDiv.style.fontSize = fontSize-1+'px'; 
                }
            }
        }
    }
}