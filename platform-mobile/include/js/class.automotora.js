
Automotora = function(params){
    this.path = '/';
    this.section;
    
    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
    
    this.load = function() {
        var obj = this;
        
        //carga secciones
        $.each(this.section, function(index, item) {
            var file = obj.path + item.file;

            var ajax = new Ajax ({
                url        :  file,
                type       :  "POST",
                onStart    :  function() {
                },  
                onSuccess  :  function(result){
                    $(item.container).html(result);
                },  
                onComplete :  function() {
                }  
            });

            ajax.request();
        });
    }
    
    this.init = function() {
        this.load();
    }
    
}
