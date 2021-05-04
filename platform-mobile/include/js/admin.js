
var admin = new Admin({
        path                 : "",
        
        sucursales_container : $("#admin-sucursales-container"),
        vendedores_container : $("#admin-vendedores-container"),
        automotora           : $("#admin-automotora"),
        region               : $("#admin-sucursal-region"),
        ciudad               : $("#admin-sucursal-ciudad"),
        
        loader_sucursales    : new Loader({
            container : $("#admin-sucursales-container"),
            containerStyle  : "position: relative; top:50px"
        }),   
        
        loader_vendedores    : new Loader({
            container : $("#admin-vendedores-container"),
            containerStyle  : "position: relative; top:50px"
        })
    });

    admin.init();
