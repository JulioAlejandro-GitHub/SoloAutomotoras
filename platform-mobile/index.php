<?php
require_once '../platform-default/app/comun/config.php';
include_once '../platform-default/app/comun/session.php';
require_once '../platform-default/app/comun/BD.php';
require_once '../platform-default/app/comun/utiles.php';
require_once '../platform-default/app/comun/class.user.php';

$CAT    = new Catalogo();
$User   = new User();


$_SESSION['pagina'] = 0;
$_SESSION['fichas_pagina'] = 16;

$_SESSION['limit_sql'] = $_SESSION['pagina'] * $_SESSION['fichas_pagina'];

    $getListado = $CAT->getListado(array(
        'MARCA_ID_MARCA'            => $busq_marca,
        'MODELO_ID_MODELO'          => $busq_modelo, 
        'CARROCERIA_ID_CARROCERIA'  => $busq_tipo,
        'REGION_ID_REGION'          => $busq_region,
        'CIUDAD_ID_CIUDAD'          => $busq_ciudad,
        'AUTOMOTORA_ID_AUTOMOTORA'  => $busq_automotora,
        //'AUTOMOTORA_SUCURSAL'       => $busq_automotora,
        'VEHICULO_ANNIO_DESDE'      => $busq_annio_desde,
        'VEHICULO_ANNIO_HASTA'      => $busq_annio_hasta,
        'VEHICULO_PRECIO_DESDE'     => $busq_precio_desde,
        'VEHICULO_PRECIO_HASTA'     => $busq_precio_hasta,
        'VEHICULO_USADO'            => $busq_usado,
        'VEHICULO_NUEVO'            => $busq_nuevo,
        'VEHICULO_ESTADO'           => "alta",
        
        'limit_desde'            => $_SESSION['limit_sql'],
        'limit_hasta'            => $_SESSION['fichas_pagina']
    ));        
    
    $num_rows_Listado = $getListado->num_rows;
    

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title></title>
  
  <link rel="stylesheet" href="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.css">
  
  <!-- Extra Codiqa features -->
  <link rel="stylesheet" href="codiqa.ext.css">
  
  <!-- jQuery and jQuery Mobile -->
  <script src="https://d10ajoocuyu32n.cloudfront.net/jquery-1.9.1.min.js"></script>
  <script src="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

  <!-- Extra Codiqa features -->
  <script src="https://d10ajoocuyu32n.cloudfront.net/codiqa.ext.js"></script>
  
   
</head>
<body>
<!-- Home -->

