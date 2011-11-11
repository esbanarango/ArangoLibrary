
function cargarContenido(pagina, destino)
{
    var contenedor;
    var ajax;
    

    contenedor = document.getElementById(destino);
    
    ajax = nuevoAjax(ajax);
    ajax.open("GET", pagina, true);
    ajax.onreadystatechange=function() {
        if(ajax.readyState==1)
        {
            contenedor.innerHTML = '<img src = "/arangolibrary.phpfogapp.com/public/Images/layout/loading_small.gif" alt ="Cargando"/>';
        }
        else if (ajax.readyState==4)
        {
            contenedor.innerHTML = ajax.responseText;

            if(ajax.status == 200) {
                output = ajax.responseText;
                contenedor.innerHTM = parseScript(output);
            } else {
                contenedor.innerHTML = pageErrorMessage+"\n"+output;
            }
        }
    }
    ajax.send(null);
}

function cargarLocacion(pagina, destino, locacion, obligatorio, seleccion)
{
    var ubicacion = locacion;
    
    var cadenaFormulario = "ubicacion="+ubicacion+"&obligatorio="+obligatorio+"&seleccion="+seleccion;
    
    var peticion=nuevoAjax();
    peticion.open("POST", pagina, true);
    peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
    peticion.send(cadenaFormulario);
    peticion.onreadystatechange = function()
    {
        if (peticion.readyState == 4)
        {         
            
            document.getElementById(destino).innerHTML = peticion.responseText;

            if(peticion.status == 200) {
               var output = peticion.responseText;
                document.getElementById(destino).innerHTM = parseScript(output);
            } else {
                document.getElementById(destino).innerHTML = pageErrorMessage+"\n"+output;
            }
            
            
        }
    }
}