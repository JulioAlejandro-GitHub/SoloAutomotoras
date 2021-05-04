<?php



//require_once 'platform-default/app/comun/config.php';
//include_once 'platform-default/app/comun/session.php';
//require_once 'platform-default/app/comun/BD.php';
//
//$domainarray = explode('/', $_SERVER['REQUEST_URI']);
//
//$CAT    = new Catalogo();
//
//
//var_dump($domainarray);
//
//exit;
//
//
//echo $domainarray[1];
//
//
//if ($domainarray[1] === '') {
//    // buscar si existe empresa con ese nombre ....
//    // puede que existan dos....
//    // podriamos poner nombre de dominio q no se repita ó hacer que no se repita el nombre de la automotota
//    
//    $getAutomotora = $CAT->getAutomotoras(array(
//        'SUBDOMINIO' => $domainarray[1]
//    ));
//    
//    $row_auto = $getAutomotora->fetch_assoc();
//    $automotora_id_matriz        = trim($row_auto['AUTOMOTORA_ID_MATRIZ']);
//    
//    echo $automotora_id_matriz;
//    
//    
//}
//
//exit;

//array(35) { 
//    ["DOCUMENT_ROOT"]=> string(26) "/home/soloauto/public_html" 
//    ["GATEWAY_INTERFACE"]=> string(7) "CGI/1.1" 
//    ["HTTP_ACCEPT"]=> string(63) "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8" 
//    ["HTTP_ACCEPT_ENCODING"]=> string(17) "gzip,deflate,sdch" 
//    ["HTTP_ACCEPT_LANGUAGE"]=> string(15) "es-419,es;q=0.8" 
//    ["HTTP_CACHE_CONTROL"]=> string(9) "max-age=0" 
//    ["HTTP_CONNECTION"]=> string(10) "keep-alive" 
//    ["HTTP_COOKIE"]=> string(284) "automotora=f973f6bf358fa9354144670d4b5fee92; __utma=125155720.1310362453.1377879232.1380198577.1380201434.36; __utmc=125155720; __utmz=125155720.1378319492.8.3.utmcsr=cpanel.soloautomotoras.cl|utmccn=(referral)|utmcmd=referral|utmcct=/cpsess3492196493/frontend/x3/subdomain/index.html" 
//    ["HTTP_HOST"]=> string(18) "soloautomotoras.cl" 
//    ["HTTP_USER_AGENT"]=> string(101) "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36" 
//    ["PATH"]=> string(13) "/bin:/usr/bin" 
//    ["QS_AllConn"]=> string(1) "4" 
//    ["QS_ConnectionId"]=> string(24) "138080734827912425386403" 
//    ["QS_SrvConn"]=> string(1) "4" 
//    ["QUERY_STRING"]=> string(0) "" 
//    ["REDIRECT_STATUS"]=> string(3) "200" 
//    ["REMOTE_ADDR"]=> string(14) "190.196.181.34" 
//    ["REMOTE_PORT"]=> string(5) "50481" 
//    ["REQUEST_METHOD"]=> string(3) "GET" 
//    ["REQUEST_URI"]=> string(6) "/desa/" 
//    ["SCRIPT_FILENAME"]=> string(41) "/home/soloauto/public_html/desa/index.php" 
//    ["SCRIPT_NAME"]=> string(15) "/desa/index.php" 
//    ["SERVER_ADDR"]=> string(15) "190.114.255.205" 
//    ["SERVER_ADMIN"]=> string(28) "webmaster@soloautomotoras.cl" 
//    ["SERVER_NAME"]=> string(18) "soloautomotoras.cl" 
//    ["SERVER_PORT"]=> string(2) "80" 
//    ["SERVER_PROTOCOL"]=> string(8) "HTTP/1.1" 
//    ["SERVER_SIGNATURE"]=> string(0) "" 
//    ["SERVER_SOFTWARE"]=> string(6) "Apache" 
//    ["UNIQUE_ID"]=> string(24) "Uk1ytL5y-80ABeVjcqcAAAAZ" 
//    ["PHP_SELF"]=> string(15) "/desa/index.php" 
//    ["REQUEST_TIME_FLOAT"]=> float(1380807348.35) 
//    ["REQUEST_TIME"]=> int(1380807348) ["argv"]=> array(0) { } ["argc"]=> int(0) }






//require_once 'class.browser.php';
////redirecciona según el tipo de plataforma
//$plataform = Browser::getPlatform();
//
//switch ($plataform) {
//    case 'android': case 'iphone':
//        $index = './platform-mobile/';
//        break;
//        
//    default:
//        $index = './platform-default/';
//}

$index = './platform-default/';

header("Location: ".$index);
?>