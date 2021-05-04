function contador_busqueda(ids) {
    $.ajax({
        type:   "POST",
        url:    "contador.php",
        data: {
            accion         : 'busqueda',
            array_vehiculo : ids
        }
    });
}