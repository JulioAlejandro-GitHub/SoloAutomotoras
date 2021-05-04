
var search = new Search({
    path               : '',
    file_goCatalogo    : 'catalogo.php',
    view               : 'block',
    catalogo_results   : $("#catalogo-resultados"),
    loaderResults      : new Loader({
//        container       : $("#catalogo-resultados"),
//        containerStyle  : "position: relative; top:150px"
    }),   
    
    tipo             : $("#busq_tipo"),      
    marca            : $("#busq_marca"),       
    modelo           : $("#busq_modelo"),      
    annio_desde      : $("#busq_annio_desde"),   
    annio_hasta      : $("#busq_annio_hasta"),   
    precio_desde     : $("#busq_precio_desde"),
    precio_hasta     : $("#busq_precio_hasta"),
    region           : $("#busq_region"),      
    ciudad           : $("#busq_ciudad"),      
    automotora       : $("#busq_automotora"),  
    usado            : $("#search-usado"),
    nuevo            : $("#search-nuevo")    
});

search.init();
