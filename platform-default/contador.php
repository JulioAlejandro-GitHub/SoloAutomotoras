<?php
require_once './app/comun/config.php';
include_once './app/comun/session.php';
require_once './app/comun/BD.php';
require_once './app/comun/utiles.php';
require_once './app/comun/class.user.php';

require_once './app/comun/Logger.php';


$Logger = new Logger(LOG_NOMBRE);
$CAT    = new Catalogo();


//$Logger->write_log("******** contador.php ***************");
//$Logger->write_log("[{$_POST['accion']}]-->[{$_POST['array_vehiculo']}]");

switch ($_POST['accion']) {
    case 'busqueda':
        $pieces = explode(",", $_POST['array_vehiculo']);
        foreach ($pieces as $id){
            $id = trim($id);
            if ($id !='') {
//                $Logger->write_log("sumContadorBusqueda --> [$id]");
                $ret = $CAT->sumContadorBusqueda($id);
//                $Logger->write_log("                    <-- [$ret]");
            }
        }
        break;
    case 1:
        break;
    case 2:
        break;
}