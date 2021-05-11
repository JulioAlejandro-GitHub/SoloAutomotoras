<?php
require_once 'MYSQL.php';

class Catalogo extends MYSQL {
    public function __construct() {
        parent::__construct();
    }
    
    
    public function sumContadorBusqueda($id_vehiculo) {
        $sql = "UPDATE vehiculo SET CONT_BUSQUEDA = CONT_BUSQUEDA + 1 WHERE ID_VEHICULO = $id_vehiculo";
        return $this->query($sql);
    }
    public function sumContadorFicha($id_vehiculo) {
        $sql = "UPDATE vehiculo SET CONT_FICHA = CONT_FICHA + 1 WHERE ID_VEHICULO = $id_vehiculo";
        return $this->query($sql);
    }
    public function sumContadorMiniSitio($id_automotora) {
        $sql = "UPDATE automotora SET CONT_MINISITIO = CONT_MINISITIO + 1 WHERE ID_AUTOMOTORA = $id_automotora";
        return $this->query($sql);
    }
    
    

    public function delFicha($id_vehiculo, $id_automotora) {
            $sql = '
                    UPDATE vehiculo SET
                        ESTADO = "eliminado"
                    WHERE 
                        vehiculo.ID_VEHICULO   = "'.$id_vehiculo.'"
                    AND vehiculo.ID_AUTOMOTORA = "'.$id_automotora.'"
                    ';
            return $this->query($sql);
    }
    public function updPublicar($id_vehiculo, $id_automotora) {
            $sql = '
                    UPDATE vehiculo SET
                        ESTADO = "alta"
                    WHERE 
                        vehiculo.ID_VEHICULO = "'.$id_vehiculo.'"
                    AND vehiculo.ID_AUTOMOTORA = "'.$id_automotora.'"
                    ';
            return $this->query($sql);
    }
    public function updDesPublicar($id_vehiculo, $id_automotora) {
            $sql = '
                    UPDATE vehiculo SET
                        ESTADO = "baja"
                    WHERE 
                        vehiculo.ID_VEHICULO = "'.$id_vehiculo.'"
                    AND vehiculo.ID_AUTOMOTORA = "'.$id_automotora.'"
                    ';
            return $this->query($sql);
    }
    public function getAutomotoras($params=array()) {
        $sql = '
                SELECT 
                    automotora.ID_AUTOMOTORA        AS AUTOMOTORA_ID_AUTOMOTORA,
                    automotora.ID_MATRIZ            AS AUTOMOTORA_ID_MATRIZ,
                    automotora.ID_CIUDAD            AS AUTOMOTORA_ID_CIUDAD,
                    automotora.RUT                  AS AUTOMOTORA_RUT,
                    automotora.NOMBRE               AS AUTOMOTORA_NOMBRE,
                    automotora.TELEFONO             AS AUTOMOTORA_TELEFONO,
                    automotora.EMAIL                AS AUTOMOTORA_EMAIL,
                    automotora.FAX                  AS AUTOMOTORA_FAX, 
                    automotora.RAZON_SOCIAL         AS AUTOMOTORA_RAZON_SOCIAL,
                    automotora.IMG                  AS AUTOMOTORA_IMG,  
                    automotora.URL                  AS AUTOMOTORA_URL,       
                    automotora.DIRECCION            AS AUTOMOTORA_DIRECCION,  
                    automotora.HORARIO_LUN_VIE      AS AUTOMOTORA_HORARIO_LUN_VIE,      
                    automotora.HORARIO_SAB          AS AUTOMOTORA_HORARIO_SAB,  
                    automotora.HORARIO_DOM          AS AUTOMOTORA_HORARIO_DOM,     
                    automotora.MAPA                 AS AUTOMOTORA_MAPA,     
                    automotora.FECHA_INGRESO        AS AUTOMOTORA_FECHA_INGRESO,    
                    automotora.FECHA_MODIFICACION   AS AUTOMOTORA_FECHA_MODIFICACION,
                    automotora.ESTADO               AS AUTOMOTORA_ESTADO     
                FROM 
                    automotora
                ';
        $condition_and = array();
        $condition_manual = array();
        if ($params['AUTOMOTORA_ID_AUTOMOTORA']) {
            array_push($condition_and, 'automotora.ID_AUTOMOTORA = "'.$params['AUTOMOTORA_ID_AUTOMOTORA'].'"');
        }
        if ($params['AUTOMOTORA_ID_MATRIZ']) {
            array_push($condition_and, 'automotora.ID_MATRIZ = "'.$params['AUTOMOTORA_ID_MATRIZ'].'"');
        }

        //Se trae la matriz y todas sus sucursales
        if ($params['AUTOMOTORA_SUCURSAL']) {
            array_push($condition_manual, 'AND ( automotora.ID_AUTOMOTORA = "'.$params['AUTOMOTORA_SUCURSAL'].'" OR automotora.ID_MATRIZ  = "'.$params['AUTOMOTORA_SUCURSAL'].'")');
        }
        
        if ($params['SUBDOMINIO']) {
            array_push($condition_and, 'automotora.SUBDOMINIO = "'.$params['SUBDOMINIO'].'"');
        }
        
        
        
        array_push($condition_and, 'automotora.ESTADO <> "inactivo"');
        if ( count($condition_and) ) {
            $sql .= 'WHERE '.implode(' AND ', $condition_and);
        }
        if ( count($condition_manual) ) {
            $sql .= ' '.implode(' ', $condition_manual);
        }
        $sql .= '
                ORDER BY automotora.NOMBRE
                ';            
        return $this->query($sql);
    }
    public function getMarcas($params=array()) {
        $sql = '
                SELECT 
                    /*
                    carroceria.ID_CARROCERIA    AS CARROCERIA_ID_CARROCERIA,
                    carroceria.NOMBRE           AS CARROCERIA_NOMBRE,
                    carroceria.DESCRIPCION      AS CARROCERIA_DESCRIPCION,
                    */
                    marca.ID_MARCA              AS MARCA_ID_MARCA,
                    UPPER(marca.NOMBRE)         AS MARCA_NOMBRE,
                    marca.ID_PAIS               AS MARCA_PAIS

                    /*
                    modelo.ID_MODELO            AS MODELO_ID_MODELO,
                    modelo.ID_MARCA             AS MODELO_ID_MARCA,
                    modelo.ID_CARROCERIA        AS MODELO_ID_CARROCERIA,
                    modelo.NOMBRE               AS MODELO_NOMBRE
                    */
                FROM 
                    marca
                /*
                LEFT JOIN modelo        ON modelo.ID_MARCA              =   marca.ID_MARCA
                LEFT JOIN carroceria    ON carroceria.ID_CARROCERIA     =   modelo.ID_CARROCERIA
                */
                ';
        $condition = array();

//        if ($params['CARROCERIA_ID_CARROCERIA']) {
//            array_push($condition, 'carroceria.ID_CARROCERIA = "'.$params['CARROCERIA_ID_CARROCERIA'].'"');
//        }

        if ( count($condition) ) {
            $sql .= 'WHERE '.implode(' AND ', $condition);
        }
        
        $sql .= '
                GROUP BY marca.NOMBRE
                ORDER BY marca.NOMBRE
                ';
        
        return $this->query($sql);
    }
    public function getModelos($params=array()) {
        $sql = '
                SELECT
                    /*
                    carroceria.ID_CARROCERIA    AS CARROCERIA_ID_CARROCERIA,
                    carroceria.NOMBRE           AS CARROCERIA_NOMBRE,
                    carroceria.DESCRIPCION      AS CARROCERIA_DESCRIPCION,
                    */
                    marca.ID_MARCA              AS MARCA_ID_MARCA,
                    UPPER(marca.NOMBRE)         AS MARCA_NOMBRE,
                    marca.ID_PAIS               AS MARCA_PAIS,
                    modelo.ID_MODELO            AS MODELO_ID_MODELO,
                    modelo.ID_MARCA             AS MODELO_ID_MARCA,
                    modelo.ID_CARROCERIA        AS MODELO_ID_CARROCERIA,
                    UPPER(modelo.NOMBRE)        AS MODELO_NOMBRE
                FROM 
                    modelo
                INNER JOIN marca        ON marca.ID_MARCA               =   modelo.ID_MARCA
                /*
                INNER JOIN carroceria   ON carroceria.ID_CARROCERIA     =   modelo.ID_CARROCERIA
                */
                ';
        $condition = array();
        
        //echo "antes [".$params['MODELO_ID_MARCA']."]";
        
        
        array_push($condition, ' modelo.FECHA_ELIMINACION IS NULL ');
        
        if ($params['MODELO_ID_MARCA']) {
            //echo "aqui [".$params['MODELO_ID_MARCA']."]";
            array_push($condition, 'modelo.ID_MARCA = "'.$params['MODELO_ID_MARCA'].'"');
        }
//        if ($params['MODELO_ID_CARROCERIA']) {
//            array_push($condition, 'modelo.ID_CARROCERIA = "'.$params['MODELO_ID_CARROCERIA'].'"');
//        }
        if ( count($condition) ) {
            
            //echo "where  [".$params['MODELO_ID_MARCA']."]";
            
            $sql .= 'WHERE '.implode(' AND ', $condition);
            
            //echo "sql[".$sql."]";
            
        }

        $sql .= '
                ORDER BY modelo.NOMBRE
                ';
        //echo $sql;
        return $this->query($sql);
    }    
    public function getRegiones($params=array()) {
        $sql = '
                SELECT 
                    region.ID_REGION     AS REGION_ID_REGION,
                    region.ID_PAIS       AS REGION_ID_PAIS,
                    UPPER(region.NOMBRE) AS REGION_NOMBRE,
                    region.ORDEN         AS REGION_ORDEN
                FROM 
                    region
                ';
        $condition = array();
        if ($params['REGION_ID_PAIS']) {
            array_push($condition, 'region.ID_PAIS = "'.$params['REGION_ID_PAIS'].'"');
        }
        if ( count($condition) ) {
            $sql .= 'WHERE '.implode(' AND ', $condition);
        }
        $sql .= '
                ORDER BY region.NOMBRE
        ';
        return $this->query($sql);
    }
    public function getCiudades($params=array()) {
        $sql = '
                SELECT 
                    ciudad.ID_CIUDAD     AS CIUDAD_ID_CIUDAD,
                    ciudad.ID_REGION     AS CIUDAD_ID_REGION,
                    ciudad.ID_PAIS       AS CIUDAD_ID_PAIS,
                    UPPER(ciudad.NOMBRE) AS CIUDAD_NOMBRE
                FROM 
                    ciudad
                ';
        $condition = array();
        if ($params['CIUDAD_ID_REGION']) {
            array_push($condition, 'ciudad.ID_REGION = "'.$params['CIUDAD_ID_REGION'].'"');
        }
        if ($params['CIUDAD_ID_PAIS']) {
            array_push($condition, 'ciudad.ID_PAIS = "'.$params['CIUDAD_ID_PAIS'].'"');
        }
        if ( count($condition) ) {
            $sql .= 'WHERE '.implode(' AND ', $condition);
        }
        $sql .= '
                ORDER BY ciudad.NOMBRE
                ';
        return $this->query($sql);
    }
    public function getAtributos($params=array()) {
        $sql = '
                SELECT 
                    atributo.ID_ATRIBUTO            AS ATRIBUTO_ID_ATRIBUTO,
                    atributo.NOMBRE                 AS ATRIBUTO_NOMBRE,
                    atributo.DESCRIPCION            AS ATRIBUTO_DESCRIPCION,
                    atributo.TIPO                   AS ATRIBUTO_TIPO,
                    atributo.SECTOR                 AS ATRIBUTO_SECTOR,
                    atributo.ESTADO                 AS ATRIBUTO_ESTADO,
                    atributo.CONJUNTO               AS ATRIBUTO_CONJUNTO,
                    atributo_vehiculo.ID_ATRIBUTO   AS ATRIBUTO_VEHICULO_VALOR,
                    atributo_vehiculo.ID_VEHICULO   AS ATRIBUTO_VEHICULO_VALOR,
                    atributo_vehiculo.VALOR         AS ATRIBUTO_VEHICULO_VALOR,
                    vehiculo.ID_VEHICULO            AS VEHICULO_ID_VEHICULO,
                    vehiculo.ID_MARCA               AS VEHICULO_ID_MARCA,
                    vehiculo.ID_VENDEDOR            AS VEHICULO_ID_VENDEDOR,
                    vehiculo.ID_MODELO              AS VEHICULO_ID_MODELO,
                    vehiculo.PATENTE                AS VEHICULO_PATENTE,
                    vehiculo.ANNIO                  AS VEHICULO_ANNIO,
                    vehiculo.KILOMETROS             AS VEHICULO_KILOMETROS,
                    vehiculo.PRECIO                 AS VEHICULO_PRECIO,
                    vehiculo.DESCRIPCION            AS VEHICULO_DESCRIPCION,
                    vehiculo.FECHA_PUBLICACION      AS VEHICULO_FECHA_PUBLICACION,
                    vehiculo.FECHA_MODIFICACION     AS VEHICULO_FECHA_MODIFICACION,
                    vehiculo.ESTADO                 AS VEHICULO_ESTADO                    
                FROM 
                    atributo
                LEFT JOIN atributo_vehiculo     ON atributo_vehiculo.ID_ATRIBUTO    =   atributo.ID_ATRIBUTO
                LEFT JOIN vehiculo              ON vehiculo.ID_VEHICULO             =   atributo_vehiculo.ID_VEHICULO
                ';
        $condition = array();
        if ($params['ATRIBUTO_SECTOR']) {
            array_push($condition, 'atributo.SECTOR = "'.$params['ATRIBUTO_SECTOR'].'"');
        }
        if ($params['ATRIBUTO_CONJUNTO']) {
            array_push($condition, 'atributo.CONJUNTO = "'.$params['ATRIBUTO_CONJUNTO'].'"');
        }
        if ($params['VEHICULO_ID_VEHICULO']) {
            array_push($condition, 'vehiculo.ID_VEHICULO = "'.$params['VEHICULO_ID_VEHICULO'].'"');
        }
        if ( count($condition) ) {
            $sql .= 'WHERE '.implode(' AND ', $condition);
        }
        $sql .= '
                GROUP BY atributo.NOMBRE
                ORDER BY atributo.NOMBRE
                ';
        return $this->query($sql);
    }
    public function getListado($params=array()) {
        $sql = '
                SELECT
                    automotora.ID_AUTOMOTORA        AS AUTOMOTORA_ID_AUTOMOTORA,
                    automotora.ID_MATRIZ            AS AUTOMOTORA_ID_MATRIZ,
                    automotora.ID_CIUDAD            AS AUTOMOTORA_ID_CIUDAD,
                    UPPER(automotora.RUT)           AS AUTOMOTORA_RUT,
                    UPPER(automotora.NOMBRE)        AS AUTOMOTORA_NOMBRE,
                    automotora.TELEFONO             AS AUTOMOTORA_TELEFONO,
                    automotora.EMAIL                AS AUTOMOTORA_EMAIL,
                    automotora.FAX                  AS AUTOMOTORA_FAX,
                    UPPER(automotora.RAZON_SOCIAL)  AS AUTOMOTORA_RAZON_SOCIAL,
                    automotora.IMG                  AS AUTOMOTORA_IMG,
                    automotora.URL                  AS AUTOMOTORA_URL,
                    automotora.DIRECCION            AS AUTOMOTORA_DIRECCION,
                    automotora.HORARIO_LUN_VIE      AS AUTOMOTORA_HORARIO_LUN_VIE,
                    automotora.HORARIO_SAB          AS AUTOMOTORA_HORARIO_SAB,
                    automotora.HORARIO_DOM          AS AUTOMOTORA_HORARIO_DOM,
                    automotora.MAPA                 AS AUTOMOTORA_MAPA,     
                    automotora.FECHA_INGRESO        AS AUTOMOTORA_FECHA_INGRESO,
                    automotora.FECHA_MODIFICACION   AS AUTOMOTORA_FECHA_MODIFICACION,
                    automotora.ESTADO               AS AUTOMOTORA_ESTADO,
                    carroceria.ID_CARROCERIA        AS CARROCERIA_ID_CARROCERIA,
                    UPPER(carroceria.NOMBRE)        AS CARROCERIA_NOMBRE,
                    carroceria.DESCRIPCION          AS CARROCERIA_DESCRIPCION,
                    ciudad.ID_CIUDAD                AS CIUDAD_ID_CIUDAD,
                    ciudad.ID_REGION                AS CIUDAD_ID_REGION,
                    ciudad.ID_PAIS                  AS CIUDAD_ID_PAIS,
                    UPPER(ciudad.NOMBRE)            AS CIUDAD_NOMBRE,
                    
                    marca.ID_MARCA                  AS MARCA_ID_MARCA,
                    marca.ID_PAIS                   AS MARCA_ID_PAIS,
                    UPPER(marca.NOMBRE)             AS MARCA_NOMBRE,
                    
                    modelo.ID_MODELO                AS MODELO_ID_MODELO, 
                    modelo.ID_MARCA                 AS MODELO_ID_MARCA,
                    UPPER(modelo.NOMBRE)            AS MODELO_NOMBRE,
                    modelo.ID_CARROCERIA            AS MODELO_ID_CARROCERIA,
                    
                    region.ID_REGION                AS REGION_ID_REGION,
                    region.ID_PAIS                  AS REGION_ID_PAIS,
                    UPPER(region.NOMBRE)            AS REGION_NOMBRE,
                    region.ORDEN                    AS REGION_ORDEN,
                    
                    vehiculo.ID_VEHICULO            AS VEHICULO_ID_VEHICULO,
                    vehiculo.ID_MARCA               AS VEHICULO_ID_MARCA,
                    vehiculo.ID_VENDEDOR            AS VEHICULO_ID_VENDEDOR,
                    vehiculo.ID_MODELO              AS VEHICULO_ID_MODELO,
                    UPPER(vehiculo.PATENTE)         AS VEHICULO_PATENTE,
                    vehiculo.ANNIO                  AS VEHICULO_ANNIO,
                    vehiculo.KILOMETROS             AS VEHICULO_KILOMETROS,
                    vehiculo.PRECIO                 AS VEHICULO_PRECIO,
                    vehiculo.DESCRIPCION            AS VEHICULO_DESCRIPCION,
                    vehiculo.FECHA_PUBLICACION      AS VEHICULO_FECHA_PUBLICACION,
                    vehiculo.FECHA_MODIFICACION     AS VEHICULO_FECHA_MODIFICACION,
                    vehiculo.ESTADO                 AS VEHICULO_ESTADO,
                    vehiculo.IMG1                 AS VEHICULO_IMG1,
                    vehiculo.IMG2                 AS VEHICULO_IMG2,
                    vehiculo.IMG3                 AS VEHICULO_IMG3,
                    vehiculo.IMG4                 AS VEHICULO_IMG4,
                    vehiculo.IMG5                 AS VEHICULO_IMG5,
                    
                    vendedor.ID_AUTOMOTORA          AS VENDEDOR_ID_AUTOMOTORA,
                    vendedor.ID_VENDEDOR            AS VENDEDOR_ID_VENDEDOR,
                    vendedor.NOMBRE                 AS VENDEDOR_NOMBRE,
                    vendedor.APELLIDO_PATERNO       AS VENDEDOR_APELLIDO_PATERNO,
                    vendedor.APELLIDO_MATERNO       AS VENDEDOR_APELLIDO_MATERNO,
                    vendedor.RUT                    AS VENDEDOR_RUT,
                    vendedor.EMAIL                  AS VENDEDOR_EMAIL,
                    vendedor.PASSWORD               AS VENDEDOR_PASSWORD,
                    vendedor.TELEFONO               AS VENDEDOR_TELEFONO,
                    vendedor.MOVIL                  AS VENDEDOR_MOVIL,
                    vendedor.DIRECCION              AS VENDEDOR_DIRECCION,
                    vendedor.FECHA_INGRESO          AS VENDEDOR_FECHA_INGRESO,
                    vendedor.FECHA_MODIFICACION     AS VENDEDOR_FECHA_MODIFICACION,
                    vendedor.TIPO                   AS VENDEDOR_TIPO
                FROM
                    vehiculo
                INNER JOIN modelo       ON modelo.ID_MODELO             =   vehiculo.ID_MODELO        AND modelo.ID_MARCA = vehiculo.ID_MARCA
                INNER JOIN marca        ON marca.ID_MARCA               =   modelo.ID_MARCA
                INNER JOIN carroceria   ON carroceria.ID_CARROCERIA     =   vehiculo.ID_CARROCERIA            
                INNER JOIN vendedor     ON vendedor.ID_VENDEDOR         =   vehiculo.ID_VENDEDOR
                INNER JOIN automotora   ON automotora.ID_AUTOMOTORA     =   vehiculo.ID_AUTOMOTORA
                LEFT JOIN ciudad       ON ciudad.ID_CIUDAD              =   automotora.ID_CIUDAD
                LEFT JOIN region       ON region.ID_REGION              =   ciudad.ID_REGION
                ';

        $condition_and    = array();
        $condition_manual = array();
        if ($params['MARCA_ID_MARCA']) {
            array_push($condition_and, 'marca.ID_MARCA = "'.$params['MARCA_ID_MARCA'].'"');
        }
        if ($params['MODELO_ID_MODELO']) {
            array_push($condition_and, 'modelo.ID_MODELO = "'.$params['MODELO_ID_MODELO'].'"');
        }
        if ($params['CARROCERIA_ID_CARROCERIA']) {
            array_push($condition_and, 'carroceria.ID_CARROCERIA = "'.$params['CARROCERIA_ID_CARROCERIA'].'"');
        }
        if ($params['REGION_ID_REGION']) {
            array_push($condition_and, 'region.ID_REGION = "'.$params['REGION_ID_REGION'].'"');
        }
        if ($params['CIUDAD_ID_CIUDAD']) {
            array_push($condition_and, 'ciudad.ID_CIUDAD = "'.$params['CIUDAD_ID_CIUDAD'].'"');
        }
        if ($params['AUTOMOTORA_ID_AUTOMOTORA']) {
            array_push($condition_and, 'automotora.ID_AUTOMOTORA = "'.$params['AUTOMOTORA_ID_AUTOMOTORA'].'"');
        }
        if ($params['VEHICULO_ANNIO_DESDE'] && $params['VEHICULO_ANNIO_HASTA']) {
            array_push($condition_and, 'vehiculo.ANNIO BETWEEN "'.$params['VEHICULO_ANNIO_DESDE'].'" AND "'.$params['VEHICULO_ANNIO_HASTA'].'"');
        }
        if (isset($params['VEHICULO_PRECIO_DESDE']) && isset($params['VEHICULO_PRECIO_HASTA'])) {
            array_push($condition_and, 'vehiculo.PRECIO BETWEEN "'.$params['VEHICULO_PRECIO_DESDE'].'" AND "'.$params['VEHICULO_PRECIO_HASTA'].'"');
        }
        if (isset($params['VEHICULO_USADO']) && isset($params['VEHICULO_NUEVO'])) {
            $condition_vehiculo_condicion = array();
            if ($params['VEHICULO_USADO']) {
                array_push($condition_vehiculo_condicion, 'vehiculo.CONDICION = "usado"');
            }
            if ($params['VEHICULO_NUEVO']) {
                array_push($condition_vehiculo_condicion, 'vehiculo.CONDICION = "nuevo"');
            }
            if ( count($condition_vehiculo_condicion) ) {
                array_push($condition_and, '('.implode(' OR ', $condition_vehiculo_condicion).')');
            }            
        }
        if ($params['VEHICULO_ID_VEHICULO']) {
            array_push($condition_and, 'vehiculo.ID_VEHICULO = "'.$params['VEHICULO_ID_VEHICULO'].'"');
        }
        if ($params['VEHICULO_ESTADO']) {
            array_push($condition_and, 'vehiculo.ESTADO = "'.$params['VEHICULO_ESTADO'].'"');
        }

        array_push($condition_and, 'automotora.ESTADO <> "inactivo"');
        array_push($condition_and, 'vehiculo.ESTADO <> "eliminado"');

        if ( count($condition_and) ) {
            $sql .= 'WHERE '.implode(' AND ', $condition_and);
        }
        if ( count($condition_manual) ) {
            $sql .= ' '.implode(' ', $condition_manual);
        }
        $sql .= '
                ORDER BY vehiculo.FECHA_PUBLICACION desc
                ';
        
        if ($params['limit_desde'] >= '0' && $params['limit_hasta'] >= '0') {
            $sql .= '
                    LIMIT '.$params['limit_desde'].', '.$params['limit_hasta'].'
                    ';
        }
        
        //echo "[$sql]";
        
        return $this->query($sql);
        
    }
    
    
    
