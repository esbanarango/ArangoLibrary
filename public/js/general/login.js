$(document).ready(function() {
    $("#actions a").live("click",function(e){
        e.preventDefault();
        var url = $(this).attr("href");      
        $("#nextForm").load(url, {
            view: "view"
        } ,function(response, status, xhr) {
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
    //Checking userName exist's
    $( document ).on( "focusout", "#inputsNewUser #username", checkUserName); 
    //Checking password equality
    $( document ).on( "focusout", "#inputsNewUser #confirm_password", checkPassword); 
});

var logging = null;
function login(url){

    /**** Validating ****/
    if(!validationLogin()){
        return false;
    }
    
    var cadenaFormulario = "";
    cadenaFormulario += 'username='+$("#username").val();
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
                logAlert("Usuario y/o Password incorrectos","topCenter","error","3000");
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");
            }
            else{
                $(".edge").delay(1000).fadeOut("slow",function(){
                    var urlDone = "/public";
                    $(location).attr("href",urlDone);
                });
            } 
        },
        error: function(result){
            if(result.statusText != "abort"){
                logAlert("Error en el servidor","topCenter","error","5000");
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");
            }
        }
    });
    return false;
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
var resgitering = null;
function register(url){

    //Por si ya hay una petición previa al servidor
    if(resgitering){
        resgitering.abort();
    }
    resgitering = $.ajax({
        type: "POST",
        url: url,  
        data: {
            username:$("#username").val(),
            email:$("#email").val(),
            name:$("#name").val()
            ,
            lastname:$("#lastname").val(),
            password:$("#password").val()
        },
        dataType: "html",
        cache: false,
        timeout: 8000, //Si se cumple este timepo será un error
        beforeSend: function(){
            $(".edge").fadeIn("slow");
            $("#submit").val("Registrando...");
        },
        success: function(data){
            var respuesta = data.split('|-estado-|');
            if(respuesta[0] == 'mal')
            {
                logAlert("Error en el servidor","topCenter","error","5000");
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");
            }
            else{
                $(".edge").delay(1000).fadeOut("slow",function(){
                    $("#submit").val("Entrar");
                });
                logAlert("!Bienvenido¡","topCenter","success","5000");
            } 
        },
        error: function(result){
            if(result.statusText != "abort"){
                logAlert("Error en el servidor","topCenter","error","5000");
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");
            }
        }
    });
    return false;    
}

var checkingUserName = null;
function checkUserName(){
    var input = this;
    //Por si ya hay una petición previa al servidor
    if(checkingUserName){
        checkingUserName.abort();
    }
    $(input).addClass("thinking");
    checkingUserName = $.post($(input).data("url"), {
        username: $(input).val()
    },
    function(data) {
        var respuesta = data.split('|-estado-|');
        if(respuesta[0] == 'mal'){
            $(input).addClass("errorInput"); 
            $(input).next().addClass("errorAlert");
            $(input).next().find("li").text(respuesta[1]);
            $(input).focus();
        }else{
            $(input).removeClass("errorInput");
            $(input).next().removeClass("errorAlert");
        }
        $(input).removeClass("thinking");
    });
}

function checkPassword(){
    if($(this).val() != $("#password").val()){
        $(this).addClass("errorInput"); 
        $(this).next().addClass("errorAlert");
        $(this).next().find("li").text("La clave debe coincidir");
        $(this).focus();
        return false;
    }else{
        $(this).removeClass("errorInput");
        $(this).next().removeClass("errorAlert");
        return true;
    }
    
}