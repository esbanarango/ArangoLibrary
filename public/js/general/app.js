

function newAuthor(urlAction)
{
    
    /**** Validations ****/
    
    if(!validationNewAuthor()){return false;}
    
    
    var cadenaFormulario = "";
    var sepCampos="&";
    cadenaFormulario += sepCampos+'name='+$("#name").val();
    cadenaFormulario += sepCampos+'last_name='+$("#last_name").val();
    cadenaFormulario += sepCampos+'bio='+$("#bio").val();
    cadenaFormulario += sepCampos+'edu='+$("#edu").val();
    cadenaFormulario += sepCampos+'pais='+$("#pais").val();
    cadenaFormulario += sepCampos+'estado='+$("#estado").val();
    cadenaFormulario += sepCampos+'ciudad='+$("#ciudad").val();


    $.ajax({
        type: "POST",
        url: urlAction,  
        data: cadenaFormulario,
        success: function(data){
                
            var respuesta = data.split('|-estado-|');
            if(respuesta[0] == 'mal')
            {
            }
            else
            {  
        }
        }
    });
    return false;
}

function validationNewAuthor(){
    
    if($("#name").val() == ""){
        $("#name").addClass("errorInput");
        
        return false;
    
    }else if($("#last_name").val() == ""){
        $("#last_name").addClass("errorInput");
        return false;
    }
    
    return true;
    
}