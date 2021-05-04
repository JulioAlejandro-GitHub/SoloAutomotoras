function load_url(url, id) {
    $.ajax({
        type:   "GET",
        url:    url,
        success: function(datos){
            $('#'+id).html(datos);
        },
        beforeSend: function(){
            //$.showLoading({ container: id, containerStyle: 'margin-top: 120px'});
        }, 
        complete: function(){
            $('[title]').tipTip({
                delay: 600,
                defaultPosition: 'auto'
            });
            $("#tiptip_holder").hide();
            //$(".gmnoprint").hide();
        }
    });
}
function trim(str) {
    return $.trim(str);
}
function encUri(str) {
    return encodeURIComponent(str);
}
function validarEmail(email) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(email);
    if(!reg) {
        return false;
    }
    return true;
}

function getModelo(){
    var edt_sel_marca = trim($("#edt_sel_marca").find(':selected').val());
    if (edt_sel_marca == '') {edt_sel_marca = 0;}
    load_url("getModelo.php?edt_sel_marca="+edt_sel_marca, 'div_sel_modelo');
}

function editar_ficha(id) {
    var url = "app/admin/editar_ficha.php?id="+id;
    document.getElementById('autostartfancybox').href=url;
    $("#autostartfancybox").fancybox(fancyboxOptions).trigger('click');
}
function add_ficha() {
    var url = "app/admin/add_ficha.php";
    document.getElementById('autostartfancybox').href=url;
    $("#autostartfancybox").fancybox(fancyboxOptions).trigger('click');
}
function elimina_ficha(id_vehiculo) {
    if (confirm("¿Eliminar Ficha?")) {
        $.ajax({
            type:   "POST",
            url:    "app/admin/elimina_ficha.php",
            data: {
                    id_vehiculo : id_vehiculo
            },
            success: function(res){
                res = trim(res);
                if (res == 'ok') {
                    //alert("Ficha Eliminada");
                    $("#cuadro" + id_vehiculo).hide('slow', function(){ $("#cuadro" + id_vehiculo).remove() });
                }else{
                    alert("Error al Eliminar");
                }
                //document.getElementById('cuadro'+id_vehiculo).style.display = 'none';
            },
            beforeSend: function(){
                //$.showLoading({ container: id, containerStyle: 'margin-top: 120px'});
            },
            complete: function(){
            },
            error: function(res){
                res = trim(res);
                alert("Error al Eliminar");
            }
        });
    }
}
function ver_ficha(id) {
//    var url = "ficha.php?id="+id;
//    document.getElementById('autostartfancybox').href=url;
//    $("#autostartfancybox").fancybox().trigger('click');
    
    $.fancybox.open({
        href: 'ficha.php?id=' + id,
        type: 'ajax',
        padding: 5
    });
    
}
function admin_ver_ficha(id) {
    var url = "ficha.php?id="+id;
    document.getElementById('autostartfancybox').href=url;
    $("#autostartfancybox").fancybox().trigger('click');
}
function subir_ficha () {
    var url = "subir_ficha.php?f=1";
    load_url(url, 'div_fichas');
}
function admin_automotora() {
    var url = 'admin_automotora.php';
    load_url(url, 'all_content');
}
function contactar_automotora() {
    var nombre   = trim(document.getElementById('nombre').value);
    var email    = trim(document.getElementById('email').value);
    var telefono = trim(document.getElementById('telefono').value);
    var mensaje  = trim(document.getElementById('mensaje').value);
    var automotora_nombre  = trim(document.getElementById('automotora_nombre').value);
    var automotora_email   = trim(document.getElementById('automotora_email').value);
    var vehiculo_id = document.getElementById("vehiculo_id").value;    

    if (!validarEmail(email)) {
        email = '';
    }
    
    var mensaje_error = '';
    if (nombre   == '') {mensaje_error += 'Nombre\n';}
    if (email    == '') {mensaje_error += 'Email\n';}
    if (telefono == '') {mensaje_error += 'Teléfono\n';}
    if (mensaje  == '') {mensaje_error += 'Mensaje\n';}
    
    if (mensaje_error != '') {
        alert('Ingrese los siguientes datos:\n\n' + mensaje_error);
    }else{
        var url = "send_contacto.php?";
        url+= "&nombre="   + encUri(nombre);
        url+= "&email="    + encUri(email);
        url+= "&telefono=" + encUri(telefono);
        url+= "&mensaje="  + encUri(mensaje);
        
        url+= "&automotora_nombre="  + encUri(automotora_nombre);
        url+= "&automotora_email="   + encUri(automotora_email);
        
        url+= "&info="       + document.getElementById("info").checked;
        url+= "&testdrive="  + document.getElementById("testdrive").checked;
        url+= "&id_vehiculo="+ vehiculo_id;
        
        //load_url(url, 'bot_send_contact');
        
        var ajax = new Ajax ({
            url        :  url,
            type       :  "GET",
            onStart    :  function() {
                //loader
            },  
            onSuccess  :  function(result) {
                var result = $.trim(result);
                
                //alert(result);
                
                if (result == 'SEND_OK') {
                    alert("Mensaje enviado");
                }
                else {
                    alert("Error al intentar enviar mensaje");
                }
            }  
        });
        
        ajax.request();        
        
    }
    return false;
}
function buscar_fichas(view) {
    $('#busq_marca').val();
    var busq_marca          = trim($('#busq_marca').val());
    var busq_modelo         = trim($('#busq_modelo').val());
    var busq_tipo           = trim($('#busq_tipo').val());
    var busq_ano_desde      = trim($('#busq_ano_desde').val());
    var busq_ano_hasta      = trim($('#busq_ano_hasta').val());
    var busq_precio_desde   = trim($('#busq_precio_desde').val());
    var busq_precio_hasta   = trim($('#busq_precio_hasta').val());
    var busq_region         = trim($('#busq_region').val());
    var busq_ciudad         = trim($('#busq_ciudad').val());
    var busq_automotora     = trim($('#busq_automotora').val());
    
    //var url = "block_view.php?f=1";
    var url = "catalogo.php?view=" + view;
    url+= "&busq_marca="         + encUri(busq_marca);
    url+= "&busq_modelo="        + encUri(busq_modelo);
    url+= "&busq_tipo="          + encUri(busq_tipo);
    url+= "&busq_ano_desde="     + encUri(busq_ano_desde);
    url+= "&busq_ano_hasta="     + encUri(busq_ano_hasta);
    url+= "&busq_precio_desde="  + encUri(busq_precio_desde);
    url+= "&busq_precio_hasta="  + encUri(busq_precio_hasta);
    url+= "&busq_region="        + encUri(busq_region);
    url+= "&busq_ciudad="        + encUri(busq_ciudad);
    url+= "&busq_automotora="    + encUri(busq_automotora);
    //alert(url);
    load_url(url, 'div_fichas');
}
function admin_buscar_fichas(view) {
    $('#busq_marca').val();
    var busq_marca          = trim($('#busq_marca').val());
    var busq_modelo         = trim($('#busq_modelo').val());
    var busq_tipo           = trim($('#busq_tipo').val());
    var busq_ano_desde      = trim($('#busq_ano_desde').val());
    var busq_ano_hasta      = trim($('#busq_ano_hasta').val());
    var busq_precio_desde   = trim($('#busq_precio_desde').val());
    var busq_precio_hasta   = trim($('#busq_precio_hasta').val());
    var busq_region         = trim($('#busq_region').val());
    var busq_ciudad         = trim($('#busq_ciudad').val());
    //var busq_automotora     = trim($('#busq_automotora').val());
    
    //var url = "block_view.php?f=1";
    var url = "admin_catalogo.php?view=" + view;
    url+= "&busq_marca="         + encUri(busq_marca);
    url+= "&busq_modelo="        + encUri(busq_modelo);
    url+= "&busq_tipo="          + encUri(busq_tipo);
    url+= "&busq_ano_desde="     + encUri(busq_ano_desde);
    url+= "&busq_ano_hasta="     + encUri(busq_ano_hasta);
    url+= "&busq_precio_desde="  + encUri(busq_precio_desde);
    url+= "&busq_precio_hasta="  + encUri(busq_precio_hasta);
    url+= "&busq_region="        + encUri(busq_region);
    url+= "&busq_ciudad="        + encUri(busq_ciudad);
    //url+= "&busq_automotora="    + encUri(busq_automotora);
    //alert(url);
    load_url(url, 'div_fichas');
}

