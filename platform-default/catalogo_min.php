<?php
require_once './app/comun/config.php';
include_once './app/comun/session.php';
require_once './app/comun/BD.php';
require_once './app/comun/utiles.php';
require_once './app/comun/class.user.php';

require_once './app/comun/Logger.php';

$Logger = new Logger(LOG_NOMBRE);

$CAT    = new Catalogo();
$User   = new User();


$Logger->write_log("*catalogo fichas....");


$_SESSION['limit_sql'] = $_SESSION['pagina'] * $_SESSION['fichas_pagina'];

if ($_SESSION['USUARIO_TIPO'] == 'vendedor') {
    $_SESSION['busq_automotora'] = $_SESSION['AUTOMOTORA_ID_AUTOMOTORA'];
}

$busq_marca        = $_SESSION['busq_marca'];
$busq_modelo       = $_SESSION['busq_modelo'];
$busq_tipo         = $_SESSION['busq_tipo'];
$busq_annio_desde  = $_SESSION['busq_annio_desde'];
$busq_annio_hasta  = $_SESSION['busq_annio_hasta'];
$busq_precio_desde = $_SESSION['busq_precio_desde'];
$busq_precio_hasta = $_SESSION['busq_precio_hasta'];
$busq_region       = $_SESSION['busq_region'];
$busq_ciudad       = $_SESSION['busq_ciudad'];
$busq_automotora   = $_SESSION['busq_automotora'];
$busq_usado        = $_SESSION['usado'];
$busq_nuevo        = $_SESSION['nuevo'];
$view              = $_SESSION['view'];

// esta busqueda debe estar paginada.... pasar la pagina...
// para buscar aleatoriamente se debe:
// buscar total de automotoras...
// si son mas de 16 (numero de paginacion 'fichas_pagina')... seleccionar 'fichas_pagina' del total y buscar uno de cada una que sea destacado....
// si no tiene destacado alguna de esas automotoras, buscar de una que si tenga destacado... gold, bronce, plata, normal
// asi hasta completar la cantidad de 'fichas_pagina'