    public function getListadoDestacado($params=array()) {
        $sql = "
SELECT 
desatacado_automotora.ID_AUTOMOTORA,
desatacado_automotora.FECHA_INICIO,
desatacado_automotora.FECHA_TERMINO,
destacado_vehiculo.ID_VEHICULO,

                    automotora.ID_AUTOMOTORA        AS AUTOMOTORA_ID_AUTOMOTORA,
                    automotora.ID_MATRIZ            AS AUTOMOTORA_ID_MATRIZ,
                    automotora.ID_CIUDAD            AS AUTOMOTORA_ID_CIUDAD,
                    UPPER(automotora.RUT)           AS AUTOMOTORA_RUT,
                    UPPER(automotora.NOMBRE)        AS AUTOMOTORA_NOMBRE,
                    automotora.TELEFONO             AS AUTOMOTORA_TELEFONO,
                    automotora.EMAIL                AS AUTOMOTORA_EMAIL,
                    automotora.FAX                  AS AUTOMOTORA_FAX,
                    UPPER(automotora.RAZON_SOCIAL)  AS AUTOMOTORA_RAZON_SOCIAL,
                    automotora.IMG                  AS AUTOMOTORA_IMG,
                    automotora.URL                  AS AUTOMOTORA_URL,
                    automotora.DIRECCION            AS AUTOMOTORA_DIRECCION,
                    automotora.HORARIO_LUN_VIE      AS AUTOMOTORA_HORARIO_LUN_VIE,
                    automotora.HORARIO_SAB          AS AUTOMOTORA_HORARIO_SAB,
                    automotora.HORARIO_DOM          AS AUTOMOTORA_HORARIO_DOM,
                    automotora.MAPA                 AS AUTOMOTORA_MAPA,     
                    automotora.FECHA_INGRESO        AS AUTOMOTORA_FECHA_INGRESO,
                    automotora.FECHA_MODIFICACION   AS AUTOMOTORA_FECHA_MODIFICACION,
                    automotora.ESTADO               AS AUTOMOTORA_ESTADO,
                    carroceria.ID_CARROCERIA        AS CARROCERIA_ID_CARROCERIA,
                    UPPER(carroceria.NOMBRE)        AS CARROCERIA_NOMBRE,
                    carroceria.DESCRIPCION          AS CARROCERIA_DESCRIPCION,
                    ciudad.ID_CIUDAD                AS CIUDAD_ID_CIUDAD,
                    ciudad.ID_REGION                AS CIUDAD_ID_REGION,
                    ciudad.ID_PAIS                  AS CIUDAD_ID_PAIS,
                    UPPER(ciudad.NOMBRE)            AS CIUDAD_NOMBRE,
                    
                    marca.ID_MARCA                  AS MARCA_ID_MARCA,
                    marca.ID_PAIS                   AS MARCA_ID_PAIS,
                    UPPER(marca.NOMBRE)             AS MARCA_NOMBRE,
                    
                    modelo.ID_MODELO                AS MODELO_ID_MODELO, 
                    modelo.ID_MARCA                 AS MODELO_ID_MARCA,
                    UPPER(modelo.NOMBRE)            AS MODELO_NOMBRE,
                    modelo.ID_CARROCERIA            AS MODELO_ID_CARROCERIA,
                    
                    region.ID_REGION                AS REGION_ID_REGION,
                    region.ID_PAIS                  AS REGION_ID_PAIS,
                    UPPER(region.NOMBRE)            AS REGION_NOMBRE,
                    region.ORDEN                    AS REGION_ORDEN,
                    
                    vehiculo.ID_VEHICULO            AS VEHICULO_ID_VEHICULO,
                    vehiculo.ID_MARCA               AS VEHICULO_ID_MARCA,
                    vehiculo.ID_VENDEDOR            AS VEHICULO_ID_VENDEDOR,
                    vehiculo.ID_MODELO              AS VEHICULO_ID_MODELO,
                    UPPER(vehiculo.PATENTE)         AS VEHICULO_PATENTE,
                    vehiculo.ANNIO                  AS VEHICULO_ANNIO,
                    vehiculo.KILOMETROS             AS VEHICULO_KILOMETROS,
                    vehiculo.PRECIO                 AS VEHICULO_PRECIO,
                    vehiculo.DESCRIPCION            AS VEHICULO_DESCRIPCION,
                    vehiculo.FECHA_PUBLICACION      AS VEHICULO_FECHA_PUBLICACION,
                    vehiculo.FECHA_MODIFICACION     AS VEHICULO_FECHA_MODIFICACION,
                    vehiculo.ESTADO                 AS VEHICULO_ESTADO,
                    vehiculo.IMG1                 AS VEHICULO_IMG1,
                    vehiculo.IMG2                 AS VEHICULO_IMG2,
                    vehiculo.IMG3                 AS VEHICULO_IMG3,
                    vehiculo.IMG4                 AS VEHICULO_IMG4,
                    vehiculo.IMG5                 AS VEHICULO_IMG5,
                    
                    vendedor.ID_AUTOMOTORA          AS VENDEDOR_ID_AUTOMOTORA,
                    vendedor.ID_VENDEDOR            AS VENDEDOR_ID_VENDEDOR,
                    vendedor.NOMBRE                 AS VENDEDOR_NOMBRE,
                    vendedor.APELLIDO_PATERNO       AS VENDEDOR_APELLIDO_PATERNO,
                    vendedor.APELLIDO_MATERNO       AS VENDEDOR_APELLIDO_MATERNO,
                    vendedor.RUT                    AS VENDEDOR_RUT,
                    vendedor.EMAIL                  AS VENDEDOR_EMAIL,
                    vendedor.PASSWORD               AS VENDEDOR_PASSWORD,
                    vendedor.TELEFONO               AS VENDEDOR_TELEFONO,
                    vendedor.MOVIL                  AS VENDEDOR_MOVIL,
                    vendedor.DIRECCION              AS VENDEDOR_DIRECCION,
                    vendedor.FECHA_INGRESO          AS VENDEDOR_FECHA_INGRESO,
                    vendedor.FECHA_MODIFICACION     AS VENDEDOR_FECHA_MODIFICACION,
                    vendedor.TIPO                   AS VENDEDOR_TIPO

FROM desatacado_automotora 
INNER JOIN vehiculo           ON vehiculo.ID_AUTOMOTORA         = desatacado_automotora.ID_AUTOMOTORA
INNER JOIN destacado_vehiculo ON destacado_vehiculo.ID_VEHICULO = vehiculo.ID_VEHICULO

INNER JOIN modelo       ON modelo.ID_MODELO             =   vehiculo.ID_MODELO        AND modelo.ID_MARCA = vehiculo.ID_MARCA
INNER JOIN marca        ON marca.ID_MARCA               =   modelo.ID_MARCA
INNER JOIN carroceria   ON carroceria.ID_CARROCERIA     =   vehiculo.ID_CARROCERIA            
INNER JOIN vendedor     ON vendedor.ID_VENDEDOR         =   vehiculo.ID_VENDEDOR
INNER JOIN automotora   ON automotora.ID_AUTOMOTORA     =   vehiculo.ID_AUTOMOTORA
LEFT JOIN ciudad        ON ciudad.ID_CIUDAD             =   automotora.ID_CIUDAD
LEFT JOIN region        ON region.ID_REGION             =   ciudad.ID_REGION

WHERE desatacado_automotora.FECHA_INICIO <= NOW() AND desatacado_automotora.FECHA_TERMINO >= NOW()
AND destacado_vehiculo.ESTADO = 'Activo'
ORDER BY destacado_vehiculo.ORDEN
    ";
        
        return $this->query($sql);
    }
    
    
    
