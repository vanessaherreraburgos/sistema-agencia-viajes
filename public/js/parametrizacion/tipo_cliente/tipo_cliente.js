
$(document).ready(function(){

	/**
	*
	* Descripción. instancia dataTable para listar tipos de clientes
	* @author Stiven
	*/
    var configuracion = {
        idTabla:'tablaListarTipoCliente', 
        ruta:'tipo_cliente/datatable', 
        columnas:   [
                     {data:'codigo', orderable: false},
                     {data:'descripcion', orderable: true},
                     {data:'porcentaje_dscto', orderable: true},                     
                     {data:'action', orderable: false, searchable: false}
                    ]
    };

    instanciarDataTableServerSide(configuracion);

    /**
    *
    * Descripción. evento que elimina la información de un tipo cliente
    * @author Stiven
    */
    $('#tablaListarTipoCliente tbody').on( 'click', '.eliminarVehiculo', function (e) {
        e.preventDefault();
        eliminar_registro('vehiculos/eliminar', $(this).attr("href"), '#tablaListarVehiculos');
    }); 

});
