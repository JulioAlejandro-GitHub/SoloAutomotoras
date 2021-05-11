
Session = function(params){

    this.path      =  '/';       
    this.loaderLogin;
    
    //Objetos DOM existentes
    this.container_login;
    this.username;
    this.password;
    this.message_error;
    
    this.onLogin      = function() {};
    this.onLogout     = function() {};

    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
       
    this.login = function(){
        var obj = this;
        
        var username = $(this.username).val();
        var password = $(this.password).val();
        var message = "";
        
        if (!username || !password) {
            message = "Ingrese usuario y contraseña 1";
            $(obj.message_error).text(message).css({ "display" : "block" });    
            return false;
        }
        
        var file = this.path + 'app/admin/login.php';
        
        var data = {
            username : username,
            password : password
        };
        
        var ajax = new Ajax ({
            url        :  file,
            data       :  data,
            type       :  "POST",
            onStart    :  function() {
                $(obj.message_error).hide();
                obj.loaderLogin.start();
            },  
            onSuccess  :  function(result) {
                var result  = $.trim(result);
                
                console.log('result');
                console.log(result);
                
                switch(result) {
                    case 'LOGIN_ERROR':
                        message = "Usuario y/o contraseña incorrecta";
                        $(obj.message_error).text(message).css({ "display" : "block" });
                        break;
                    
                    case 'LOGIN_ADMIN_OK': case 'LOGIN_USER_OK':
                        if ( $.isFunction(obj.onLogin) ) {
                            obj.onLogin();
                        }                        
                        $(obj.container_login).load(obj.path + 'app/comun/formlogout.php');
                        break;
                        
                    default:
                        message = "Error al intentar iniciar sesión";
                        $(obj.message_error).text(message).css({ "display" : "block" });
                }
            },
            onComplete : function(){
                obj.loaderLogin.stop();
            }
        });
        
        ajax.request();           
    }
    
    this.logout = function() {
        var obj = this;
        
        var file = this.path + 'app/admin/logout.php';
        
        var message = "";
        
        var ajax = new Ajax ({
            url        :  file,
            type       :  "POST",
            onStart    :  function() {
                $(obj.message_error).hide();
                obj.loaderLogin.start();
            },  
            onSuccess  :  function(result) {
                var result  = $.trim(result);
                
                switch(result) {
                    
                    case 'LOGOUT_OK':
                        $(obj.container_login).load(obj.path + 'app/comun/formlogin.php');
                        if ( $.isFunction(obj.onLogout) ) {
                            obj.onLogout();
                        }                        
                        break;
                        
                    default:
                        message = "Error al intentar cerrar sesión";
                        $(obj.message_error).text(message).css({ "display": "block" });
                }
            },
            onComplete : function(){
                obj.loaderLogin.stop();
            }
        });
        
        ajax.request();        
    }
    
    this.create = function() {
        var obj = this;
        
        $(this.username).keyup(function(event){
            if(event.which == 13){ //Enter
                obj.login();
            }
        });
        
        $(this.password).keyup(function(event){
            if(event.which == 13){ //Enter
                obj.login();
            }
        });
    }
    
    this.init = function() {
        this.create();
    }
    
}