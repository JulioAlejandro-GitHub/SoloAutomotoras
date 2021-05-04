
User = function(params){

    this.path      =  '/';       

    //Objetos DOM existentes
    this.favoritos_container;

    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
       
    this.addFavorito = function(favorito) {
        var obj = this;
        
        var data = {
            id_vehiculo     : favorito.id_vehiculo,
            
            target      : 'favorito',
            action      : 'add'
        }
        
        var ajax = new Ajax ({
            url        :  'app/admin/user-request.php',
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                //loader
            },  
            onSuccess  :  function(result) {
                switch($.trim(result)) {
                    case 'ADD_OK':
                        alert("Vehículo agregado a favoritos");
                        //Mejora: actualizar sólo icono favorito vehiculo y listado favoritos
                        obj.getViewFavoritos();
                        search.goCatalog();
                        break;
                    
                    default:
                        alert("Error al intentar agregar vehículo a favoritos");
                }
            }  
        });
        
        ajax.request();        
    }
    
    this.deleteFavorito = function(favorito) {
        var obj = this;
        
        if (!confirm('¿Está seguro de eliminar de sus favoritos el vehículo "' + favorito.marca + favorito.modelo + '" (' + favorito.precio + ')')) {
            return false;
        }
        
        var data = {
            id_favorito : favorito.id_favorito,
                    
            target      : 'favorito',
            action      : 'delete'
        }
        
        var ajax = new Ajax ({
            url        :  'app/admin/user-request.php',
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                //loader
            },  
            onSuccess  :  function(result) {
                switch($.trim(result)) {
                    case 'DELETE_OK':
                        alert("Favorito eliminado");
                        //Mejora: actualizar sólo icono favorito vehiculo y listado favoritos
                        obj.getViewFavoritos();
                        search.goCatalog();
                        break;
                    
                    default:
                        alert("Error al intentar eliminar favorito");
                }
            }  
        });
        
        ajax.request();        
    }
    
    this.toggleFavoritos = function() {
        var favoritos_container = $(this.favoritos_container);
        $(favoritos_container).toggle();
    }
    this.toggleLoginUser = function() {
        var container = $(this.LoginUser_container);
        $(container).toggle();
    }
    
    this.getViewFavoritos = function() {
        //mejora: actualizar sólo la capa del listado
        $("#login-form").load('app/comun/formlogin.php');
    }
    
    this.editVisitanteForm = function() {
        $.fancybox({
            href : 'form_edit_visitante.php'
        });    
    }
    
    this.editVisitante = function() {
           var obj = this;

           var email           = $("#visitante-email")           .val();
           var password        = $("#visitante-password")        .val();
           var passwordrep     = $("#visitante-password-rep")    .val();
           var rut             = $("#visitante-rut")             .val();
           var nombre          = $("#visitante-nombre")          .val();
           var apellidopaterno = $("#visitante-apellidopaterno") .val();
           var apellidomaterno = $("#visitante-apellidomaterno") .val();
           
           var mensajeError = new Array();

           if(password != passwordrep) {
               alert('Contraseñas no coinciden');
               return false;
           }

           if(!email) {
               mensajeError.push('Email');
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
               rut               : rut,
               nombre            : nombre,
               apellidopaterno   : apellidopaterno,
               apellidomaterno   : apellidomaterno,

               target      : 'visitante',
               action      : 'edit'
           }

           var ajax = new Ajax ({
               url        :  'app/admin/user-request.php',
               data       :  data,
               type       :  "POST",
               onStart    :  function() {
                   //loader
               },  
               onSuccess  :  function(result) {
                   switch($.trim(result)) {
                       case 'EDIT_OK':
                           //Mejora actualizar sólo nombre de usuario
                           $("#login-form").load('app/comun/formlogin.php');
                           alert("Datos editados");
                           $.fancybox.close();
                           break;
                           
                       case 'EDIT_EXISTS':
                           alert("El correo ingresado ya está registrado");
                           break;

                       default:
                           alert("Error al intentar editar datos");
                   }
               }  
           });

           ajax.request();        
    }    
    
}
