<?php
/***************************************/
require_once 'app/comun/config.php';
require_once 'app/comun/Logger.php';
require_once 'app/comun/BD.php';
require_once 'app/comun/utiles.php';
/***************************************/

$CAT    = new Catalogo();
$Logger = new Logger(LOG_NOMBRE);

$id_vehiculo = trim($_GET['id']);


$Logger->write_log("******** ficha.php ***************");
$Logger->write_log("sumContadorFicha --> [$id_vehiculo]");
$ret = $CAT->sumContadorFicha($id_vehiculo);
$Logger->write_log("                 <-- [$ret]");


$getFicha = $CAT->getListado(array(
    'VEHICULO_ID_VEHICULO' => $id_vehiculo
));
$row = $getFicha->fetch_assoc();

$id_automotora                  = trim($row['AUTOMOTORA_ID_AUTOMOTORA']);
$automotora_id_matriz           = trim($row['AUTOMOTORA_ID_MATRIZ']);
$automotora_id_ciudad           = trim($row['AUTOMOTORA_ID_CIUDAD']);
$automotora_rut                 = trim($row['AUTOMOTORA_RUT']);
$automotora_nombre              = trim($row['AUTOMOTORA_NOMBRE']);
$automotora_telefono            = trim($row['AUTOMOTORA_TELEFONO']);
$automotora_email               = trim($row['AUTOMOTORA_EMAIL']);
$automotora_fax                 = trim($row['AUTOMOTORA_FAX']);
$automotora_razon_social        = trim($row['AUTOMOTORA_RAZON_SOCIAL']);
$automotora_img                 = trim($row['AUTOMOTORA_IMG']);
$automotora_url                 = trim($row['AUTOMOTORA_URL']);    
$automotora_direccion           = trim($row['AUTOMOTORA_DIRECCION']);
$automotora_horario_lun_vie     = trim($row['AUTOMOTORA_HORARIO_LUN_VIE']);
$automotora_horario_sab         = trim($row['AUTOMOTORA_HORARIO_SAB']);
$automotora_horario_dom         = trim($row['AUTOMOTORA_HORARIO_DOM']);  
$automotora_mapa                = trim($row['AUTOMOTORA_MAPA']);  
$automotora_mapa_array          = explode(",", $automotora_mapa);
$automotora_lat                 = $automotora_mapa_array[0];  
$automotora_lng                 = $automotora_mapa_array[1];  
$automotora_estado              = trim($row['AUTOMOTORA_ESTADO']);
$automotora_fecha_ingreso       = trim($row['AUTOMOTORA_FECHA_INGRESO']);
$automotora_fecha_modificacion  = trim($row['AUTOMOTORA_FECHA_MODIFICACION']);


$vendedor_id_automotora         = trim($row['VENDEDOR_ID_AUTOMOTORA']);
$vendedor_id_vendedor           = trim($row['VENDEDOR_ID_VENDEDOR']);
$vendedor_nombres               = trim($row['VENDEDOR_NOMBRE']);
$vendedor_apellido_paterno      = trim($row['VENDEDOR_APELLIDO_PATERNO']);
$vendedor_apellido_materno      = trim($row['VENDEDOR_APELLIDO_MATERNO']);
$vendedor_rut                   = trim($row['VENDEDOR_RUT']);
$vendedor_email                 = trim($row['VENDEDOR_EMAIL']);
$vendedor_password              = trim($row['VENDEDOR_PASSWORD']);
$vendedor_telefono              = trim($row['VENDEDOR_TELEFONO']);
$vendedor_movil                 = trim($row['VENDEDOR_MOVIL']);
$vendedor_direccion             = trim($row['VENDEDOR_DIRECCION']);
$vendedor_fecha_ingreso         = trim($row['VENDEDOR_FECHA_INGRESO']);
$vendedor_fecha_modificacion    = trim($row['VENDEDOR_FECHA_MODIFICACION']);
$vendedor_tipo                  = trim($row['VENDEDOR_TIPO']);

