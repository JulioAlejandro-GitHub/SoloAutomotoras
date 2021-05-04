<?php
//$SIGNAL = new ftp_signal();
$_GET['opcion'] = 'crear';
    
    if ( empty($_GET['accion']) ) $_GET['accion'] = $_POST['accion'];
    
    if ( isset($_GET['opcion']) )
    {
?>
    <script>
    function previewImagen(input)
    {
        
        
      reader.onload = (function(input) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      });
     }
     </script>
     
    <body>
	<div class="wrap_a">
            <div id="signal_msg" style="margin-bottom: 15px; display:none"></div>
<?
	switch($_GET['opcion']){
		case 'crear':
?>
			<script>
			function crearSignal() {
				var nombre   = trim( $('#signalNombre') .val() );
				var imagen   = trim( $('#signalImagen') .val() );
                                var msjError = [];
                                
				if (!nombre)    msjError.push("Nombre");
				//if (!imagen)    msjError.push("Imagen");
           
                                if (msjError.length) {
                                    $.amasv_StatusDisplay({ message: 'Los siguientes campos son requeridos:<br/>'+ msjError.join(', '), container: 'signal_msg', maxSize: 350, status: 'warning', keepAlive: true });
                                    return false;
                                }
                                
                                $("#form_signalCrear").ajaxSubmit({
                                     data: {
                                         accion       :   "crear",
                                         nombre       :   nombre
                                     },
                                     beforeSubmit: function() { 
                                         $.amasv_StatusDisplay({ message: '<b>Creando Señal...</b>', container: 'signal_msg', keepAlive: true });
                                     },
                                     success: function(datos){
                                         switch($.trim(datos)) {
                                             case 'CREATE_OK':
                                                 $.amasv_StatusDisplay({ message: 'Se ha creado la señal "<b>' +nombre+ '</b>".', status: 'success' });
                                                 listSignal();
                                                 $.fancybox.close();
                                                 break;
                                             default:
                                                 $.amasv_StatusDisplay({ message: 'Error al intentar crear la señal.', container: 'signal_msg', status: 'error' });
                                         }
                                     }
                                 });
			}
                        
                        $('#form_signalCrear').submit(function(){ return false; });
                        
                        function cancelImagen() {
                            $("#signalImagen").val('');
                            $("#signalIcono").attr("src", "../include/img/default-signal.png");
                            $("#signalImagenCancelChk").removeAttr("checked");
                            $("#signalImagenCancel").hide();
                        }
 			</script>

			<h2>Crear Señal</h2>
			<div class="wrap_b">
                            <form id="form_signalCrear" action="admin/signal_accion.php" enctype="multipart/form-data" method="POST">
                                <p class="p_text">
                                    <label>Nombre</label>
                                    <input type="text" id="signalNombre">
                                </p>
                                <p class="p_text">
                                    <label>Imagen</label>
                                    <input type="file" id="signalImagen" name="signalImagen" onchange="previewImagen(this);">
                                    <br/><br/>
                                    <img id="signalIcono" src="../include/img/default-signal.png" class="img_signal">
                                    <br/><br/>
                                    <span id="signalImagenCancel" style="display: none"><input type="checkbox" id="signalImagenCancelChk" name="signalImagen" onchange="cancelImagen();"> Quitar imagen personalizada</span>
                                </p>
				<p class="p_text btns_end">
                                    <button onclick="crearSignal()">Crear</button>
                                    <button class="cancela" onclick="javascript: $.fancybox.close();">Cancelar</button>
				</p>
                            </form>
			</div>		

<?php
		break;
		
		case 'editar':
?>
			<script>
					
			function editarSignal()
                        {
				var id       = trim( $('#signalID')       .val() );
				var nombre   = trim( $('#signalNombre')   .val() );
				var filename = trim( $('#signalFilename') .val() );
				var imagen   = trim( $('#signalImagen')   .val() );
				var noimagen = $('#signalnoImagen') .is(":checked");
                                
                                noimagen ? noimagen=1 : noimagen=0;
                                
                                var msjError = [];

                                if (!id)
                                {
                                    $.amasv_StatusDisplay({ message: 'Seleccione una señal.', container: 'signal_msg', status: 'warning' });
                                    return false;
                                }
                                
				if (!nombre)    msjError.push("Nombre");
				//if (!imagen)    msjError.push("Imagen");
                                    
           
                                if (msjError.length)
                                {
                                    $.amasv_StatusDisplay({ message: 'Los siguientes campos son requeridos:<br/>'+ msjError.join(', '), container: 'signal_msg', maxSize: 350, status: 'warning' });
                                    return false;
                                }
                                
                                $("#form_signalEditar").ajaxSubmit({
                                     data:
                                     {
                                         accion       :   "editar",
                                         id           :   id,
                                         nombre       :   nombre,
                                         filename     :   filename,
                                         noimagen     :   noimagen
                                     },
                                     beforeSubmit: function() { 
                                         $.amasv_StatusDisplay({ message: '<b>Editando señal...</b>.', container: 'signal_msg', keepAlive: true });
                                     },
                                     success: function(datos){
                                         
                                         switch($.trim(datos))
                                         {
                                             case 'EDIT_OK':
                                                 $.amasv_StatusDisplay({ message: 'Se ha editado la <b>señal</b>.', status: 'success' });
                                                 listSignal();
                                                 listFTP_Signal();
                                                 $.fancybox.close();
                                                 break;

                                             case 'EDIT_EXISTS':
                                                 $.amasv_StatusDisplay({ message: 'Ya existe una señal con el nombre "<b>'+nombre+'</b>".<br/>Escoja uno diferente.', container: 'signal_msg', maxSize: 350, status: 'warning' });
                                                 break;

                                             case 'EDIT_IMG_MAXSIZEBITS':
                                                 $.amasv_StatusDisplay({ message: 'La imagen excede tamaño máximo permitido (<?=SIGNAL_IMG_MAXSIZEBYTES/1024?> KB).', container: 'signal_msg', maxSize: 350, status: 'warning' });
                                                 break;

                                             case 'EDIT_IMG_MAXSIZEPIXELS':
                                                 $.amasv_StatusDisplay({ message: 'La imagen excede tamaño máximo permitido (<?=SIGNAL_IMG_MAXSIZEPIXELS." x ".SIGNAL_IMG_MAXSIZEPIXELS?> px).', container: 'signal_msg', maxSize: 350, status: 'warning' });
                                                 break;

                                             case 'EDIT_IMG_FORMAT':
                                                 $.amasv_StatusDisplay({ message: 'Sólo se permiten imágenes JPG, GIF, PNG.', container: 'signal_msg', maxSize: 350, status: 'warning' });
                                                 break;

                                             case 'EDIT_ERROR_FILE_UPLOAD':
                                                 $.amasv_StatusDisplay({ message: 'Error al subir la imagen.', container: 'signal_msg', status: 'error' });
                                                 break;

                                             case 'EDIT_ERROR_FILE_COPY':
                                                 $.amasv_StatusDisplay({ message: 'Error al copiar la imagen subida.', container: 'signal_msg', status: 'error' });
                                                 break;

                                             default:
                                                 $.amasv_StatusDisplay({ message: 'Error al intentar editar la señal.', container: 'signal_msg', status: 'error' });
                                         }
                                         
                                     }        
                                 }); 
                              
			}
			
			function getSignaldatos()
                        {
                                $("#signalInfo").show();
                                $("#signalnoImagen").removeAttr("disabled");
                                $("#signalImagen").val('');
                                    
                                var option = $("#signalList option:selected");
				var value  = option.val(); 
                                var item   = value.split('|');
				//var text   = option.text();
                                
                                var id             = item[0];
                                var nombre         = item[1];
                                var imagen_nocache = item[2]; //nocache: filename.jpg?randomnumber
                                
                                var item_img = imagen_nocache.split('?');
                                var imagen   = item_img[0]; //filename.jpg
                                
                                $("#signalID")       .val(id);
                                $("#signalNombre")   .val(nombre);
                                $("#signalFilename") .val(imagen);
                                $("#signalnoImagen") .attr("checked", false);
                                
                                if (imagen)
                                {
                                    imagen_nocache = "<?=SIGNAL_IMG_DIR_HTML?>" + imagen_nocache;
                                    $("#signalnoImagen").removeAttr("disabled");                                    
                                }
                                else
                                {
                                    imagen_nocache = "../include/img/default-signal.png";
                                    $("#signalnoImagen").attr("disabled", "disabled");                                    
                                }
                                    
                                $("#signalIcono").show().attr("src", imagen_nocache);
                                
                                $.fancybox.center();
			}
                        
                        $('#form_signalEditar').submit(function(){ return false; });
                        
                        function previewnoImagen(checkbox)
                        {
                            $("#signalImagen").val('');

                            if ( $(checkbox).is(":checked") )
                            {
                                var imagen = "../include/img/default-signal.png";
                                
                                if ( !$("#signalFilename").val() )
                                    $("#signalnoImagen").attr("disabled", "disabled").removeAttr("checked"); 
                            }
                            else
                            {
                                if ( $("#signalFilename").val() )
                                    var imagen = "<?=SIGNAL_IMG_DIR_HTML?>" + $("#signalFilename").val();
                                else
                                {
                                    var imagen = "../include/img/default-signal.png";
                                    $("#signalnoImagen").attr("disabled", "disabled").removeAttr("checked");                                    
                                }
                            }

                             $("#signalIcono").attr("src", imagen);
                        }

			</script>


			<h2>Editar Señal</h2>
			<div class="wrap_b">
                            <form id="form_signalEditar" action="admin/signal_accion.php" enctype="multipart/form-data" method="POST">
                                <p class="p_text">
                                    <label>Seleccione señal:</label>
                                    <select id="signalList"  class="fltr_select" onchange="getSignaldatos();">
                                    <option selected="selected" disabled="disabled" value="">.:: Señales ::.</option>
                                    </select>                            
                                </p>
                                <br/>
                                <p>* Todas las configuraciones que estén asociadas <b>se verán afectadas con los cambios</b>.</p>
                                <br/>
                                <div id="signalInfo" style="display: none">
                                <p class="p_text">
                                    <label>Nombre</label>
                                    <input type="hidden" id="signalID">
                                    <input type="text" id="signalNombre">
                                </p>
                               <p class="p_text">
                                    <label>Imagen</label>
                                    <input type="file" id="signalImagen" name="signalImagen" onchange="previewImagen(this)">
                                    <input type="hidden" id="signalFilename">
                                    <br/><br/>
                                    <img id="signalIcono" src="" class="img_signal" style="display: none">
                                    <br/><br/>
                                    <input type="checkbox" id="signalnoImagen" onchange="previewnoImagen(this)" disabled> Quitar imagen personalizada
                                </p>
                                </div>
				<p class="p_text btns_end">
                                    <button onclick="editarSignal();">Editar</button>
                                    <button class="cancela" onclick="javascript: $.fancybox.close();">Cancelar</button>
				</p>
                            </form>
			</div>	
                                                
<?php
		break;
		
		case 'eliminar':
			
			
?>			
			<script>
				function eliminarSignal()
                                {
                                        var items = 0;
                                        var listaID = $("input[name=signalEliminar]:checked").map( function(){ items++; return this.value; } ).get().join("|");
                                        
					if (!items)
                                        {
                                            $.amasv_StatusDisplay({ message: 'Seleccione una o más señales.', container: 'signal_msg', status: 'warning' });
                                            return false;
                                        }
                                        
                                        if (items == 1)
                                            var msj_confirm = "¿Está seguro que desea eliminar la señal seleccionada?\n\nTambién se eliminarán todas las configuraciones asociadas a él.";
                                        else
                                            var msj_confirm = "¿Está seguro que desea eliminar las " +items+ " señales seleccionadas?\n\nTambién se eliminarán todas las configuraciones asociadas a ellas.";

                                        var continuar = confirm(msj_confirm);

                                        if (!continuar) return false;
                                            
                                        $.ajax({
                                            type:   "GET",
                                            url:    "admin/signal_accion.php",
                                            data:
                                            {
                                                accion  :  "eliminar",
                                                id      :  listaID
                                            },
                                            success: function(datos){
                                                
                                                switch($.trim(datos))
                                                {
                                                    case 'DELETE_OK':
                                                        if (items == 1)
                                                            $.amasv_StatusDisplay({ message: 'Se ha suprimido <b>1</b> señal.', status: 'success' });
                                                        else
                                                            $.amasv_StatusDisplay({ message: 'Se han suprimido <b>' +items+ '</b> señales.', status: 'success' });
                                                        
                                                        listSignal();
                                                        listFTP_Signal();
                                                        $.fancybox.close();
                                                        break;

                                                    default:
                                                        $.amasv_StatusDisplay({ message: 'Error al intentar eliminar señal.', container: 'signal_msg', status: 'error' });
                                                }
                                                
                                            },
                                            beforeSend: function(){
                                                if (items == 1)
                                                    $.amasv_StatusDisplay({ message: '<b>Eliminando señal...</b>.', container: 'signal_msg', keepAlive: true });
                                                else
                                                    $.amasv_StatusDisplay({ message: '<b>Eliminando señales...</b>', container: 'signal_msg', keepAlive: true });
                                            }, 
                                            complete: function(){
                                            }  
                                        });
				}
			</script>

                        <h2>Eliminar Señal</h2>
			<div class="wrap_b">
                                    <div class="list_eliminar_categ">
                                    </div>
                                    <br/>
                                    <p>* Las configuraciones que estén asociadas a las señales <b>se eliminarán</b>. <br/>Esta operación <b>no se puede revertir</b>.</p>

                                    <p class="p_text btns_end">
                                            <?php 
                                            if ($existeSignal)
                                            {
                                            ?>
                                                    <button onclick="eliminarSignal()">Eliminar</button>
                                                    <button class="cancela" onclick="javascript: $.fancybox.close();">Cancelar</button>
                                            <?php
                                            }
                                            else{
                                            ?>
                                                    <button onclick="javascript: $.fancybox.close();">Aceptar</button>					
                                            <?php
                                            }?>
                                    </p>
			</div>
<?php
		
		break;
	}