// buscar una manera de hace eso....

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
    
    $contador_resultados = $_SESSION['contador_resultados'];
    while($row = $getListado->fetch_assoc()) {
        $contador_resultados++;
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
        
        $id_carroceria              = trim($row['CARROCERIA_ID_CARROCERIA']);
        $carroceria_nombre          = trim($row['CARROCERIA_NOMBRE']);
        $carroceria_descripcion     = trim($row['CARROCERIA_DESCRIPCION']);
        
        $marca_id_marca     = trim($row['MARCA_ID_MARCA']);
        $marca_id_pais      = trim($row['MARCA_ID_PAIS']);
        $marca_nombre       = trim($row['MARCA_NOMBRE']);
        $modelo_nombre      = trim($row['MODELO_NOMBRE']);
        $modelo_id_modelo   = trim($row['MODELO_ID_MODELO']);
        
        $annio = substr($vehiculo_fecha_publicacion, 0, 4);
        $mes   = substr($vehiculo_fecha_publicacion, 5, 2);
        $dia   = substr($vehiculo_fecha_publicacion, 8, 2);
        
        $vehiculo_fecha_publicacion = $dia.' '.$meses[$mes-1].' '.$annio;

        $marca_id_marca  = trim($row['MARCA_ID_MARCA']);
        $marca_id_pais   = trim($row['MARCA_ID_PAIS']);
        $marca_nombre    = trim($row['MARCA_NOMBRE']);
        /***************************************************************************/
        $array_cont_busqueda .= $vehiculo_id_vehiculo.',';
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
    ?>
        <? if ($view == 'list') { ?>
            <div class="list_post_th">
                <?
                $ruta_400x300 = PATH_CATALOG_IMG.$automotora_id_automotora.'/';
                $ruta_80x60   = PATH_CATALOG_IMG.$automotora_id_automotora.'/thumbnails/';
                $ruta_215     = PATH_CATALOG_IMG.$automotora_id_automotora.'/thumbnails/215/';
                $ruta_125     = PATH_CATALOG_IMG.$automotora_id_automotora.'/thumbnails/125/';
                
                $image = is_file($ruta_125.$VEHICULO_IMG1) ? $ruta_125.$VEHICULO_IMG1 : "include/img/sinfoto_125x93.png";
                ?>
                <img style="cursor:pointer" src="<?=$image?>" width="125" height="93" onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);">
                
                <? if ($colorCartel && $txtCartel) { ?>
                    <div style="cursor:pointer" onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);" class="list_label <?=$colorCartel?>"><?=$txtCartel?></div>
                <? } ?>
                
                <div class="list_maindata">
                    <?
                    //MITSUBISHI L 200 KATANA
                    //24
                    $titulo = $marca_nombre.' '.$modelo_nombre;
                    $largo = strlen($titulo);
                    $i = $largo;
                    $espacios = '&nbsp;';
                    while ($i <= 35) {
                        $titulo.=$espacios;
                        $i++;
                    }
                    ?>
                    
                    <h3><?=$titulo?></h3>
                    <!--<p><?=$vehiculo_annio?></p>-->
                    <p>
                        <?=$vehiculo_annio?>
                        <? if ($vehiculo_kilometros == 0 && $vehiculo_kilometros != '') { ?>
                            <img src="include/img/cerok.png" alt="0 km" class="cerok"/>
                        <? } ?>
                    </p>
                    
                    <p class="price"><?=fprecio($vehiculo_precio)?></p>
                    
                    <? if ($_SESSION['USUARIO_TIPO'] == 'visitante') {
                        $id_visitante  = $_SESSION['VISITANTE_ID_VISITANTE'];
                        $getFavoritos = $User->getFavoritos(array(
                                            'FAVORITO_ID_VISITANTE'  => $id_visitante,
                                            'FAVORITO_ID_VEHICULO'   => $vehiculo_id_vehiculo
                                       ));
                        $es_favorito = $getFavoritos->num_rows;                
                        while($rowFav = $getFavoritos->fetch_assoc()) {
                            $favorito_id_favorito       = trim($rowFav['FAVORITO_ID_FAVORITO']);
                        }
                        ?>
                        <? if (!$es_favorito) { ?>
                            <a href="#" onclick="user.addFavorito({ id_vehiculo: '<?=$vehiculo_id_vehiculo?>'});">Agregar a favoritos</a>
                        <? } else { ?>
                           <a href="#" onclick="user.deleteFavorito({ id_favorito: '<?=$favorito_id_favorito?>', marca: '<?=$marca_nombre?>', modelo: '<?=$vehiculo_modelo?>', precio:'<?=fprecio($vehiculo_precio)?>'});">Quitar de favoritos</a>
                        <? } ?>
                    <? } ?>
                </div>
                <div class="list_metadata">
                    <p><strong>Carroceria:</strong> <?=$carroceria_nombre?></p>
                    <p><strong>Kilometraje:</strong> <?=$vehiculo_kilometros?></p>
                    <p><strong>Motor CC:</strong> <?=$veh_atrb['cc']['val']?></p>
                    <p><strong>Transmisión:</strong> <?=$veh_atrb['transmision']['des']?></p>
                    <p><strong>Combustible:</strong> <?=$veh_atrb['combustible']['des']?></p>
                    <!--<p><strong>Color:</strong> <?=$veh_atrb['color']['val']?></p>-->
                </div>
                <div onclick="search.setAutomotora('<?=$automotora_id_automotora?>');" class="dealerlink listview"><a href="#"><img src="include/img/logo_dealer_link.jpg" alt=""><?=$automotora_nombre?></a></div>
            </div>
        <? }else{ ?>
            <div class="block_post_th">
                <?
                $ruta_400x300 = PATH_CATALOG_IMG.$automotora_id_automotora.'/';
                $ruta_80x60   = PATH_CATALOG_IMG.$automotora_id_automotora.'/thumbnails/';
                $ruta_215     = PATH_CATALOG_IMG.$automotora_id_automotora.'/thumbnails/215/';
                $ruta_125     = PATH_CATALOG_IMG.$automotora_id_automotora.'/thumbnails/125/';
                
                $image = is_file($ruta_215.$VEHICULO_IMG1) ? $ruta_215.$VEHICULO_IMG1 : "include/img/sinfoto_215x161.png";
                ?>
                <img onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);" src="<?=$image?>" width="215" height="161" alt="">
                <h3 onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);" style="cursor:pointer;"><?=$marca_nombre?> <?=$vehiculo_modelo?></h3>
                <p onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);" style="cursor:pointer;">
                    <?=$vehiculo_annio?>
                    <? if ($vehiculo_kilometros == 0 && $vehiculo_kilometros != '') { ?>
                        <img src="include/img/cerok.png" alt="0 km" class="cerok"/>
                    <? } ?>
                </p>
                <p onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);" style="cursor:pointer;" class="price"><?=fprecio($vehiculo_precio)?></p>
                <div onclick="search.setAutomotora('<?=$automotora_id_automotora?>');" class="dealerlink"><?=$automotora_nombre?><a href="#"><img src="include/img/logo_dealer_link.jpg" alt=""></a></div>
                
                <? if ($_SESSION['USUARIO_TIPO'] == 'visitante') { 
                    $id_visitante  = $_SESSION['VISITANTE_ID_VISITANTE'];
                    $getFavoritos = $User->getFavoritos(array(
                                        'FAVORITO_ID_VISITANTE'  => $id_visitante,
                                        'FAVORITO_ID_VEHICULO'   => $vehiculo_id_vehiculo
                                   ));

                    $es_favorito = $getFavoritos->num_rows;
                    
                    while($rowFav = $getFavoritos->fetch_assoc()) {
                        $favorito_id_favorito = trim($rowFav['FAVORITO_ID_FAVORITO']);
                    }
                    ?>
                    
                    <? if (!$es_favorito) { ?>
                        <a href="#" onclick="user.addFavorito({ id_vehiculo: '<?=$vehiculo_id_vehiculo?>'});">Agregar a favoritos</a>
                    <? } else { ?>
                        <a href="#" onclick="user.deleteFavorito({ id_favorito: '<?=$favorito_id_favorito?>', marca: '<?=$marca_nombre?>', modelo: '<?=$vehiculo_modelo?>', precio:'<?=fprecio($vehiculo_precio)?>'});">Quitar de favoritos</a>
                    <? } ?>
                <? } ?>
                <?
                $colorCartel = '';
                if ($veh_atrb[etiqueta][nom] == 'bono') {
                    $colorCartel = 'red';
                }else if ($veh_atrb[etiqueta][nom] == 'ultimo') {
                    $colorCartel = 'orange';
                }else if ($veh_atrb[etiqueta][nom] == 'nuevo') {
                    $colorCartel = 'green';
                }else if ($veh_atrb[etiqueta][nom] == 'oferta') {
                    $colorCartel = 'green';
                }else{
                    //$colorCartel = 'red';
                }
                $txtCartel = $veh_atrb[etiqueta][des];
                ?>
                <div onclick="ver_ficha(<?=$vehiculo_id_vehiculo?>);" style="cursor:pointer;" class="label_th <?=$colorCartel?>"><?=$txtCartel?></div>
            </div>
        <? } ?>
    <? } ?>
    
    
    <!--<span style="border-bottom: 1px solid #f2f2f2; display: block; color: #999;"></span>-->
    
    <?
    // EXISTEN MAS PAGINAS
    // SI 
        //PONER PAGINA SIGUIENTE
    // NO 
        // FIN ... PONER MENSAJE: FIN DE LOS RESULTADOS.... (CANTIDA DE RESULTADOS ENCONTRADOS)
    
    
    $_SESSION['pagina']++;
    
    
