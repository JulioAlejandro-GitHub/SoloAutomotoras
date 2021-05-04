<?
    $_SESSION['tmp_img_sitio_crear'] += 1;
    
    $partes    = explode(".", $_FILES[fileUpload][name]);
    $extension = end($partes);
    $nom_img   =  "tmp_".$_SESSION['tmp_img_sitio_crear']."_img_".$_SESSION['rut_emp_usr'].".".strtolower($extension); // nombre final
                                         
    $_SESSION['nom_img_crear_sitio_aux'] = $nom_img;
    
    $dir = '../../../blog/img/'; // Definimos Directorio donde se guarda el archivo
?>