<?php
require_once './app/comun/config.php';
require_once './app/comun/phpmailer/class.phpmailer.php';
require_once './app/comun/BD.php';
require_once './app/comun/utiles.php';
$CAT    = new Catalogo();
$id_vehiculo = trim($_GET['id_vehiculo']);
$getFicha = $CAT->getListado(array(    'VEHICULO_ID_VEHICULO' => $id_vehiculo));
$row = $getFicha->fetch_assoc();
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
$id_carroceria              = trim($row['CARROCERIA_ID_CARROCERIA']);
$carroceria_nombre          = trim($row['CARROCERIA_NOMBRE']);
$carroceria_descripcion     = trim($row['CARROCERIA_DESCRIPCION']);
$marca_id_marca     = trim($row['MARCA_ID_MARCA']);
$marca_id_pais      = trim($row['MARCA_ID_PAIS']);
$marca_nombre       = trim($row['MARCA_NOMBRE']);
$modelo_nombre      = trim($row['MODELO_NOMBRE']);
$modelo_id_modelo   = trim($row['MODELO_ID_MODELO']);
/******************************************************************************/
$desde_nombre = PHPMAILER_FromName;
$desde_email  = PHPMAILER_FromEmail;
$responder_a_nombre = PHPMAILER_ReplyToName;
$responder_a_email  = PHPMAILER_ReplyToEmail;
$asunto = 'Mensaje desde Automotora Chile';
$html  = '         Nombre : '.$_GET['nombre']. '<br/>         E-mail : '.$_GET['email'].'<br/>         Teléfono : '.$_GET['telefono'].'<br/>         Mensaje : '.$_GET['mensaje'].'<br/>                      Información : ';
$html .= $_GET['info'] == "true" ? "SI" : "NO";
$html .= '<br/>         Test Drive : ';
$html .= $_GET['testdrive'] == "true" ? "SI" : "NO";
$html .= "<p>Vehículo: ".$marca_nombre." ".$modelo_nombre." (".fprecio($vehiculo_precio).") </p>";$no_html = PHPMAILER_noHTML;
$mail = new PHPMailer(PHPMAILER_DEBUG); 
// Declaramos un nuevo correo, el parámetro true significa que mostrará excepciones y errores.$mail->SetLanguage('es');$mail->IsSMTP(); 
// Se especifica a la clase que se utilizará SMTPtry {    $mail->SMTPDebug  = PHPMAILER_SMTPDebug;   
// Habilita información SMTP (opcional para pruebas)                                               
// 1 = errores y mensajes                                               
// 2 = solo mensajes    $mail->SMTPAuth   = PHPMAILER_SMTPAuth;    
// Habilita la autenticación SMTP    $mail->SMTPSecure = PHPMAILER_SMTPSecure;     $mail->Host       = PHPMAILER_Host;          $mail->Port       = PHPMAILER_Port;    $mail->Username   = PHPMAILER_Username;    $mail->Password   = PHPMAILER_Password;    $mail->CharSet    = "UTF-8";        
//A que dirección se puede responder el correo    $mail->AddReplyTo($responder_a_email, $responder_a_nombre);    
//La dirección a dónde mandamos el correo    $mail->AddAddress($_GET['automotora_email'], $_GET['automotora_nombre']);    
//De parte de quien es el correo    $mail->SetFrom($desde_email, $desde_nombre);    
//Asunto del correo    $mail->Subject = $asunto;    
//Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML    $mail->AltBody = $no_html;    
//El cuerpo del mensaje, puede ser con etiquetas HTML    $mail->MsgHTML($html);    
//Archivos adjuntos    
//$mail->AddAttachment('archivo.txt');      
// Archivos Adjuntos    
//Enviamos el correo    $mail->Send();    echo 'SEND_OK';}catch (phpmailerException $e) {    echo $e->errorMessage(); 
//Errores de PhpMailer} catch (Exception $e) {    echo $e->getMessage(); //Errores de cualquier otro tipo}
?>