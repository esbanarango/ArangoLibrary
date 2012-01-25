$(document).ready(function() {
    
    $(".uploadButtom").click(function(){
        //$('#photoimg').click();
        });
    
    $("#actions a").live("click",function(e){
        e.preventDefault();
        var url = $(this).attr("href");      
        
        $("#nextForm").load(url, { view: "view"} ,function(response, status, xhr) {
            if (status == "error") {
                humane.timeout = (3000);
                humane.error("Error en el servidor");
            }else{
                
                var newWidth = $("#nextForm #form").width();
                var newHeight = $("#nextForm #form").height(); 
                var newLeft = $("#nextForm #form").css("margin-left"); 
                var newTop = $("#nextForm #form").css("margin-top"); 

                $("#nextForm #form").removeClass().css("display","none");
      
                $('#form_wrapper #form').fadeOut(function(){
                    
                    $("#form_wrapper").stop().animate({

                        width   : newWidth + 'px',

                        height  : newHeight + 'px',
                        
                        marginLeft: newLeft,
                        
                        marginTop: newTop
                        

                    },500,function(){

                     
                        //show the new form

                        $("#form_wrapper").html($("#nextForm").html());
                        $("#form_wrapper #form").fadeIn(400);
                    });
                });
      
                
            }
        });

    });

    
});


var logging = null;
function login(url){
    
    
    /**** Validating ****/
    
    if(!validationLogin()){
        return false;
    }
    
    var cadenaFormulario = "";

    cadenaFormulario += 'name='+$("#username").val();
    cadenaFormulario += '&password='+$("#password").val();

    //Por si ya hay una petición previa al servidor
    if(logging){
        logging.abort();
    }
    
    logging = $.ajax({
        type: "POST",
        url: url,  
        data: cadenaFormulario,
        dataType: "html",
        cache: false,
        timeout: 8000, //Si se cumple este timepo será un error
        beforeSend: function(){
            $(".edge").fadeIn("slow");
            $("#submit").val("Verificando...");
        },
        success: function(data){
            var respuesta = data.split('|-estado-|');
            if(respuesta[0] == 'mal')
            {
                humane.timeout = (3000);
                humane.error("Usuario y/o Password incorrectos"); 
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");
            }
            else{
                $(".edge").delay(1000).fadeOut("slow",function(){
                    
                    var urlDone = "http://arangolibrary.phpfogapp.com/public";
                    $(location).attr("href",urlDone);

                });
            }
            
        },
        error: function(result){
            if(result.statusText != "abort"){
                humane.timeout = (3000);
                humane.error("Error en el servidor");
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");

            }
        }
    });
    return false;
}

function newAuthor(urlAction)
{
    /**** Validating ****/
    
    if(!validationNewAuthor()){
        return false;
    }
    
    
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
                alert(respuesta[1]);
            }
            else
            {
                alert("Bien "+respuesta[1]);
            }  
        }
    });
    return false;
}


/**** Validations ****/

function validationNewAuthor(){
    
    if($("#name").val() == ""){
        $("#name").addClass("errorInput");       
        return false;
    }else if($("#last_name").val() == ""){
        $("#last_name").addClass("errorInput");
        return false;
    }else if($("#estado").val() == null){
        $("#estado_chzn").addClass("errorInput");
        return false;
    }else if($("#ciudad").val() == null){
        $("#ciudad_chzn").addClass("errorInput");
        return false;
    }
    
    return true;
    
}

function validationLogin(){
    
    if($("#user").val() == ""){
        $("#user").addClass("errorInput");
        return false;
    }else if($("#password").val() == ""){
        $("#password").addClass("errorInput");
        return false;
    }
    
    return true;
    
}