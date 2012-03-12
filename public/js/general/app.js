$(document).ready(function() {
    
    //$( document ).on( "click", ".nav_top li a", function( e ) { $(".")    } );
    
    $(".uploadButtom").click(function(){
        //$('#photoimg').click();
        });  
});

function newAuthor(urlAction)
{
    /**** Validating ****/
    if(!validationNewAuthor()){
        return false;
    }
    var cadenaFormulario = "";
    var sepCampos="&";
    cadenaFormulario += $("#newAuthorForm").serialize();

    $.ajax({
        type: "POST",
        url: urlAction,  
        data: cadenaFormulario,
        success: function(data){
                
            var respuesta = data.split('|-estado-|');
            if(respuesta[0] == 'mal')
            {
                alert(respuesta[1]);
            }
            else
            {
                alert(respuesta[1]);
                clear_form_elements("#newAuthorForm");  
                $("#pais").val(0);
            }  
        }
    });
    return false;
}


/**** Validations ****/

function validationNewAuthor(){
    
    if($("#name").val() == ""){
        $("#name").addClass("errorInput").focus();       
        return false;
    }else if($("#last_name").val() == ""){
        $("#last_name").addClass("errorInput").focus();
        return false;
    }else if($("#estado").val() == null){
        $("#estado_chzn").addClass("errorInput").focus();
        return false;
    }else if($("#ciudad").val() == null){
        $("#ciudad_chzn").addClass("errorInput").focus();
        return false;
    }
    
    return true;
    
}

function clear_form_elements(ele) {

    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}