$vehiculo_id_vehiculo           = trim($row['VEHICULO_ID_VEHICULO']);
$vehiculo_id_marca              = trim($row['VEHICULO_ID_MARCA']);
$vehiculo_id_vendedor           = trim($row['VEHICULO_ID_VENDEDOR']);
$vehiculo_id_ciudad             = trim($row['VEHICULO_ID_CIUDAD']);
$vehiculo_modelo                = trim($row['VEHICULO_MODELO']);
$vehiculo_patente               = trim($row['VEHICULO_PATENTE']);
$vehiculo_annio                 = trim($row['VEHICULO_ANNIO']);
$vehiculo_kilometros            = trim($row['VEHICULO_KILOMETROS']);
$vehiculo_precio                = trim($row['VEHICULO_PRECIO']);
$vehiculo_descripcion           = trim($row['VEHICULO_DESCRIPCION']);
$vehiculo_fecha_publicacion     = trim($row['VEHICULO_FECHA_PUBLICACION']);
$vehiculo_fecha_modificacion    = trim($row['VEHICULO_FECHA_MODIFICACION']);
$vehiculo_estado                = trim($row['VEHICULO_ESTADO']);

        $VEHICULO_IMG1             = trim($row['VEHICULO_IMG1']);
        $VEHICULO_IMG2             = trim($row['VEHICULO_IMG2']);
        $VEHICULO_IMG3             = trim($row['VEHICULO_IMG3']);
        $VEHICULO_IMG4             = trim($row['VEHICULO_IMG4']);
        $VEHICULO_IMG5             = trim($row['VEHICULO_IMG5']);

$id_carroceria              = trim($row['CARROCERIA_ID_CARROCERIA']);
$carroceria_nombre          = trim($row['CARROCERIA_NOMBRE']);
$carroceria_descripcion     = trim($row['CARROCERIA_DESCRIPCION']);

$marca_id_marca     = trim($row['MARCA_ID_MARCA']);
$marca_id_pais      = trim($row['MARCA_ID_PAIS']);
$marca_nombre       = trim($row['MARCA_NOMBRE']);
$modelo_nombre      = trim($row['MODELO_NOMBRE']);
$modelo_id_modelo   = trim($row['MODELO_ID_MODELO']);


$pais_id_pais        = trim($row['PAIS_ID_PAIS']);
$pais_nombre         = trim($row['PAIS_NOMBRE']);
$region_id_region    = trim($row['REGION_ID_REGION']);
$region_nombre       = trim($row['REGION_NOMBRE']);
$region_nregion      = trim($row['REGION_NREGION']);
$ciudad_id_ciudad    = trim($row['CIUDAD_ID_CIUDAD']);
$ciudad_nombre       = trim($row['CIUDAD_NOMBRE']);

if ($automotora_direccion == '') { $automotora_direccion = '&nbsp;'; }
if ($automotora_telefono  == '') { $automotora_telefono  = '&nbsp;'; }
if ($automotora_email     == '') { $automotora_email     = '&nbsp;'; }
if ($automotora_url       == '') { $automotora_url       = '&nbsp;'; }

$auto_horario = "";
if ($automotora_horario_lun_vie){ 
    $auto_horario .= "Lunes a Viernes (".$automotora_horario_lun_vie.")"; 
}
if ($automotora_horario_sab){ 
    $auto_horario .= " <br> Sábado (".$automotora_horario_sab.")"; 
}
if ($automotora_horario_dom){ 
    $auto_horario .= " <br> Domingo (".$automotora_horario_dom.")"; 
}

    $getAtributos = $CAT->getAtributos(array(
        'VEHICULO_ID_VEHICULO' => $vehiculo_id_vehiculo
    ));
    while($row_atrib = $getAtributos->fetch_assoc()) {
        $id_atributo      = trim($row_atrib['ATRIBUTO_ID_ATRIBUTO']);
        $nombre           = trim($row_atrib['ATRIBUTO_NOMBRE']);
        $descripcion      = trim($row_atrib['ATRIBUTO_DESCRIPCION']);
        $tipo             = trim($row_atrib['ATRIBUTO_TIPO']);
        $estado           = trim($row_atrib['ATRIBUTO_ESTADO']);
        $sector           = trim($row_atrib['ATRIBUTO_SECTOR']);
        $conjunto         = trim($row_atrib['ATRIBUTO_CONJUNTO']);
        $valor            = trim($row_atrib['ATRIBUTO_VEHICULO_VALOR']);
    
    if ($conjunto) {
        $veh_atrb[$conjunto]['id']  = $id_atributo;
        $veh_atrb[$conjunto]['nom'] = $nombre;
        $veh_atrb[$conjunto]['des'] = $descripcion;
        $veh_atrb[$conjunto]['tip'] = $tipo;
        $veh_atrb[$conjunto]['est'] = $estado;
        $veh_atrb[$conjunto]['val'] = $valor;
    }else{
        $veh_atrb[$nombre]['id']  = $id_atributo;
        $veh_atrb[$nombre]['nom'] = $nombre;
        $veh_atrb[$nombre]['des'] = $descripcion;
        $veh_atrb[$nombre]['tip'] = $tipo;
        $veh_atrb[$nombre]['est'] = $estado;
        $veh_atrb[$nombre]['val'] = $valor;        
    }
}

