Search = function(params) {    this.path =  '/';           this.file_goCatalogo;    this.file_adminRequest;    this.view      = 'block';    this.guestview;    this.loaderResults;    //Objetos DOM existentes    this.catalogo_results;    this.marca;           this.modelo;          this.tipo;            this.annio_desde;       this.annio_hasta;       this.precio_desde;    this.precio_hasta;    this.region;          this.ciudad;          this.automotora;      this.usado;           this.nuevo;           this.modelo_add_container;    this.modelo_add_nombre;    this.modelo_add_title;    this.onSearch = function() {};    //Extender atributos    $.extend(this, params);    /**************************************************************************/    this.getMarcas = function() {        var obj = this;        var carroceria = $(this.tipo).val();        var file = this.path + "search-data.php";        //todos los campos y valores de búsqueda        var data = {            q             : "marcas",            id_carroceria : carroceria        };        var ajax = new Ajax ({            url        :  file,            data       :  data,            type       :  "POST",            onStart    :  function() {                //loader            },              onSuccess  :  function(result) {                try{                    result      = $.parseJSON( $.trim(result) );                    var options = '';                    $.each(result, function(index, marca) {                        options += '<option class="search-dynamic" value="' + marca.id + '">' + marca.text + '</option>';                    });                    $(obj.marca).find(".search-dynamic").remove();                    $(obj.marca).append(options);                    obj.getModelos();                }                catch(e){                }                    }          });        ajax.request();            }    this.getModelos = function() {        var obj = this;        var id_marca      = $(this.marca).val();        var id_carroceria = $(this.tipo).val();                //alert(id_marca);                var file = this.path + "search-data.php";        //todos los campos y valores de búsqueda        var data = {            q             : "modelos",            id_marca      : id_marca,            id_carroceria : id_carroceria        };        var ajax = new Ajax ({            url        :  file,            data       :  data,            type       :  "POST",            onStart    :  function() {                // loader                // bloquear el select hijo... modelo                $("#busq_modelo").attr('disabled', true);                $('#busq_modelo').children().remove().end().append('<option selected value="0">Buscando...</option>');            },              onSuccess  :  function(result) {                        $('#busq_modelo').children().remove().end().append('<option selected value="">.:: TODOS ::.</option>');                $("#busq_modelo").attr('disabled', false);                                                try{                    result      = $.parseJSON( $.trim(result) );                    var options = '';                    $.each(result, function(index, modelo) {                        options += '<option class="search-dynamic" value="' + modelo.id + '">' + modelo.text + '</option>';                    });                    $(obj.modelo).find(".search-dynamic").remove();                    $(obj.modelo).append(options);                }                catch(e){                }                    }          });        ajax.request();    }    this.getCiudades = function() {        var obj = this;        var id_region = $(this.region).val();        var file = this.path + "search-data.php";        //todos los campos y valores de búsqueda        var data = {            q         : "ciudades",            id_region : id_region        };                var ajax = new Ajax ({            url        :  file,            data       :  data,            type       :  "POST",            onStart    :  function() {                //loader            },              onSuccess  :  function(result) {                try{                    result      = $.parseJSON( $.trim(result) );                    var options = '';                    $.each(result, function(index, ciudad) {                        options += '<option class="search-dynamic" value="' + ciudad.id + '">' + ciudad.text + '</option>';                    });                    $(obj.ciudad).find(".search-dynamic").remove();                    $(obj.ciudad).append(options);                }                catch(e){                }                    }          });        ajax.request();            }    this.getAutomotoras = function() {        var obj = this;        var id_automotora = $(this.automotora).val();        var file = this.path + "search-data.php";        //todos los campos y valores de búsqueda        var data = {            q             : "automotoras",            id_automotora : id_automotora        };        var ajax = new Ajax ({            url        :  file,            data       :  data,            type       :  "POST",            onStart    :  function() {                //loader            },              onSuccess  :  function(result) {                try{                    result      = $.parseJSON( $.trim(result) );                    var options = '';                    $.each(result, function(index, automotora) {                        options += '<option class="search-dynamic" value="' + automotora.id + '">' + automotora.text + '</option>';                    });                    $(obj.automotora).find(".search-dynamic").remove();                    $(obj.automotora).append(options);                }                catch(e){                }                    }          });        ajax.request();            }    this.setCondicion = function(objHTML) {        if ( $(objHTML).hasClass("onpress") ) {            $(objHTML).removeClass("onpress").data("value", 0);        }        else {            $(objHTML).addClass("onpress").data("value", 1);        }    }    this.setPrecio = function(precio) {        var precio_desde = $(this.precio_desde);        var precio_hasta = $(this.precio_hasta);        if ( parseInt($(precio_desde).val()) > parseInt($(precio_hasta).val()) ) {            $(precio_desde).val(precio);            $(precio_hasta).val(precio);        }    }    this.setAnnio = function(annio) {        var annio_desde = $(this.annio_desde);        var annio_hasta = $(this.annio_hasta);        if ( parseInt($(annio_desde).val()) > parseInt($(annio_hasta).val()) ) {            $(annio_desde).val(annio);            $(annio_hasta).val(annio);        }    }    this.goView = function(view) {        this.view      = view;        this.guestview = null;        this.goCatalog();    }    this.goGuestView = function(view) {        this.guestview = view;        this.goCatalog();    }    this.setAutomotora = function(id_automotora) {        $(this.automotora).val(id_automotora);        this.goCatalog();    }    this.goCatalog = function() {        var obj = this;        var file = this.path + this.file_goCatalogo;        //todos los campos y valores de búsqueda        var data = {            busq_marca          : (this.marca)        .val(),            busq_modelo         : (this.modelo)       .val(),            busq_tipo           : (this.tipo)         .val(),            busq_annio_desde    : (this.annio_desde)  .val(),            busq_annio_hasta    : (this.annio_hasta)  .val(),            busq_precio_desde   : (this.precio_desde) .val(),            busq_precio_hasta   : (this.precio_hasta) .val(),            busq_region         : (this.region)       .val(),            busq_ciudad         : (this.ciudad)       .val(),            busq_automotora     : (this.automotora)   .val(),            usado               : (this.usado)        .data("value"),            nuevo               : (this.nuevo)        .data("value"),            view                     : (this.view),            guestview                : (this.guestview)        };        var ajax = new Ajax ({            url        :  file,            data       :  data,            type       :  "GET",            onStart    :  function() {                obj.loaderResults.start();            },              onSuccess  :  function(result) {                $(obj.catalogo_results).html(result);            },              onComplete :  function() {                obj.loaderResults.stop();            }          });        ajax.request();        if ( $.isFunction(this.onSearch) ) {            this.onSearch(data); //acción personalizada        }                             }    this.toggleAddModelo = function() {        var modelo = this.modelo;        var modelo_add_container = this.modelo_add_container;        var modelo_add_title     = this.modelo_add_title;        var modelo_add_nombre    = this.modelo_add_nombre;        if ( $(modelo_add_container).is(":visible") ) {            $(modelo).show();            $(modelo_add_container).hide();            $(modelo_add_title).html('<img class="add-icon" src="include/img/add-icon.png">');            $(modelo_add_nombre).val('');        }        else {            $(modelo).hide();            $(modelo_add_container).show();            $(modelo_add_title).html('Cancelar');        }    }    this.addModelo = function() {        var obj = this;        var file = this.path + this.file_adminRequest;        var tipo  = $(this.tipo).val();        var marca = $(this.marca).val();        var modelo_nombre = $(this.modelo_add_nombre).val();//        if (!tipo) { //            alert("Seleccione carrocería");//            return false;//        }        if (!marca) {             alert("Seleccione marca");            return false;        }                if ( !$.trim(modelo_nombre) ) {             alert("Escriba nombre del modelo");            return false;        }        var data = {            id_carroceria : tipo,            id_marca      : marca,            nombre        : modelo_nombre,            target      : 'modelo',            action      : 'add'                    };        var ajax = new Ajax ({            url        :  file,            data       :  data,            type       :  "POST",            onStart    :  function() {                //obj.loaderResults.start();            },              onSuccess  :  function(result) {                result = $.trim(result);                switch(result) {                    case 'ADD_OK':                        alert('Modelo "'+modelo_nombre+'" agregado');                        obj.toggleAddModelo();                        obj.getModelos();                        break;                    default:                        alert('Error al intentar agregar el modelo "'+modelo_nombre+'"');                        break;                }                //$(obj.catalogo_results).html(result);            },              onComplete :  function() {                //obj.loaderResults.stop();            }          });        ajax.request();    }    this.setAttr = function(attr) {        $.extend(this, attr);    }    this.init = function () {        this.goCatalog();    }}