    /************************************************************/
    public function insFicha($id_vehiculo) {
            $sql = "";
        return $this->query($sql);
    }

    public function addFicha(/********************************************************/
                             $id_automotora,
                             $id_vendedor, 
                             /********************************************************/

                             /********************* DATOS   **************************/
                             $edt_sel_marca,
                             $edt_sel_modelo,
                             $edt_txt_patente,
                             $edt_txt_precio,
                             $edt_ano,
                             $edt_sel_carroceria,
                             $edt_txt_kilometros,
                             /********************************************************/

                             /********************* PUBLICACION **********************/
                             $edt_radio_publicacion_tipo,
                             $edt_sel_publicacion_etiqueta, 
                             $estado
                             /********************************************************/
                            ) {
        if ($edt_sel_modelo     =='') { $edt_sel_modelo     = 'NULL'; }
        if ($edt_txt_patente    =='') { $edt_txt_patente    = 'NULL'; }
        if ($edt_ano            =='') { $edt_ano            = 'NULL'; }
        if ($edt_txt_kilometros =='') { $edt_txt_kilometros = 'NULL'; }
        if ($edt_txt_precio     =='') { $edt_txt_precio     = 0; }
        if ($edt_sel_carroceria =='') { $edt_sel_carroceria = 'NULL'; }

//$sql = "INSERT INTO vehiculo 
//        (ID_AUTOMOTORA , ID_VENDEDOR , ID_MARCA      , FECHA_PUBLICACION, FECHA_MODIFICACION, ID_MODELO      , PATENTE           , ANNIO     , KILOMETROS         , PRECIO         , ID_CARROCERIA      , ESTADO)
//        VALUES
//        ($id_automotora, $id_vendedor, $edt_sel_marca, now()          , now()           , $edt_sel_modelo, '$edt_txt_patente', $edt_ano, $edt_txt_kilometros, $edt_txt_precio, $edt_sel_carroceria, '$estado') ";

        $sql = "INSERT INTO vehiculo 
        (ID_MODELO      , ID_MARCA      , ID_CARROCERIA      , ID_VENDEDOR, ID_AUTOMOTORA  , PATENTE           , ANNIO   , KILOMETROS         , PRECIO         , FECHA_PUBLICACION , ESTADO)
        VALUES
        ($edt_sel_modelo, $edt_sel_marca, $edt_sel_carroceria, $id_vendedor, $id_automotora, '$edt_txt_patente', $edt_ano, $edt_txt_kilometros, $edt_txt_precio, now()             , '$estado') ";

//return "[".$sql."]";

        if ($this->query($sql)) {
            $id_vehiculo = $this->insert_id;
            if (trim($edt_txt_motor_cc) != '') {
                $sqldel = "DELETE FROM atributo_vehiculo WHERE ID_VEHICULO = $id_vehiculo AND ID_ATRIBUTO = 8 ";
                $this->query($sqldel);
                if ($this->query($sql1)) {
                    $sqlins = "INSERT INTO atributo_vehiculo 
                            (ID_ATRIBUTO, VALOR   , ID_VEHICULO)
                            VALUES
                            (8          , '$edt_txt_motor_cc', $id_vehiculo) ";
                    $this->query($sqlins);
                }
            }
            //renombrar las imagenes...
            return $id_vehiculo;
        }

        return false;

    }

