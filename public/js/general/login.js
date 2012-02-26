$(document).ready(function() {
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
                logAlert("Usuario y/o Password incorrectos","topCenter","error","5000");
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");
            }
            else{
                $(".edge").delay(1000).fadeOut("slow",function(){
                    var urlDone = "localhsot/ArangoLibrary/public";
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
        data: {username:$("#username").val(),email:$("#email").val(),name:$("#name").val()
                ,lastname:$("#lastname").val(),password:$("#password").val()},
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
                    logAlert("!Bienvenido¡","topCenter","success","5000");
                });
            } 
        },
        error: function(result){
            if(result.statusText != "abort"){
                log("Error en el servidor","topCenter","error","5000");
                $("#submit").val("Entrar");
                $(".edge").delay(1000).fadeOut("slow");
            }
        }
    });
    return false;    
}

var checkingUserName = null;
function checkUserName(){
    //Por si ya hay una petición previa al servidor
    if(resgitering){
        resgitering.abort();
    }
    checkingUserName = $.post("test.php", { username: $("#username").val(), time: "2pm" },
       function(data) {
         alert("Data Loaded: " + data);
       });
}