?>        
        </div>
    </body>
<?
    }
?>

<?php
	switch($_GET['accion']){
            
		case 'crear':	
                        $_POST['nombre'] = str_replace("+", " ", $_POST['nombre']);
                    
			$result = $SIGNAL->getSignal('WHERE NOMBRE = "'.$_POST['nombre'].'"');
                        $existe = mysql_num_rows($result);
			//$existe=null; //para saltar validacion si existe nombre de FTP
                        
			if ($existe)
                            echo 'CREATE_EXISTS';
			else
                        {
                            if ($_FILES['signalImagen']['tmp_name'])
                            {
                                 $tmp_name = $_FILES['signalImagen']['tmp_name'];
                                 $imagen = getimagesize($tmp_name);

                                 switch ($imagen[2])
                                 {
                                     case 1:
                                         $imagen_tipo = "gif";
                                         break;
                                     case 2: 
                                         $imagen_tipo = "jpg";
                                         break;
                                     case 3: 
                                         $imagen_tipo = "png";
                                         break;
                                 }

                                 if ($_FILES["signalImagen"]["size"] > SIGNAL_IMG_MAXSIZEBYTES)
                                     echo "CREATE_IMG_MAXSIZEBITS";

                                 else if ($imagen[0] > SIGNAL_IMG_MAXSIZEPIXELS || $imagen[1] > SIGNAL_IMG_MAXSIZEPIXELS)
                                     echo "CREATE_IMG_MAXSIZEPIXELS";
                                 
                                 else if (!$imagen_tipo)
                                     echo "CREATE_IMG_FORMAT";
                                 else
                                 { 
                                     if ( !@is_uploaded_file($_FILES['signalImagen']['tmp_name']) )
                                         echo "CREATE_ERROR_IMG_UPLOAD";
                                     else
                                     {
                                        $id = $SIGNAL->createSignal($_POST['nombre'], '');
                                        
                                        if ($id)
                                        {    
                                            $filename = $id.".".$imagen_tipo;

                                            if ( @move_uploaded_file($_FILES['signalImagen']['tmp_name'], SIGNAL_IMG_DIR_PHP.$filename) )
                                            {
                                                if ( $SIGNAL->setSignal($id, $_POST['nombre'], $filename) )
                                                    echo "CREATE_OK";
                                                else
                                                {
                                                    if ($SIGNAL->delSignal($id))
                                                        echo "CREATE_ERROR_IMG_SET";
                                                    else
                                                        echo 'CREATE_OK_IMG_ERROR';                                                
                                                }
                                            }
                                            else
                                            {
                                                if ($SIGNAL->delSignal($id))
                                                    echo "CREATE_ERROR_IMG_SET";
                                                else
                                                    echo 'CREATE_OK_IMG_ERROR';  
                                            }                                            
                                        }
                                        else
                                            echo "CREATE_ERROR";
                                     } 
                                 }  
                             }
                             else
                             {
                                $result = $SIGNAL->createSignal($_POST['nombre'], '');
                                
                                if ($result)
                                    echo "CREATE_OK";
                                else
                                    echo "CREATE_ERROR";
                             }
 			}			
		break;

		case 'editar':
                        $_POST['id']       = str_replace("+", " ", $_POST['id']);
                        $_POST['nombre']   = str_replace("+", " ", $_POST['nombre']);
                        $_POST['filename'] = str_replace("+", " ", $_POST['filename']);
                    
                        $result = $SIGNAL->getSignal
                                           ('
                                               WHERE NOMBRE     =   "'.$_POST['nombre'].'" 
                                               AND   ID_SIGNAL  <>  "'.$_POST['id'].'"
                                            ');
                        $existe = mysql_num_rows($result);
			//$existe=null; //para saltar validacion si existe nombre de FTP
                        
			if ($existe)
                            echo 'EDIT_EXISTS';
			else
                        {	
                            if ($_FILES['signalImagen']['tmp_name'])
                            {
                                $tmp_name = $_FILES['signalImagen']['tmp_name'];
                                $imagen = getimagesize($tmp_name);

                                switch ($imagen[2])
                                {
                                    case 1:
                                        $imagen_tipo = "gif";
                                        break;
                                    case 2: 
                                        $imagen_tipo = "jpg";
                                        break;
                                    case 3: 
                                        $imagen_tipo = "png";
                                        break;
                                }

                                if ($_FILES["signalImagen"]["size"] > SIGNAL_IMG_MAXSIZEBYTES)
                                    echo "EDIT_IMG_MAXSIZEBITS";

                                else if ($imagen[0] > SIGNAL_IMG_MAXSIZEPIXELS || $imagen[1] > SIGNAL_IMG_MAXSIZEPIXELS)
                                    echo "EDIT_IMG_MAXSIZEPIXELS";

                                else if (!$imagen_tipo) 
                                    echo "EDIT_IMG_FORMAT";
                                else
                                { 
                                    if ( !@is_uploaded_file($_FILES['signalImagen']['tmp_name']) )
                                        echo "EDIT_ERROR_FILE_UPLOAD";
                                    else
                                    {
                                        $filename = $_POST['id'].".".$imagen_tipo;

                                        if ( !@move_uploaded_file($_FILES['signalImagen']['tmp_name'], SIGNAL_IMG_DIR_PHP.$filename) )
                                            echo "EDIT_ERROR_FILE_COPY";
                                        else
                                        {
                                            $result = $SIGNAL->setSignal($_POST['id'], $_POST['nombre'], $filename);

                                            if ($result)
                                                echo "EDIT_OK";
                                            else
                                            {
                                                @unlink(SIGNAL_IMG_DIR_PHP.$filename);
                                                echo "EDIT_ERROR";
                                            }
                                        }
                                    } 
                                }  
                            }
                            else
                            {
                                if ($_POST['noimagen'])
                                    $filename = "";
                                else
                                    $filename = $_POST['filename'];
                                    
                                $result = $SIGNAL->setSignal($_POST['id'], $_POST['nombre'], $filename);
                                
                                if ($result)
                                {    
                                    if ($_POST['noimagen'])
                                        @unlink(SIGNAL_IMG_DIR_PHP.$_POST['filename']);
                                    
                                    echo "EDIT_OK";
                                }
                                else
                                    echo "EDIT_ERROR";
                            }
			}			
		break;
		
		case 'eliminar':
                            
                        $result = $SIGNAL->delSignal($_GET['id']);

                        if ($result)
                            echo 'DELETE_OK';				
                        else
                            echo 'DELETE_ERROR';
    		break;

                case 'listar':
                    $result = $SIGNAL->getSignal('ORDER BY NOMBRE');

                    echo '[';

                    while($signals=mysql_fetch_assoc($result))
                    {
                        $json .= 
                            '{
                            "id"      :  "'.$signals["ID_SIGNAL"].'",
                            "nombre"  :  "'.$signals["NOMBRE"].'",
                            "imagen"  :  "'.$signals["IMG"].'"
                             }, ';
                    }

                    $json = mb_substr($json, 0, -2); //quita ',' al final al ultimo objeto
                    echo  $json;

                    echo ']';                    
                break;                
	}
        
function listdelSignal()
{
    $SIGNAL = new ftp_signal();
    $result = $SIGNAL->getSignal("ORDER BY NOMBRE");
    
    while($item = mysql_fetch_assoc($result))
    {
        
        if ($item['IMG'])
            $imagen = SIGNAL_IMG_DIR_HTML.$item['IMG'].'?'.time();
        else
            $imagen = '../include/img/default-signal.png';
            
        $listSignal .= '<div class="lista_signal">';
        $listSignal .= '<span><input type="checkbox" name="signalEliminar" value="'.$item['ID_SIGNAL'].'"> '.$item['NOMBRE'].'</span><br/>';
        $listSignal .= '<img class="img_signal_del" src="'.$imagen.'">';
        $listSignal .= '</div>';
    }
    
    return $listSignal;
}        
?>
