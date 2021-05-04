<?php
include_once 'app/comun/session.php';
require_once 'app/comun/class.user.php';
require_once 'app/comun/BD.php';
if ($_SESSION['USUARIO_TIPO'] != 'visitante') {    
    echo 'No autorizado';    exit;
}

$CAT    = new Catalogo();
$User   = new User();
$id_visitante = $_SESSION['VISITANTE_ID_VISITANTE'];
$getVisitantes = $User->getVisitantes(array(                    
    'VISITANTE_ID_VISITANTE'  => $id_visitante               
        ));
$num_rows_Usuarios = $getVisitantes->num_rows;
while($row = $getVisitantes->fetch_assoc()) {    
    $visitante_id_visitante       = $row['VISITANTE_ID_VISITANTE'];    
    $visitante_email              = $row['VISITANTE_EMAIL'];    
    $visitante_nombre             = $row['VISITANTE_NOMBRE'];    
    $visitante_apellido_paterno   = $row['VISITANTE_APELLIDO_PATERNO'];    
    $visitante_apellido_materno   = $row['VISITANTE_APELLIDO_MATERNO'];    
    $visitante_rut                = $row['VISITANTE_RUT'];}?>

<style>    .user-edit-vendedor{        font-family:Verdana;        font-size:13px;        width: 300px;    }</style>
<div class="user-edit-vendedor">    
    <p><b>Mis datos</b></p>
    <br/>    
    <span>Email</span>    
    <p><input type="text" id="visitante-email" value="<?=$visitante_email?>"><p/>    
    <span>Contraseña</span>    
    <p><input type="password" id="visitante-password" value=""><p/>    
    <span>Repetir Contraseña</span>    
    <p><input type="password" id="visitante-password-rep" value=""><p/>    
    <span>Rut</span>    
    <p><input type="text" id="visitante-rut" value="<?=$visitante_rut?>"><p/>    
    <span>Nombre</span>    
    <p><input type="text" id="visitante-nombre" value="<?=$visitante_nombre?>"><p/>    
    <span>Apellido Paterno</span>    
    <p><input type="text" id="visitante-apellidopaterno" value="<?=$visitante_apellido_paterno?>"><p/>    
    <span>Apellido Materno</span>    
    <p><input type="text" id="visitante-apellidomaterno" value="<?=$visitante_apellido_materno?>"><p/>
</div>
<span class="btn rgt" onclick="user.editVisitante({ id: '<?=$id_visitante?>'})">Editar</span>
<span class="btn rgt" onclick="$.fancybox.close()">Cancelar</span>