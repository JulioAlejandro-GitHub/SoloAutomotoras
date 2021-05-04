/**
 * @version 3.0
 *      
 * - Opciones disponibles
 * 
 *      @param container {String}           Elemento donde estará la animación. Si no se especifica se ubica en 'body'
 *      @param containerClass {String}      Clase CSS para personalizar la animación
 *      @param containerStyle {String}      Estilo CSS para personalizar la animación
 *      @param containerClear {Boolean}     Especifica si el contenedor donde estará la animación debe ser 'limpiado' para mostrar sólo la animación
 *      
 * - Canvas Loader (Canvas Loader Generator : https://github.com/heartcode/CanvasLoader ; http://heartcode.robertpataki.com/canvasloader/)
 * 
 *      @param setColor {String}            Valor #hexadecimal 
 *      @param setShape {String}        
 *      @param setDiameter {Number}     
 *      @param setDensity {Number}      
 *      @param setRange {Number}        
 *      @param setSpeed {Number}        
 *      @param setFPS {Number}            
 */

Loader = function(params){
    
     this.container;
     this.containerClass  =    '';
     this.containerStyle  =    '';
     this.containerClear  =    true;

     this.setColor        =    '#FA9E11'; 
     this.setShape        =    'spiral';
     this.setDiameter     =     80;
     this.setDensity      =     97;
     this.setRange        =     1;
     this.setSpeed        =     4;
     this.setFPS          =     40;
    
    //Extender atributos
    $.extend(this, params); 
    
    /**************************************************************************/
    
    this.start = function() {
        if ($(this.container).length) { //se especificó contenedor y existe
            if (this.containerClear == true) {
                $(this.container).empty();
            }
            
            var target = this.container;
            var targetID = "loader-container-" + $(this.container).attr("id");
            
            if (!this.containerClass) { 
                this.containerClass = 'loader-container';
            }
        }
        else { //no se especificó contenedor, la animación se ubicará en 'body'
            var target = "body";
            var targetID = "loader-container-body";
            
            if (!this.containerClass) {
                this.containerClass = 'loader-container-body';
            }
        }

        var loadingContainer = '<div id="' + targetID + '" class="'+ this.containerClass +'" style="' + this.containerStyle +'"><div>'; //contenedor animación
        $(target).append(loadingContainer); //se agrega contenedor animacion a contenedor especificado o 'body'
        $("#"+ targetID).empty(); //se asegura que se mostrara una sola animacion para el mismo contenedor

        //permite ocultar de forma manual
        $("#" + targetID).click( function() {
            $(this).remove();
        });
        
        //inicia animación según configuración
        var canvasloader = new CanvasLoader(targetID);
            canvasloader.setColor(this.setColor);
            canvasloader.setShape(this.setShape);
            canvasloader.setDiameter(this.setDiameter);
            canvasloader.setDensity(this.setDensity);
            canvasloader.setRange(this.setRange);
            canvasloader.setSpeed(this.setSpeed);
            canvasloader.setFPS(this.setFPS);

            canvasloader.show();        
    }
    
    this.stop = function() {
        if ( $(this.container).length ) { //se especificó contenedor y existe, se quita su animación
            $("#loader-container-" + $(this.container).attr("id")).remove();
        }
        else {
            if( $("#loader-container-body").length ) {
                $("#loader-container-body").remove();  //no se especificó contenedor, se quita la animación de 'body'
            }
        }
    }
}
