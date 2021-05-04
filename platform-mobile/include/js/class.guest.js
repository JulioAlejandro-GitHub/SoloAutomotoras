
Guest = function(params){

    this.path      =  '/';       
    
    //Objetos DOM existentes

    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
       
    this.addVisitanteForm = function() {
        $.fancybox({
            href: 'form_add_visitante.php'
        });    
    }
    
    this.addVisitante = function() {
        var obj = this;
        
        var email           = $("#visitante-email")           .val();
        var password        = $("#visitante-password")        .val();
        var passwordrep     = $("#visitante-password-rep")    .val();
        var nombre          = $("#visitante-nombre")          .val();
        var apellidopaterno = $("#visitante-apellidopaterno") .val();
        var apellidomaterno = $("#visitante-apellidomaterno") .val();
        var rut             = $("#visitante-rut")             .val();
        
        var mensajeError = new Array();
        
        if(password != passwordrep) {
            alert('Contraseñas no coinciden');
            return false;
        }

        if(!email) {
            mensajeError.push('Email');
        }
        if(!password || !passwordrep) {
            mensajeError.push('Contraseña');
        }
        if(!nombre) {
            mensajeError.push('Nombre');
        }

        if(mensajeError.length) {
            alert("Campos requeridos: " + mensajeError.join(', '));
            return false;
        }
        
        var data = {
            email             : email,
            password          : password,
            nombre            : nombre,
            apellidopaterno   : apellidopaterno,
            apellidomaterno   : apellidomaterno,
            rut               : rut,

            target      : 'visitante',
            action      : 'add'
        }

        var ajax = new Ajax ({
            url        :  'app/admin/guest-request.php',
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                //loader
            },  
            onSuccess  :  function(result) {
                switch($.trim(result)) {
                    case 'ADD_OK':
                        alert("Registro completo");
                        $.fancybox.close();
                        break;
                        
                    case 'ADD_EXISTS':
                        alert("El correo ingresado ya está registrado");
                        break;

                    default:
                        alert("Error al intentar registrarse");
                }
            }  
        });

        ajax.request();         
    }
    
}