function add_cuadro(id_vehiculo) {
    //alert('add_cuadro    '+id_vehiculo);
        $.ajax({
            type:   "POST",
            url:    "app/admin/add_cuadro.php",
            data: {
                    id_vehiculo   : id_vehiculo
            },
            success: function(res){
                res = trim(res);
                
                // contenedor_admin_catalogo +++ res
                $("#contenedor_admin_catalogo").append(res);
                
                return true;
            },
            beforeSend: function(){
                //$.showLoading({ container: id, containerStyle: 'margin-top: 120px'});
            },
            complete: function(){
            },
            error: function(res){
                res = trim(res);
                //alert('*****cuadro ERRRORORRRRR = ' + res);
                
                //res = '<div class="block_post_th" id="1"><img onclick="ver_ficha(1);" src="img/catalog/a_215x155.jpg" width="215" height="155" alt=""><h3>utyu</h3><p>1000 <img src="img/cerok.png" alt="0 km" class="cerok"></p><p class="price">0</p><div class="dealerlink"><div class="rgt"><span href="#" id="img_estado1" onclick="fdespublicar(1);" title="Despublicar" class="pub_icn publicado"></span><span href="#" onclick="elimina_ficha(1);" class="del_icn"></span><span href="#" class="edit_icn" onclick="editar_ficha(1);"></span></div><div class="date_post_th">1</div></div><div class="label_th sdsds">cartel</div></div>';
                //$("#contenedor_admin_catalogo").append(res);
                
                return false;
            }
        });
}