//                echo "[".$_SESSION['limit_sql']."]<br>";
//                echo "[".$_SESSION['fichas_pagina']."]<br>";  cvbcvbvb
    
    $resultados_encontrados = " - Resultados Encontrados ".$contador_resultados;
    $_SESSION['contador_resultados'] = $contador_resultados;
    ?>

    

    <? if ($num_rows_Listado >= $_SESSION['fichas_pagina']) { ?>
        <div id="send_publica" class="moreposts">
            <a href="catalogo_min.php?pagina=<?=$_SESSION['pagina']?>">
                <img src="include/img/buscar_mas.png" alt="Buscar" />
                <h4>Más Resultados - página siguiente (<?=$_SESSION['pagina']+1?>) <?=$resultados_encontrados?></h4>
            </a>
        </div>
    <? } else { ?>
        <div id="send_publica" class="moreposts">
            <a>
                <img src="include/img/ir_inicio.png" alt="Buscar" />
                <h4>FIN DE LOS RESULTADOS... - página (<?=$_SESSION['pagina']?>) <?=$resultados_encontrados?></h4>
                <!-- link ir al pricipio...  -->
            </a>
        </div>
    <? } ?>

    
<script>
_gaq.push(['_trackPageview', 'busqueda']);

contador_busqueda('<?=$array_cont_busqueda?>');
</script>