
Admin = function(params){

    this.path = '/';       
    this.loader_sucursales;
    this.loader_vendedores;
    
    //Objetos DOM existentes
    this.vendedores_container;
    this.sucursales_container;
    
    this.region;
    this.ciudad;
    this.automotora;
    
    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
       
    this.addSucursalForm = function() {
        $.fancybox({
            href: 'app/admin/form_add_sucursal.php'
        });    
    }
    
    this.editSucursalForm = function(sucursal) {
        var id_sucursal = sucursal.id;
        
        $.fancybox({
            href : 'app/admin/form_edit_sucursal.php?'+
            'id_sucursal='+ id_sucursal
        });    
    }
    
    this.addSucursal = function() {
        var obj = this;
        
        var rut             = $("#sucursal-rut")            .val();
        var nombre          = $("#sucursal-nombre")         .val();
        var telefono        = $("#sucursal-telefono")       .val();
        var email           = $("#sucursal-email")          .val();
        var fax             = $("#sucursal-fax")            .val();
        var razonsocial     = $("#sucursal-razonsocial")    .val();
        var logo            = $("#sucursal-logo")           .val();
        var map             = $("#sucursal-map")            .val();
        var url             = $("#sucursal-url")            .val();
        var direccion       = $("#sucursal-direccion")      .val();
        var ciudad          = $("#sucursal-ciudad")         .val();
        var horario_lunvie  = $("#sucursal-horario-lunvie") .val();
        var horario_sab     = $("#sucursal-horario-sab")    .val();
        var horario_dom     = $("#sucursal-horario-dom")    .val();
        
        var mensajeError = new Array();
        
        if(!rut) {
            mensajeError.push('Rut');
        }
        if(!nombre) {
            mensajeError.push('Nombre');
        }
        if(!razonsocial) {
            mensajeError.push('Razon Social');
        }
        if(!ciudad) {
            mensajeError.push('Ciudad');
        }
        
        if(mensajeError.length) {
            alert("Campos requeridos: " + mensajeError.join(', '));
            return false;
        }
        
        var data = {
            rut             : rut,
            nombre          : nombre,
            telefono        : telefono,
            email           : email,
            fax             : fax,
            razonsocial     : razonsocial,
            logo            : logo,
            map             : map,
            url             : url,
            direccion       : direccion,
            ciudad          : ciudad,
            horario_lunvie  : horario_lunvie,
            horario_sab     : horario_sab,
            horario_dom     : horario_dom,
            
            target      : 'sucursal',
            action      : 'add'
        }
        
        $("#form-add-sucursal").ajaxSubmit({
             data           : data,
             beforeSubmit   : function() { 
                new Loader({
                    container : $("#sucursal-submit-loader")
                }).start();                 
             },
             success        : function(result){
                 switch($.trim(result)) {
                     
                    case 'ADD_OK':
                        alert("Sucursal agregada");
                        $.fancybox.close();
                        obj.getViewSucursales();
                        break;
                        
                    case 'ADD_EXISTS':
                        alert("El rut ingresado ya está registrado");
                        break;
                    
                     case 'ADD_IMG_MAXSIZEBITS':
                        alert("La imagen tiene un tamaño (KB) que excede al permitido");
                        break;
                        
                     case 'ADD_IMG_MAXSIZEPIXELS':
                        alert("La imagen tiene un tamaño (píxeles) que excede al permitido");
                        break;
                        
                     case 'ADD_IMG_FORMAT':
                        alert("Sólo se permiten imágenes GIF, JPG, PNG");
                        break;
                        
                     case 'ADD_ERROR_UPLOAD_IMG':
                        alert("Sucursal agregada.\n\nError al intentar subir logo.");
                        $.fancybox.close();
                        obj.getViewSucursales();
                        break;
                        
                     case 'ADD_ERROR_MOVE_UPLOAD':
                        alert("Sucursal agregada.\n\nError al intentar copiar logo.");
                        $.fancybox.close();
                        obj.getViewSucursales();
                        break;
                         
                    default:
                        alert("Error al intentar agregar sucursal");
                 }
                 
                new Loader({
                    container : $("#sucursal-submit-loader")
                }).stop();                 
             }
        });
     
    }
    
    this.editSucursal = function(sucursal) {
        var obj = this;
        
        var rut             = $("#sucursal-rut")            .val();
        var rut_ant         = $("#sucursal-rut-antiguo")    .val();
        var nombre          = $("#sucursal-nombre")         .val();
        var telefono        = $("#sucursal-telefono")       .val();
        var email           = $("#sucursal-email")          .val();
        var fax             = $("#sucursal-fax")            .val();
        var razonsocial     = $("#sucursal-razonsocial")    .val();
        var logo            = $("#sucursal-logo")           .val();
        var map             = $("#sucursal-map")            .val();        
        var url             = $("#sucursal-url")            .val();
        var direccion       = $("#sucursal-direccion")      .val();
        var ciudad          = $("#sucursal-ciudad")         .val();
        var horario_lunvie  = $("#sucursal-horario-lunvie") .val();
        var horario_sab     = $("#sucursal-horario-sab")    .val();
        var horario_dom     = $("#sucursal-horario-dom")    .val();
        
        var mensajeError = new Array();
        
        if(!rut) {
            mensajeError.push('Rut');
        }
        if(!nombre) {
            mensajeError.push('Nombre');
        }
        if(!razonsocial) {
            mensajeError.push('Razon Social');
        }
        if(!ciudad) {
            mensajeError.push('Ciudad');
        }
        
        if(mensajeError.length) {
            alert("Campos requeridos: " + mensajeError.join(', '));
            return false;
        }
        
        var data = {
            id_sucursal     : sucursal.id,
                    
            rut             : rut,
            rut_ant         : rut_ant,
            nombre          : nombre,
            telefono        : telefono,
            email           : email,
            fax             : fax,
            razonsocial     : razonsocial,
            logo            : logo,
            map             : map,
            url             : url,
            direccion       : direccion,
            ciudad          : ciudad,
            horario_lunvie  : horario_lunvie,
            horario_sab     : horario_sab,
            horario_dom     : horario_dom,
            
            target      : 'sucursal',
            action      : 'edit'
        }
        
        $("#form-edit-sucursal").ajaxSubmit({
             data           : data,
             beforeSubmit   : function() { 
                new Loader({
                    container : $("#sucursal-submit-loader")
                }).start();                 
             },
             success        : function(result){
                 switch($.trim(result)) {
                     
                    case 'EDIT_OK':
                        alert("Sucursal editada");
                        $.fancybox.close();
                        obj.getViewSucursales();
                        break;
                        
                    case 'EDIT_EXISTS':
                        alert("El rut ingresado ya está registrado");
                        break;
                    
                     case 'EDIT_IMG_MAXSIZEBITS':
                        alert("La imagen tiene un tamaño (KB) que excede al permitido");
                        break;
                        
                     case 'EDIT_IMG_MAXSIZEPIXELS':
                        alert("La imagen tiene un tamaño (píxeles) que excede al permitido");
                        break;
                        
                     case 'EDIT_IMG_FORMAT':
                        alert("Sólo se permiten imágenes GIF, JPG, PNG");
                        break;
                        
                     case 'EDIT_ERROR_UPLOAD_IMG':
                        alert("Sucursal editada.\n\nError al intentar subir logo.");
                        $.fancybox.close();
                        obj.getViewSucursales();
                        break;
                        
                     case 'EDIT_ERROR_MOVE_UPLOAD':
                        alert("Sucursal editada.\n\nError al intentar copiar logo.");
                        $.fancybox.close();
                        obj.getViewSucursales();
                        break;
                         
                    default:
                        alert("Error al intentar editar sucursal");

                 }
                 
                new Loader({
                    container : $("#sucursal-submit-loader")
                }).stop();                 
             }
        });
             
    }
    
    this.deleteSucursal = function(sucursal) {
        var obj = this;
        
        if (!confirm('¿Está seguro de eliminar la sucursal "'+sucursal.nombre+'" ('+sucursal.rut+')')) {
            return false;
        }
        
        var data = {
            id_sucursal : sucursal.id,
            target      : 'sucursal',
            action      : 'delete'
        }
        
        var ajax = new Ajax ({
            url        :  'app/admin/admin-request.php',
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                //loader
            },  
            onSuccess  :  function(result) {
                switch($.trim(result)) {
                    case 'DELETE_OK':
                        alert("Sucursal eliminada");
                        obj.getViewSucursales();
                        break;
                    
                    default:
                        alert("Error al intentar eliminar sucursal");
                }
            }  
        });
        
        ajax.request();        
    }
    
    this.addVendedorForm = function() {
        $.fancybox({
            href: 'app/admin/form_add_vendedor.php'
        });    
    }
    
    this.createPreviewImage = function (params) {
        
        var input       = params.input;
        var preview     = params.preview;
        var cancel      = params.cancel;
        var default_img = params.default_img;

         if (input.files && input.files[0]) {
            var reader   = new FileReader();
            reader.readAsDataURL(input.files[0]);

            if (/^image\//.test(input.files[0].type)) {
                 reader.onload = function(e) {
                     $(preview).attr('src', e.target.result);
                     $(cancel).show();
                 };
            }
            else {
                alert("Sólo se permiten imágenes GIF, JPG, PNG");
                $(input).val('');
                $(preview).attr('src', default_img);
            }        
        }
    }

    this.deletePreviewImage = function (params) {
        var input       = params.input;
        var preview     = params.preview;
        var cancel      = params.cancel;
        var cancel_chk  = params.cancel_chk;
        var default_img = params.default_img;
        
        $(input).val('');
        $(preview).attr("src", default_img);
        $(cancel_chk).removeAttr("checked");
        $(cancel).hide();
    }
    
    this.addVendedor = function() {
           var obj = this;
           
           var id_sucursal = $(this.automotora).val();
           
           var email           = $("#vendedor-email")           .val();
           var password        = $("#vendedor-password")        .val();
           var passwordrep     = $("#vendedor-password-rep")    .val();
           var rut             = $("#vendedor-rut")             .val();
           var nombre          = $("#vendedor-nombre")          .val();
           var apellidopaterno = $("#vendedor-apellidopaterno") .val();
           var apellidomaterno = $("#vendedor-apellidomaterno") .val();
           var direccion       = $("#vendedor-direccion")       .val();
           var telefono        = $("#vendedor-telefono")        .val();
           var movil           = $("#vendedor-movil")           .val();
           
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
           if(!movil) {
               mensajeError.push('Móvil');
           }

           if(mensajeError.length) {
               alert("Campos requeridos: " + mensajeError.join(', '));
               return false;
           }
           
           var data = {
               id_sucursal       : id_sucursal,
                       
               email             : email,
               password          : password,
               rut               : rut,
               nombre            : nombre,
               apellidopaterno   : apellidopaterno,
               apellidomaterno   : apellidomaterno,
               direccion         : direccion,
               telefono          : telefono,
               movil             : movil,

               target      : 'vendedor',
               action      : 'add'
           }

           var ajax = new Ajax ({
               url        :  'app/admin/admin-request.php',
               data       :  data,
               type       :  "POST",
               onStart    :  function() {
                    new Loader({
                        container : $("#vendedor-submit-loader")
                    }).start();                 
               },  
               onSuccess  :  function(result) {
                   switch($.trim(result)) {
                       case 'ADD_OK':
                           alert("Vendedor agregado");
                           $.fancybox.close();
                           obj.getViewVendedores();
                           break;
                           
                        case 'ADD_EXISTS':
                            alert("El correo ingresado ya está registrado");
                            break;
                        
                       default:
                           alert("Error al intentar agregar vendedor");
                   }
               },
               onComplete   : function() { 
                   new Loader({
                       container : $("#vendedor-submit-loader")
                   }).stop();                 
                }
                       
           });

           ajax.request();        
    }    

    this.editVendedorForm = function(vendedor) {
        var id_vendedor = vendedor.id;
        
        $.fancybox({
            href : 'app/admin/form_edit_vendedor.php?'+
            'id_vendedor='+ id_vendedor
        });    
    }

    this.editVendedor = function(vendedor) {
           var obj = this;

           var email           = $("#vendedor-email")           .val();
           var email_ant       = $("#vendedor-email-antiguo")   .val();
           var password        = $("#vendedor-password")        .val();
           var passwordrep     = $("#vendedor-password-rep")    .val();
           var rut             = $("#vendedor-rut")             .val();
           var nombre          = $("#vendedor-nombre")          .val();
           var apellidopaterno = $("#vendedor-apellidopaterno") .val();
           var apellidomaterno = $("#vendedor-apellidomaterno") .val();
           var direccion       = $("#vendedor-direccion")       .val();
           var telefono        = $("#vendedor-telefono")        .val();
           var movil           = $("#vendedor-movil")           .val();
           
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
           if(!movil) {
               mensajeError.push('Móvil');
           }

           if(mensajeError.length) {
               alert("Campos requeridos: " + mensajeError.join(', '));
               return false;
           }
           
           var data = {
               id_vendedor       : vendedor.id,
                       
               email             : email,
               email_ant         : email_ant,
               password          : password,
               rut               : rut,
               nombre            : nombre,
               apellidopaterno   : apellidopaterno,
               apellidomaterno   : apellidomaterno,
               direccion         : direccion,
               telefono          : telefono,
               movil             : movil,

               target      : 'vendedor',
               action      : 'edit'
           }

           var ajax = new Ajax ({
               url        :  'app/admin/admin-request.php',
               data       :  data,
               type       :  "POST",
               onStart    :  function() {
                    new Loader({
                        container : $("#vendedor-submit-loader")
                    }).start();                 
               },  
               onSuccess  :  function(result) {
                   switch($.trim(result)) {
                       case 'EDIT_OK':
                           //Mejora actualizar sólo nombre de usuario
                           $("#login-form").load('app/comun/formlogin.php');                           
                           obj.getViewVendedores();
                           alert("Vendedor editado");
                           $.fancybox.close();
                           break;
                           
                        case 'EDIT_EXISTS':
                            alert("El correo ingresado ya está registrado");
                            break;
                            
                       default:
                           alert("Error al intentar editar vendedor");
                   }
               },
               onComplete   : function() { 
                   new Loader({
                       container : $("#vendedor-submit-loader")
                   }).stop();                 
               }
           });

           ajax.request();        
    }    
    
    this.deleteVendedor = function(vendedor) {
        var obj = this;
        
        if (!confirm('¿Está seguro de eliminar al usuario "'+vendedor.nombre+'" ('+vendedor.rut+')')) {
            return false;
        }
        
        var data = {
            id_vendedor : vendedor.id,
            target      : 'vendedor',
            action      : 'delete'
        }
        
        var ajax = new Ajax ({
            url        :  'app/admin/admin-request.php',
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                //loader
            },  
            onSuccess  :  function(result) {
                switch($.trim(result)) {
                    case 'DELETE_OK':
                        alert("Vendedor eliminado");
                        obj.getViewVendedores();
                        break;
                    
                    default:
                        alert("Error al intentar eliminar vendedor");
                }
            }  
        });
        
        ajax.request();        
    }
    
    this.getCiudades = function() {
        var obj = this;
        var id_region = $(this.region).val();
        var file = this.path + "search-data.php";
        
        //todos los campos y valores de búsqueda
        var data = {
            q         : "ciudades",
            id_region : id_region
        };
        
        var ajax = new Ajax ({
            url        :  file,
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                //loader
            },  
            onSuccess  :  function(result) {
                try{
                    result      = $.parseJSON( $.trim(result) );
                    var options = '';
                    
                    $.each(result, function(index, ciudad) {
                        options += '<option class="search-dynamic" value="' + ciudad.id + '">' + ciudad.text + '</option>';
                    });
                    
                    $(obj.ciudad).find(".search-dynamic").remove();
                    $(obj.ciudad).append(options);
                }
                catch(e){
                }        
            },
            onComplete : function() {
                $(obj.ciudad).val('');
                obj.getViewSucursales();
            }
        });
        
        ajax.request();        
    }
    
    this.getViewVendedores = function() {
        var obj = this;
        
        var id_sucursal = $(this.automotora).val();
        var data = { 
            id_sucursal : id_sucursal
        };
        
        var ajax = new Ajax ({
            url        :  'app/admin/admin_vendedores-list.php',
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                obj.loader_vendedores.start();
            },  
            onSuccess  :  function(html) {
                $(obj.vendedores_container).html(html);
            }  
        });

        ajax.request();          
    }
    
    this.getViewSucursales = function() {
        var obj = this;
        
        var id_region = $(this.region).val();
        var id_ciudad = $(this.ciudad).val();
        
        var data = { 
            id_region : id_region,
            id_ciudad : id_ciudad
        };
        
        var ajax = new Ajax ({
            url        :  'app/admin/admin_sucursales-list.php',
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                obj.loader_sucursales.start();
            },  
            onSuccess  :  function(html) {
                $(obj.sucursales_container).html(html);
            }  
        });

        ajax.request();          
    }
    
    this.init = function() {
        this.getViewVendedores();
        this.getViewSucursales();
    }
}