    public function updImgFicha($id_vehiculo,$img1,$img2,$img3,$img4,$img5) {
            $sql = "UPDATE vehiculo SET
                        IMG1 = '$img1',
                        IMG2 = '$img2',
                        IMG3 = '$img3',
                        IMG4 = '$img4',
                        IMG5 = '$img5'
                    WHERE 
                        vehiculo.ID_VEHICULO = $id_vehiculo ";
            $this->query($sql);
    }

    public function updFicha(/********************************************************/
                             $id_vehiculo,
                             /********************************************************/

                             /********************* DATOS   **************************/
                             $edt_sel_marca,
                             $edt_sel_modelo,
                             $edt_txt_patente,
                             $edt_txt_precio,
                             $edt_txt_ano,
                             $edt_sel_carroceria,
                             $edt_txt_kilometros,
                             /********************************************************/

                             /********************* PUBLICACION **********************/
                             $edt_radio_publicacion_tipo,
                             $edt_sel_publicacion_etiqueta
                             /********************************************************/
                        ) {
            $sql = "UPDATE vehiculo SET
                        ID_MARCA = $edt_sel_marca,
                        ID_MODELO        = '$edt_sel_modelo',
                        FECHA_PUBLICACION  = now(),
                        FECHA_MODIFICACION = now(), 
                        PATENTE          = '$edt_txt_patente',
                        ANNIO            = $edt_txt_ano,
                        KILOMETROS       = $edt_txt_kilometros,
                        PRECIO           = $edt_txt_precio,
                        ID_CARROCERIA    = $edt_sel_carroceria,
                        ESTADO           = 'alta'
                    WHERE 
                        vehiculo.ID_VEHICULO = $id_vehiculo ";
            $this->query($sql);

            if (trim($edt_txt_motor_cc) != '') {
                $sqldel = "DELETE FROM atributo_vehiculo WHERE ID_VEHICULO = $id_vehiculo AND ID_ATRIBUTO = 8 ";
                $this->query($sqldel);
                if ($this->query($sql1)) {
                    $sqlins = "INSERT INTO atributo_vehiculo 
                            (ID_ATRIBUTO, VALOR   , ID_VEHICULO)
                            VALUES
                            (8          , '$edt_txt_motor_cc', $id_vehiculo) ";
                    $this->query($sqlins);
                }
            }
            return true;
    }
    public function dalAllAtributo($id_vehiculo) {
        // elimminar todo
        $sql = "DELETE 
                FROM atributo_vehiculo 
                WHERE 
                    ID_VEHICULO = $id_vehiculo";
        return $this->query($sql);
    }
    public function AddAtributo($id_vehiculo, $id_atributo, $valor) {
        //if (trim($valor) == '' ) { $valor = 'NULL'; }
//        // elimminar todo
//        $sql = "DELETE 
//                FROM atributo_vehiculo 
//                WHERE 
//                    ID_VEHICULO = $id_vehiculo
//                AND ID_ATRIBUTO = $id_atributo ";
//        
//        echo"[$sql]";
//        
//        if ($this->query($sql)){
//            echo"[ok]<br>";

            // agregar todo...
            $sql = "INSERT INTO atributo_vehiculo 
                    (ID_ATRIBUTO, VALOR   , ID_VEHICULO)
                    VALUES
                    ($id_atributo, '$valor', $id_vehiculo) ";
//            echo"[$sql]<br>";
            return $this->query($sql);
//        }
        return false;
    }
    public function getCarroceria($params=array()) {
            $sql = '
                    SELECT 
                        carroceria.ID_CARROCERIA    AS CARROCERIA_ID_CARROCERIA,
                        UPPER(carroceria.NOMBRE)    AS CARROCERIA_NOMBRE,
                        carroceria.DESCRIPCION      AS CARROCERIA_DESCRIPCION
                    FROM
                        carroceria
                    ';
        $condition = array();
        if ( count($condition) ) {
            $sql .= 'WHERE '.implode(' AND ', $condition);
        }

        $sql .= '
                ORDER BY carroceria.NOMBRE
                ';
        return $this->query($sql);
    }
}

