
Ajax = function(params){
    
    this.url       =  "";     //URL solicitud
    this.data      =  {};     //Datos a enviar
    this.type      =  "POST"; //Tipo solicitud
    
    this.onStart     =  function(){};     //Acción al iniciar
    this.onComplete  =  function(){};     //Acción al terminar
    this.onError     =  function(){};     //Acción cuando ocurrió un error al intentar
    this.onSuccess   =  function(data){}; //Acción al recibir respuesta
    
    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
       
    this.request = function(){
        var obj = this;
        
        var request  =  $.ajax({
                            url         :  obj.url,
                            data        :  obj.data,
                            type        :  obj.type,
                            beforeSend  : function(){
                                if( $.isFunction(obj.onStart) ){
                                    obj.onStart();
                                }
                            }
                        });

        request.always(function(){
            if( $.isFunction(obj.onComplete) ){
                obj.onComplete();
            }            
        });

        request.fail(function(){
            if( $.isFunction(obj.onError) ){
                obj.onError();
            }                
        });

        request.done(function(data){
            if( $.isFunction(obj.onSuccess) ){
                obj.onSuccess(data);
            }                
        });         
    }       
}
