
Menu = function(params){
    this.path = '/';
    this.file;
    this.container;
    this.menu;
    
    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
    
    this.drawMenu = function() {
        var obj = this;
        
        var file = this.path + this.file;
        
        var ajax = new Ajax ({
            url        :  file,
            type       :  "POST",
            onStart    :  function() {
            },  
            onSuccess  :  function(result){
                $(obj.container).html(result);
            },  
            onComplete :  function() {
            }  
        });
        
        ajax.request();
    }
    
    this.goAutomotora = function() {
        var obj = this;
        
        var file = this.path + 'app/admin/admin_automotora.php';
        
        var ajax = new Ajax ({
            url        :  file,
            type       :  "POST",
            onStart    :  function() {
                //Mejora: Loader propio?
                search.loaderResults.start();
            },  
            onSuccess  :  function(result){
                $(obj.results).html(result);
            },  
            onComplete :  function() {
            }  
        });
        
        ajax.request();
    }
    
    this.create = function() {
        var obj = this;
        //agrega acciones menú
        $.each(this.menu, function(index, item) {
            if ( $.isFunction(item.action) && (item.object).length ) {
                $(item.object).click(function() {
                    $(".menu-item").removeClass("menu-item-selected");
                    $(this).addClass("menu-item-selected");
                    item.action();
                });
            }
        });
    }
    
    this.init = function() {
        this.create();
    }
    
}