<div data-role="page" data-control-title="Home" id="page1">
    
    
    <div data-role="panel" id="panel2" data-position="left" data-display="push"
    data-theme="b">
        <ul data-role="listview" data-divider-theme="h" data-inset="false">
            <li data-theme="a">
                <a href="#page1" data-transition="slide">
                    Mi Cuenta
                </a>
            </li>
            <li data-theme="a">
                <a href="#page2" data-transition="slide">
                    Registrate
                </a>
            </li>
        </ul>
    </div>
    
    

    <div data-theme="a" data-role="header" data-position="fixed">
        <a data-role="button" href="#panel1" data-icon="bars" data-iconpos="notext"
        class="ui-btn-left">
        </a>
        <h5>
            SoloAutomotoras
        </h5>
    </div>
    
    

    
    
    <div data-role="content">
        <div data-role="collapsible-set" data-theme="e" data-content-theme="e">
            <div data-role="collapsible">
                <h3>
                    Clientes Registrados
                </h3>
                <form action="">
                    <div data-role="fieldcontain">
                        <label for="textinput1">
                            Usuario
                        </label>
                        <input name="" id="textinput1" placeholder="" value="" type="text">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="textinput2">
                            Clave
                        </label>
                        <input name="" id="textinput2" placeholder="" value="" type="text">
                    </div>
                    <input type="submit" data-theme="a" value="Submit">
                </form>
            </div>
        </div>
        <div data-role="collapsible-set" data-theme="b" data-content-theme="b">
            <div data-role="collapsible">
                <h3>
                    Buscar
                </h3>
                <div data-role="fieldcontain">
                    <label for="selectmenu4">
                        Marcas
                    </label>
                    <select id="busq_marca" name="Marca" data-mini="true" onchange="search.getModelos();">
                        <option value="" selected="selected">.:: TODAS ::.</option>
                        <?
                        $getMarcas = $CAT->getMarcas();
                        while($row = $getMarcas->fetch_assoc()) { ?>
                            <option class="search-dynamic" value="<?=$row['MARCA_ID_MARCA']?>"><?=mb_strtoupper($row['MARCA_NOMBRE'])?></option>
                        <? } ?>
                    </select>
                </div>
                <div data-role="fieldcontain">
                    <label for="selectmenu5">
                        Modelos
                    </label>
                    <select id="busq_modelo" name="Modelo" data-mini="true">
                        <option value="" selected="selected">.:: TODOS ::.</option>
                        <?
                        $getModelos = $CAT->getModelos();
                        while($row = $getModelos->fetch_assoc()) { ?>
                            <option class="search-dynamic" value="<?=$row['MODELO_ID_MODELO']?>"><?=mb_strtoupper($row['MODELO_NOMBRE'])?></option>
                        <? } ?>
                    </select>
                </div>
                <div data-role="fieldcontain">
                    <label for="selectmenu6">
                        Automotoras
                    </label>
                    <select id="busq_automotora" name="" data-mini="true">
                        <option value="" selected="selected">.:: TODAS ::.</option>
                        <?
                        $getAutomotoras = $CAT->getAutomotoras();
                        $num_rows_Automotoras = $getAutomotoras->num_rows;
                        while($row = $getAutomotoras->fetch_assoc()) { 
                            ?>
                            <option class="search-dynamic" value="<?=$row['AUTOMOTORA_ID_AUTOMOTORA']?>"><?=mb_strtoupper($row['AUTOMOTORA_NOMBRE'])?></option>
                        <? } ?>
                    </select>
                </div>
                <a data-role="button" href="#page1">
                    Buscar
                </a>
            </div>
        </div>
        
        <?
        
    while($row = $getListado->fetch_assoc()) {
        $automotora_id_automotora       = trim($row['AUTOMOTORA_ID_AUTOMOTORA']);
        $automotora_id_matriz           = trim($row['AUTOMOTORA_ID_MATRIZ']);
        $automotora_id_ciudad           = trim($row['AUTOMOTORA_ID_CIUDAD']);
        $automotora_rut                 = trim($row['AUTOMOTORA_RUT']);
        $automotora_nombre              = trim($row['AUTOMOTORA_NOMBRE']);
        $automotora_fono                = trim($row['AUTOMOTORA_TELEFONO']);
        $automotora_email               = trim($row['AUTOMOTORA_EMAIL']);
        $automotora_fax                 = trim($row['AUTOMOTORA_FAX']);
        $automotora_razon               = trim($row['AUTOMOTORA_RAZON_SOCIAL']);
        $automotora_img                 = trim($row['AUTOMOTORA_IMG']);
        $automotora_url                 = trim($row['AUTOMOTORA_URL']);    
        $automotora_direccion           = trim($row['AUTOMOTORA_DIRECCION']);
        $automotora_numero              = trim($row['AUTOMOTORA_NUMERO']);
        $automotora_horario_lun_vie     = trim($row['AUTOMOTORA_HORARIO_LUN_VIE']);
        $automotora_horario_sab         = trim($row['AUTOMOTORA_HORARIO_SAB']);
        $automotora_horario_dom         = trim($row['AUTOMOTORA_HORARIO_DOM']);  
        $automotora_estado              = trim($row['AUTOMOTORA_ESTADO']);
        $automotora_fecha_ingreso       = trim($row['AUTOMOTORA_FECHA_INGRESO']);
        $automotora_fecha_modificacion  = trim($row['AUTOMOTORA_FECHA_MODIFICACION']);

        $vendedor_id_automotora    = trim($row['VENDEDOR_ID_AUTOMOTORA']);
        $vendedor_id_vendedor      = trim($row['VENDEDOR_ID_VENDEDOR']);
        $vendedor_nombres          = trim($row['VENDEDOR_NOMBRE']);
        $vendedor_app              = trim($row['VENDEDOR_APELLIDO_PATERNO']);
        $vendedor_apm              = trim($row['VENDEDOR_APELLIDO_MATERNO']);
        $vendedor_rut              = trim($row['VENDEDOR_RUT']);
        $vendedor_email            = trim($row['VENDEDOR_EMAIL']);
        $vendedor_pwd              = trim($row['VENDEDOR_PASSWORD']);
        $vendedor_telefono         = trim($row['VENDEDOR_TELEFONO']);
        $vendedor_movil            = trim($row['VENDEDOR_MOVIL']);
        $vendedor_direccion        = trim($row['VENDEDOR_DIRECCION']);
        $vendedor_fec_ingreso      = trim($row['VENDEDOR_FECHA_INGRESO']);
        $vendedor_fec_modificacion = trim($row['VENDEDOR_FECHA_MODIFICACION']);
        $vendedor_tipo             = trim($row['VENDEDOR_TIPO']);

        $vehiculo_id_vehiculo        = trim($row['VEHICULO_ID_VEHICULO']);
        $vehiculo_id_marca           = trim($row['VEHICULO_ID_MARCA']);
        $vehiculo_id_vendedor        = trim($row['VEHICULO_ID_VENDEDOR']);
        $vehiculo_id_ciudad          = trim($row['VEHICULO_ID_CIUDAD']);
        $vehiculo_modelo             = trim($row['MODELO_NOMBRE']);
        $modelo_id_modelo            = trim($row['MODELO_ID_MODELO']);
        
        $vehiculo_patente            = trim($row['VEHICULO_PATENTE']);
        $vehiculo_annio              = trim($row['VEHICULO_ANNIO']);
        $vehiculo_kilometros         = trim($row['VEHICULO_KILOMETROS']);
        $vehiculo_precio             = trim($row['VEHICULO_PRECIO']);
        $vehiculo_descripcion        = trim($row['VEHICULO_DESCRIPCION']);
        $vehiculo_fecha_publicacion  = trim($row['VEHICULO_FECHA_PUBLICACION']);
        $vehiculo_fecha_modificacion = trim($row['VEHICULO_FECHA_MODIFICACION']);
        $vehiculo_estado             = trim($row['VEHICULO_ESTADO']); 
        
        $VEHICULO_IMG1             = trim($row['VEHICULO_IMG1']);
        $VEHICULO_IMG2             = trim($row['VEHICULO_IMG2']);
        $VEHICULO_IMG3             = trim($row['VEHICULO_IMG3']);
        $VEHICULO_IMG4             = trim($row['VEHICULO_IMG4']);
        $VEHICULO_IMG5             = trim($row['VEHICULO_IMG5']);
        
        $annio = substr($vehiculo_fecha_publicacion, 0, 4);
        $mes   = substr($vehiculo_fecha_publicacion, 5, 2);
        $dia   = substr($vehiculo_fecha_publicacion, 8, 2);
        
        $vehiculo_fecha_publicacion = $dia.' '.$meses[$mes-1].' '.$annio;

        $marca_id_marca  = trim($row['MARCA_ID_MARCA']);
        $marca_id_pais   = trim($row['MARCA_ID_PAIS']);
        $marca_nombre    = trim($row['MARCA_NOMBRE']);
        /***************************************************************************/
        /***************************************************************************/
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
        
        
        
        $ruta_400x300 = '/platform-default/include/img/catalog/'.$automotora_id_automotora.'/';
        $ruta_80x60   = '/platform-default/include/img/catalog/'.$automotora_id_automotora.'/thumbnails/';
        $ruta_215     = '/platform-default/include/img/catalog/'.$automotora_id_automotora.'/thumbnails/215/';
        $ruta_125     = '/platform-default/include/img/catalog/'.$automotora_id_automotora.'/thumbnails/125/';
        
        

        $image = is_file($ruta_215.$VEHICULO_IMG1) ? $ruta_215.$VEHICULO_IMG1 : "include/img/sinfoto_215x161.png";
        ?>
        
        <div style="">
            <!--<img style="width: 288px; height: 100px" src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTI6Z5HWDGfalxnq6gGqh6fiiYTw83-kr5Rgl2JNtavsBaWjUHbZQ">-->
            <img onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);" src="<?=$ruta_215.$VEHICULO_IMG1?>" width="215" height="161" alt="">
            
            <table>
                <tr>
                    <td>Marca</td>
                    <td>:</td>
                    <td><?=$marca_nombre?> - <?=$vehiculo_modelo?></td>
                </tr>
                <tr>
                    <td>Año</td>
                    <td>:</td>
                    <td><?=$vehiculo_annio?></td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td>:</td>
                    <td><?=fprecio($vehiculo_precio)?></td>
                </tr>
            </table>
        </div>
        <br><br>
        
        <? } ?>
            
            

        
        <a id="cargarmas" data-role="button" data-theme="d" data-icon="arrow-d"
           href="#" 
        data-iconpos="left">
            Más Resultados
        </a>

    </div>
    
    <!--
    <div data-role="tabbar" data-iconpos="top" data-theme="a">
        <ul>
            <li>
                <a href="#page1" data-transition="fade" data-theme="" data-icon="home">
                    Home
                </a>
            </li>
            <li>
                <a href="#page2" data-transition="fade" data-theme="" data-icon="star">
                    Components
                </a>
            </li>
            <li>
                <a href="#page3" data-transition="fade" data-theme="" data-icon="info">
                    Platforms
                </a>
            </li>
        </ul>
    </div>
    -->
</div>
</body>
</html>