function guardar_ficha(id_vehiculo) {
    valida_ficha(id_vehiculo);
}
function publicar_ficha(id_vehiculo) {
    valida_ficha(id_vehiculo);
    fpublicar(id_vehiculo);
}
function fadd_ficha() {
    if (!valida_ficha()) {
        //alert("Error al Actualizar");
    }
}



function valida_ficha(id_vehiculo) {
    /*
     *se puede agregar solo algunos datos y luego completar la ficha antes de publicar
     * edt_sel_marca
     */
    /********************* PUBLICACION **********************/
    var edt_radio_publicacion_tipo   = $('[name="edt_radio_publicacion_tipo"]:checked').val();
    var edt_sel_publicacion_etiqueta = trim($("#edt_sel_publicacion_etiqueta").find(':selected').val());
    /********************************************************/
    
    /********************* DATOS   **************************/
    var edt_sel_carroceria  = trim($("#edt_sel_carroceria").find(':selected').val());
    var edt_sel_marca       = trim($("#edt_sel_marca").find(':selected').val());
    var edt_sel_modelo      = trim($("#edt_sel_modelo").find(':selected').val());
    
    //alert("marca = [" + edt_sel_marca + "]          modelo = [" + edt_sel_modelo + "]");
    
    var edt_txt_patente     = trim($("#edt_txt_patente").val());
    var edt_txt_precio      = trim($("#edt_txt_precio").val());
    var edt_txt_ano         = trim($("#edt_txt_ano").val());
    
    var edt_txt_kilometros  = trim($("#edt_txt_kilometros").val());
    var edt_txt_motor_cc    = trim($("#edt_txt_motor_cc").val());
    var edt_sel_transmision = trim($("#edt_sel_transmision").find(':selected').val());
    var edt_sel_combustible = trim($("#edt_sel_combustible").find(':selected').val());
    //var edt_txt_airbags     = trim($("#edt_txt_airbags").val());
    var edt_txt_color       = trim($("#edt_txt_color").val());
    /********************************************************/
    
    
    /************* EQUIPO  *******************************/
    var equ = '';
    $("#div_sector_equipo input").each(function () {
        var id = $(this).attr('id');
        if (this.id.match(/edt_num_/)) {
            id = id.replace('edt_num_','');
            equ += id + '|' + $(this).val() + ';';
        }
        if (this.id.match(/edt_txt_/)) {
            if ($(this).val()) {
                id = id.replace('edt_txt_','');
                equ += id + '|' + $(this).val() + ';';
            }
        }
        if (this.id.match(/edt_opt_/)) {
            if($(this).is(':checked')) {
                id = id.replace('edt_opt_','');
                equ += id + ';';
            }
        }
        if (this.id.match(/edt_chk_/)) {
            if($(this).is(':checked')) {
                id = id.replace('edt_chk_','');
                equ += id + ';';
            }
        }
    });
    $("#div_sector_equipo select").each(function () { //conjunto
        if($("#" + id).find(':selected').val() != '') {
            var id = $(this).attr('id');
            equ += $("#" + id).find(':selected').val() + ';';
        }
    });
    //alert(equ);
    /************* EQUIPO  *******************************/
    
    
    /************* SEGURIDAD  *******************************/
    var seg = '';
    $("#div_sector_seguridad input").each(function () {
        var id = $(this).attr('id');
        if (this.id.match(/edt_num_/)) {
            id = id.replace('edt_num_','');
            seg += id + '|' + $(this).val() + ';';
        }
        if (this.id.match(/edt_txt_/)) {
            if ($(this).val()) {
                id = id.replace('edt_txt_','');
                seg += id + '|' + $(this).val() + ';';
            }
        }
        if (this.id.match(/edt_opt_/)) {
            if($(this).is(':checked')) {
                id = id.replace('edt_opt_','');
                seg += id + ';';
            }
        }
        if (this.id.match(/edt_chk_/)) {
            if($(this).is(':checked')) {
                id = id.replace('edt_chk_','');
                seg += id + ';';
            }
        }
    });
    $("#div_sector_seguridad select").each(function () {
        if($("#" + id).find(':selected').val() != '') {
            var id = $(this).attr('id');
            seg += $("#" + id).find(':selected').val() + ';';
        }
    });
    //alert("seg:"+seg);
    /************* SEGURIDAD  *******************************/
    
    var msj_datos = '';
//    var msj_equipament = '';
//    var msj_seguridad = '';
    var msj_publicacion = '';
    
    /********************* DATOS   **************************/
    if (edt_sel_carroceria  == '') {msj_datos+= 'Carrocería\n';}
    if (edt_sel_marca       == '') {msj_datos+= 'Marca\n';}
    if (edt_sel_modelo      == '') {msj_datos+= 'Modelo\n';}
//    if (edt_txt_patente     == '') {msj_datos+= 'Patente\n';}
//    if (edt_txt_precio      == '') {msj_datos+= 'Precio\n';}
    if (edt_txt_ano         == '') {
        msj_datos+= 'Año\n';
    }else{
        if (isNaN(edt_txt_ano)) {
            msj_datos+= 'Año - debe ser un número.\n';
        }else{
            if (edt_txt_ano < 1920) {
                msj_datos+= 'Año - debe ser mayor a 1920.\n';
            }
            if (edt_txt_ano > 2014) {
                msj_datos+= 'Año - debe ser menor a 2014.\n';
            }
        }
    }

//    if (edt_txt_kilometros  == '') {msj_datos+= 'Kilometraje\n';}
//    if (edt_txt_motor_cc    == '') {msj_datos+= 'Motor CC\n';}
//    if (edt_sel_transmision == '') {msj_datos+= 'Transmisión\n';}
    if (edt_sel_combustible == '') {msj_datos+= 'Combustible\n';}
//    if (edt_txt_color       == '') {msj_datos+= 'Color\n';}
    /********************************************************/
    
    /********************* PUBLICACION **********************/
//    if (edt_radio_publicacion_tipo   == '') {msj_publicacion+= 'Destacado\n';}
//    if (edt_sel_publicacion_etiqueta == '') {msj_publicacion+= 'Etiqueta especial\n';}
    /********************************************************/
    
    if (
            msj_datos       != '' ||
            msj_publicacion != ''
       ) {
        var p = "---------------\n";
        alert("Ingrese los siguientes datos: \n\n" + p + msj_datos + p + msj_publicacion);
        return false;
    }else{
        
        /********************* DATOS   **************************/
        msj_datos+= 'edt_sel_marca: ['+edt_sel_marca+']\n';
        msj_datos+= 'edt_sel_modelo: ['+edt_sel_modelo+']\n';
        msj_datos+= 'edt_txt_patente: ['+edt_txt_patente+']\n';
        msj_datos+= 'edt_txt_precio: ['+edt_txt_precio+']\n';
        msj_datos+= 'edt_txt_ano: ['+edt_txt_ano+']\n';
        msj_datos+= 'edt_sel_carroceria: ['+edt_sel_carroceria+']\n';
        msj_datos+= 'edt_txt_kilometros: ['+edt_txt_kilometros+']\n';
        msj_datos+= 'edt_txt_motor_cc: ['+edt_txt_motor_cc+']\n';
        msj_datos+= 'edt_sel_transmision: ['+edt_sel_transmision+']\n';
        msj_datos+= 'edt_sel_combustible: ['+edt_sel_combustible+']\n';
        //msj_datos+= edt_txt_airbags+'\n';
        msj_datos+= 'edt_txt_color: ['+edt_txt_color+']\n';
        msj_datos+= 'equ: ['+equ+']\n';
        msj_datos+= 'seg: ['+seg+']\n';
        msj_datos+= 'edt_radio_publicacion_tipo: ['+edt_radio_publicacion_tipo+']\n';
        //alert(msj_datos);
        /********************************************************/
        
        $.ajax({
            type:   "POST",
            url:    "app/admin/admin_add_udp_ficha.php",
            data: {
                    /********************************************************/
                    id_vehiculo   : id_vehiculo,
                    /********************************************************/

                    /********************* DATOS   **************************/
                    edt_sel_marca       : edt_sel_marca,
                    edt_sel_modelo      : edt_sel_modelo,
                    edt_txt_patente     : edt_txt_patente,

                    edt_txt_precio      : edt_txt_precio,
                    edt_txt_ano         : edt_txt_ano,
                    edt_sel_carroceria  : edt_sel_carroceria,
                    edt_txt_kilometros  : edt_txt_kilometros,
                    edt_txt_motor_cc    : edt_txt_motor_cc,
                    edt_sel_transmision : edt_sel_transmision,
                    edt_sel_combustible : edt_sel_combustible,
                    //edt_txt_airbags     : edt_txt_airbags,
                    edt_txt_color       : edt_txt_color,
                    /********************************************************/

                    /*****************  EQUIPAMENT **************************/
                    edt_equipament : equ,
                    /********************************************************/

                    /************* SEGURIDAD  *******************************/
                    edt_seguridad : seg,
                    /********************************************************/

                    /********************* PUBLICACION **********************/
                    edt_radio_publicacion_tipo   : edt_radio_publicacion_tipo,
                    edt_sel_publicacion_etiqueta : edt_sel_publicacion_etiqueta
                    /********************************************************/
            },
            success: function(res){
                res = trim(res);
                
                //alert("[" + res + ']');
                
                if (! id_vehiculo) { // upd
                    id_vehiculo = res;
                    
                    // crea cuadro
                    //add_cuadro(id_vehiculo);
                    search.goCatalog();
                    
                }else if (res == 'ok') {
                    //actualizar html vehiculo..
//                    if (document.getElementById('cuadro'+id_vehiculo)) {
//                        load_url("app/admin/admin_catalogo.php?id_vehiculo="+id_vehiculo, 'cuadro'+id_vehiculo);
//                    }
                    search.goCatalog();
                }
//                admin_buscar_fichas();
                $.fancybox.close();
                alert("Publicación correcta.");
                
                return false;
            },
            beforeSend: function(){
                //$.showLoading({ container: id, containerStyle: 'margin-top: 120px'});
            },
            complete: function(){
            },
            error: function(res){
                res = trim(res);
                return false;
            }
        });
        return true;
    }
}

