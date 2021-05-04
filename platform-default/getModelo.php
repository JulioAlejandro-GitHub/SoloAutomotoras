<?php
/*****************************************************************/
require_once 'BD.php';
require_once 'utiles.php';
/*****************************************************************/
$CAT    = new Catalogo();


$vehiculo_id_marca = trim($_GET[edt_sel_marca]);

?>
<select id="edt_sel_modelo">
    <option value="">.:: Seleccionar ::.</option>
    <?
    $getModelos = $CAT->getModelos(array(
        'MODELO_ID_MARCA' => $vehiculo_id_marca
    ));    
    if ($getModelos) {
    while($row_modelo = $getModelos->fetch_assoc()) {
        $id_marcas      = trim($row_modelo['MODELO_ID_MARCA']);
        $id_modelo      = trim($row_modelo['MODELO_ID_MODELO']);
        $nombre         = trim($row_modelo['MODELO_NOMBRE']);

        $selected = "";
        if ($vehiculo_modelo == $id_modelo) { $selected = "selected"; }
    ?>
        <option value="<?=$id_modelo?>" <?=$selected?>><?=$nombre?></option>
    <? }
    }?>
</select>