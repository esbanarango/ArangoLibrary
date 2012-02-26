cargandoContenido = null;
function cargarContenido(pagina, destino)
{
    var contenedor;
    contenedor = document.getElementById(destino);
    
    //Por si ya hay una petición previa al servidor
    if(cargandoContenido){
        cargandoContenido.abort();
    }
    
    cargandoContenido = $.ajax({
        type: "POST",
        url: pagina,  
        dataType: "html",
        cache: false,
        timeout: 8000, //Si se cumple este timepo será un error
        beforeSend: function(){
        },
        success: function(data, textStatus, xhr){
            
            contenedor.innerHTML = data;
            if(xhr.status == 200) {
                var output = data;
                contenedor.innerHTM = parseScript(output);
            } else {
                contenedor.innerHTML = pageErrorMessage+"\n"+output;
            }
            
        },
        error: function(result){
            if(result.statusText != "abort"){
                humane.timeout = (3000);
                humane.error("Error en el servidor");
            }
        }
    });
}

cargandoLocacion = null;
function cargarLocacion(pagina, destino, locacion, obligatorio, seleccion)
{
    var ubicacion = locacion;
    
    var cadenaFormulario = "ubicacion="+ubicacion+"&obligatorio="+obligatorio+"&seleccion="+seleccion;
    
    //Por si ya hay una petición previa al servidor
    if(cargandoLocacion){
        cargandoLocacion.abort();
    }
    
    cargandoLocacion = $.ajax({
        type: "POST",
        url: pagina,  
        data: cadenaFormulario,
        dataType: "html",
        cache: false,
        timeout: 8000, //Si se cumple este timepo será un error
        beforeSend: function(){
        },
        success: function(data, textStatus, xhr){
            
             document.getElementById(destino).innerHTML = data;

            if(xhr.status == 200) {
                var output = data;
                document.getElementById(destino).innerHTM = parseScript(output);
            } else {
                document.getElementById(destino).innerHTML = pageErrorMessage+"\n"+output;
            }
            
        },
        error: function(result){
            if(result.statusText != "abort"){
                humane.timeout = (3000);
                humane.error("Error en el servidor");
            }
        }
    });
    
}