function fpublicar(id_vehiculo) {
    
    id_vehiculo = trim(id_vehiculo);
    
    //validar datos antes de publicar...;
    if (id_vehiculo == '') {
        alert("Error al Actualizar");
    }else{
        $.ajax({
            type:   "POST",
            url:    "app/admin/publicar.php",
            data: {
                    id_vehiculo : id_vehiculo
            },
            success: function(res){
                res = trim(res);
                if (res == 'ok') {
                    alert("Publicación correcta.");
                    search.goCatalog();
                    //$("#img_estado"+id_vehiculo).addClass("publicado");
                }else{
                    alert("Error al Actualizar");
                }
            },
            beforeSend: function(){
                //$.showLoading({ container: id, containerStyle: 'margin-top: 120px'});
            },
            complete: function(){
            },
            error: function(res){
                res = trim(res);
            }
        });
    }
}
function fdespublicar(id_vehiculo) {
    id_vehiculo = trim(id_vehiculo);
    if (id_vehiculo == '') {
        alert("Error");
    }else{
        $.ajax({
            type:   "POST",
            url:    "app/admin/despublicar.php",
            data: {
                    id_vehiculo : id_vehiculo
            },
            success: function(res){
                res = trim(res);
                if (res == 'ok') {
                    alert("Despublicación correcta.");
                    search.goCatalog();
                    //$("#img_estado"+id_vehiculo).removeClass("publicado");
                }else{
                    alert("Error al Actualizar");
                }
            },
            beforeSend: function(){
                //$.showLoading({ container: id, containerStyle: 'margin-top: 120px'});
            },
            complete: function(){
            },
            error: function(res){
                res = trim(res);
            }
        });
    }
}

function enlaceregion() {
}