//    public function getAtributos($sector='', $conjunto='') {
//            $sql = "SELECT 
//                        atributo.ID_ATRIBUTO,
//                        atributo.NOMBRE,
//                        atributo.DESCRIPCION,
//                        atributo.TIPO,
//			atributo.ESTADO,
//			atributo.SECTOR,
//                        atributo.CONJUNTO
//                    FROM 
//                    atributo ";
//            $where = '';
//            if ($sector) {
//                $where.= " atributo.SECTOR = '$sector' AND";
//            }
//            if ($conjunto == 1) {
//                // trae todo
//            }else if ($conjunto) {
//                $where.= " atributo.CONJUNTO = '$conjunto' AND";
//            }else{
//                // estos son categorias seleccionables....
//                $where.= " (atributo.CONJUNTO = '' OR
//                           atributo.CONJUNTO IS NULL
//                           ) AND";
//            }
//            //----------------------------------
//            if ($where != '') {
//                $where = mb_substr($where, 0, mb_strlen($where) - 3);
//                $sql.= " WHERE ".$where;
//            }
//            
//            $sql.= " ORDER BY atributo.DESCRIPCION ";
////echo"[$sql]<br>";
//        return $this->query($sql);
//    }
//    public function getAtribVeh($id_vehiculo='', $sector='') {
//            $sql = "SELECT 
//                        atributo.ID_ATRIBUTO,
//                        atributo.NOMBRE,
//                        atributo.TIPO,
//			atributo.ESTADO,
//			atributo.SECTOR,
//                        atributo.CONJUNTO,
//                        atributo_vehiculo.VALOR
//                    FROM 
//                    atributo_vehiculo
//                    INNER JOIN vehiculo ON vehiculo.ID_VEHICULO = atributo_vehiculo.ID_VEHICULO
//                    INNER JOIN atributo ON atributo.ID_ATRIBUTO = atributo_vehiculo.ID_ATRIBUTO
//                    WHERE 
//                        vehiculo.ID_VEHICULO = $id_vehiculo ";
//            if ($sector) {
//                //$sql = " atributo.SECTOR = '$sector' ";
//            }
////echo"[$sql]<br>";
//        return $this->query($sql);
//    }
?>