// imagen debe tener el identificador de automotora no el rut.....        
list ($img_400x300_1, $img_80x60_1) = get_2_img($id_automotora, $VEHICULO_IMG1, 1);
list ($img_400x300_2, $img_80x60_2) = get_2_img($id_automotora, $VEHICULO_IMG2, 2);
list ($img_400x300_3, $img_80x60_3) = get_2_img($id_automotora, $VEHICULO_IMG3, 3);
list ($img_400x300_4, $img_80x60_4) = get_2_img($id_automotora, $VEHICULO_IMG4, 4);
list ($img_400x300_5, $img_80x60_5) = get_2_img($id_automotora, $VEHICULO_IMG5, 5);
        
?>
    <script>
    function googleMap(params) {
        var param_container   = params.container;
        var param_info        = params.info;
        var param_icon        = params.icon;
        var param_lat         = params.lat;
        var param_lng         = params.lng;

        var mapProp = {
            center    : new google.maps.LatLng(param_lat, param_lng),
            zoom      : 15,
            mapTypeId : google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById($(param_container).attr("id")), mapProp);

        var infoWindow = new google.maps.InfoWindow({
            content : param_info
        });

        var marker = new google.maps.Marker({
            position : new google.maps.LatLng(param_lat, param_lng),
            map      : map,
            icon     : param_icon
        });
        
        google.maps.event.addListener(map, 'tilesloaded', function() {
            if (!tilesloaded) {
                tilesloaded++;
                google.maps.event.trigger(map, 'resize');
                map.setCenter(mapProp.center);
            }            
        });

        google.maps.event.addListener(map, 'zoom_changed', function() {
        });

        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.open(map, marker);
        });  
    }
    
    var tilesloaded = 0;
    
    var automotoras = {
        '<?=$id_automotora?>' : {
          lat       : "<?=$automotora_lat?>",
          lng       : "<?=$automotora_lng?>",
          nombre    : "<?=$automotora_nombre?>",
          direccion : "<?=$automotora_direccion?>",
          telefono  : "<?=$automotora_telefono?>",
          email     : "<?=$automotora_email?>",
          horario   : "<?=$auto_horario?>"
        }
    };    
    
    var googleMap = googleMap({
        container : $("#map_canvas"),
        lat       : automotoras['<?=$id_automotora?>']['lat'],
        lng       : automotoras['<?=$id_automotora?>']['lng'],
        info      : '' +
                    '<div id="content" style="font-size: 10px">' +
                    '<p><b class="title">Automotora:</b></p>' +
                    '<p>'+ automotoras['<?=$id_automotora?>']['nombre'] + '</p>' +
                    '<p><b class="title">Dirección:</b></p>' +
                    '<p>'+ automotoras['<?=$id_automotora?>']['direccion'] + '</p>' +
                    '<p><b class="title">Horario:</b></p>' +
                    '<p>'+ automotoras['<?=$id_automotora?>']['horario'] + '</p>' +
                    '<p><b class="title">Teléfono:</b></p>' +
                    '<p>'+ automotoras['<?=$id_automotora?>']['telefono'] + '</p>' +
                    '<p><b class="title">Email</b></p>' +
                    '<p>'+ automotoras['<?=$id_automotora?>']['email'] + '</p>' +
                    '</div>',
        icon     : 'include/img/map_icon.png'            
    });    

    google.maps.event.addDomListener(window, 'load', googleMap);
    </script>

<script type="text/javascript">
$(document).ready(function(){
    _gaq.push(['_trackPageview', 'ficha']);
    //initialize();
    /*
    $("[title]").tooltip({
            track: true,
            delay: 0,
            showURL: false,
            showBody: " <br> ",
            fade: 250
    });
    */
});
</script>


<div class="ficha bx cf">
    <div class="slide_ficha cf">
        <div class="dealerhead">
            <? $automotora_logo = $automotora_img ? "include/img/logos/".$automotora_img.'?'.time() : "include/img/logo_post_auto.png"; ?>
            <h2><img src="<?=$automotora_logo?>" class="sucursal-logo-small" alt=""><?=mb_strtoupper($automotora_nombre)?></h2>
        </div>
        <div id="gallery">
            <div id="slides">
                <div class="slide" style="width:400px;"><img src="<?=$img_400x300_1?>" width="400" height="300" alt="Gal1 400x300"></div>
                <div class="slide" style="width:400px;"><img src="<?=$img_400x300_2?>" width="400" height="300" alt="Gal2 400x300"></div>
                <div class="slide" style="width:400px;"><img src="<?=$img_400x300_3?>" width="400" height="300" alt="Gal3 400x300"></div>
                <div class="slide" style="width:400px;"><img src="<?=$img_400x300_4?>" width="400" height="300" alt="Gal4 400x300"></div>
                <div class="slide" style="width:400px;"><img src="<?=$img_400x300_5?>" width="400" height="300" alt="Gal5 400x300"></div>
            </div>
            <div id="menu">
                <ul>
                    <li class="menuItem"><a href=""><img src="<?=$img_80x60_1?>" width="80" height="60" alt="Gal2 200x150"></a></li>
                    <li class="menuItem"><a href=""><img src="<?=$img_80x60_2?>" width="80" height="60" alt="Gal3 200x150"></a></li>
                    <li class="menuItem"><a href=""><img src="<?=$img_80x60_3?>" width="80" height="60" alt="Gal2 200x150"></a></li>
                    <li class="menuItem"><a href=""><img src="<?=$img_80x60_4?>" width="80" height="60" alt="Gal3 200x150"></a></li>
                    <li class="menuItem"><a href=""><img src="<?=$img_80x60_5?>" width="80" height="60" alt="Gal3 200x150"></a></li>
                </ul>
            </div>
        </div>

        <div class="dealerdata">
            <div id="map">
                <div id="map_canvas" style="height:230px;width:400px; top:30px"></div>
            </div>
            <div class="dealer_info">
                <ul>
                    <li class="place"><a href="#"><?=$automotora_direccion?> <?=$automotora_numero?>, <?=$ciudad_nombre?></a></li>
                    <li class="phone"><?=$automotora_telefono?></li>
                    <li class="mail"><a href="#"><?=$automotora_email?></a></li>
                    <li class="web"><a href="#"><?=$automotora_url?></a></li>
                    <li class="hour"><?=$auto_horario?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="metadata cf">
        <h1><?=mb_strtoupper($marca_nombre)?> <?=$modelo_nombre?></h1>
        <h2><?=fprecio($vehiculo_precio)?></h2>
        <div class="datepost"><strong>Publicado el:</strong><?=$vehiculo_fecha_publicacion?></div>
        <table width="440" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="156" class="label">Año</td>
                <td width="414"><?=$vehiculo_annio?></td>
            </tr>
            <tr>
                <td class="label">Carroceria</td>
                <td><?=$carroceria_nombre?></td>
            </tr>
            <tr>
                <td class="label">Kilometraje</td>
                <td><?=$vehiculo_kilometros?></td>
            </tr>
            <tr>
                <td class="label">Motor CC</td>
                <td><?=$veh_atrb['cc']['val']?></td>
            </tr>
            <tr>
                <td class="label">Transmisión</td>
                <td><?=$veh_atrb['transmision']['des']?><!-- - <?=$veh_atrb['transmision']['val']?>--></td>
            </tr>
            <tr>
                <td class="label">Combustible</td>
                <td><?=$veh_atrb['combustible']['des']?></td>
            </tr>
            <tr>
                <td class="label">Color</td>
                <td><?=$veh_atrb['color']['val']?></td>
            </tr>
        </table>

        <div class="fichatec cf" >
            <div class="lft" id="div_sector_equipo">
                <h3>Equipamiento</h3>
                    <table width="200" border="0" cellspacing="0" cellpadding="0">
                        <?
                        $getAtributos = $CAT->getAtributos(array(
                            'ATRIBUTO_SECTOR'   => 'equipo'
                        ));
                        while($row_atrib = $getAtributos->fetch_assoc()) {
                            $id_atributo      = trim($row_atrib['ATRIBUTO_ID_ATRIBUTO']);
                            $nombre           = trim($row_atrib['ATRIBUTO_NOMBRE']);
                            $descripcion      = trim($row_atrib['ATRIBUTO_DESCRIPCION']);
                            $tipo             = trim($row_atrib['ATRIBUTO_TIPO']);
                            $estado           = trim($row_atrib['ATRIBUTO_ESTADO']);
                            $sector           = trim($row_atrib['ATRIBUTO_SECTOR']);
                            $conjunto         = trim($row_atrib['ATRIBUTO_CONJUNTO']);
                            $valor            = trim($row_atrib['ATRIBUTO_VEHICULO_VALOR']); 
                        ?>
                            <? if ($veh_atrb[$nombre]['nom']) { ?>
                            <tr>
                                <td class="label"><?=$descripcion?></td>
                                <td><img src="include/img/check.png" width="18" height="14" alt="Si"></td>
                            </tr>
                            <? } ?>
                        <? } ?>
                    </table>
            </div>
            <?
            /* ***************************************************************************
             * ***************************************************************************
             * ***************************************************************************
             */
            ?>
            <div class="rgt">
                <h3>Seguridad</h3>
                    <table width="200" border="0" cellspacing="0" cellpadding="0">
                        <?/***********************************************************************/?>
                        <?/*********************  SEGURIDAD CONJUNTO *****************************/?>
                        <?/******************  se llaman de uno en uno ***************************/?>
                        <?/***********************************************************************/?>
                        <tr>
                            <td width="150" class="label">Frenos</td>
                            <td width="55"><?=$veh_atrb['frenos']['des']?></td>
                        </tr>
                        <?/***********************************************************************/?>
                        <?/*********************  SEGURIDAD CONJUNTO *****************************/?>
                        <?/***********************************************************************/?>
                        
                        <?/***********************************************************************/?>
                        <?/****************  SEGURIDAD 'num','txt','opt','chk' *******************/?>
                        <?/***********************************************************************/?>
                        <?
                        $hash_paso='';
                        $getAtributos = $CAT->getAtributos(array(
                            'ATRIBUTO_SECTOR'   => 'seguridad'
                        ));
                        while($row_atrib = $getAtributos->fetch_assoc()) {
                            $id_atributo      = trim($row_atrib['ATRIBUTO_ID_ATRIBUTO']);
                            $nombre           = trim($row_atrib['ATRIBUTO_NOMBRE']);
                            $descripcion      = trim($row_atrib['ATRIBUTO_DESCRIPCION']);
                            $tipo             = trim($row_atrib['ATRIBUTO_TIPO']);
                            $estado           = trim($row_atrib['ATRIBUTO_ESTADO']);
                            $sector           = trim($row_atrib['ATRIBUTO_SECTOR']);
                            $conjunto         = trim($row_atrib['ATRIBUTO_CONJUNTO']);
                            $valor            = trim($row_atrib['ATRIBUTO_VEHICULO_VALOR']); 
                        ?>
                        
                            <? if ($veh_atrb[$nombre]['val']) { ?>
                                <tr>
                                    <td width="160" class="label"><?=$descripcion?></td>
                                    <td><?=$veh_atrb[$nombre]['val']?></td>
                                </tr>
                            <? }else if ($veh_atrb[$nombre]['nom']) { ?>
                                <tr>
                                    <td width="160" class="label"><?=$descripcion?></td>
                                    <td><img src="include/img/check.png" width="18" height="14" alt="Si"></td>
                                </tr>
                            <? } ?>
                                
                                
<!--                                
                            <? 
                            /*
                            }else if ($veh_atrb[$conjunto]['nom'] && !$hash_paso[$conjunto] ) {
                                $hash_paso[$conjunto] = 1;
                             * 
                             */
                                ?>
                                <tr>
                                    <td width="160" class="label"><?=$conjunto?></td>
                                    <td><?=$veh_atrb[$conjunto]['des']?></td>
                                </tr>
                                -->
                                
                                
                        <? } ?>
                        <?/***********************************************************************/?>
                        <?/****************  SEGURIDAD 'num','txt','opt','chk' *******************/?>
                        <?/***********************************************************************/?>
                    </table>
                
            </div>
        </div>

        <div class="contactdealer cf">
            <h3>Contactar Automotora</h3>
            <p>
                <label>Motivo</label>
                <span>Solicitar información<input type="checkbox" checked="checked" disabled="true" id="info"></span>
                <span>Solicitar Test Drive<input type="checkbox" id="testdrive"></span>
            </p>
            <p>
                <label>Nombre</label>
                <input type="text" id="nombre">
            </p>
            <p>
                <label>Email</label>
                <input type="text" id="email">
                <input type="hidden" id="automotora_nombre" value="<?=$automotora_nombre?>">
                <input type="hidden" id="automotora_email" value="<?=$automotora_email?>">
                <input type="hidden" id="vehiculo_id" value="<?=$id_vehiculo?>">
            </p>
            <p>
                <label>Teléfono</label>
                <input type="text" id="telefono">
            </p>
            <p>
                <label>Mensaje</label>
                <textarea id="mensaje" rows="8" cols="40"></textarea>
            </p>
            <div id="bot_send_contact">
            <button onclick="contactar_automotora(<?=$vehiculo_id_vehiculo?>);">Enviar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="include/js/script_gallery.js"></script>


<input id="address" type="hidden" value="malaga 1118">
<script type="text/javascript">
//codeAddress();
</script>