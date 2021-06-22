
$(document).ready(function(){

	/**
	*
	* Descripción. instancia dataTable para listar vehículos.
	* @author Johan Alejandro Aguirre Escobar
	*/
    var configuracion = {
        idTabla:'tablaListarVehiculos', 
        ruta:'vehiculos/datatable', 
        columnas:   [
                     {data:'foto', orderable: false},
                     {data:'numero', orderable: true},
                     {data:'especificaciones', orderable: true},
                     {data:'cod_tipo_vehiculo', orderable: true},
                     {data:'cod_proveedor_vehiculo', orderable: true},
                     {data:'activo', orderable: true, searchable: false},
                     {data:'action', orderable: false, searchable: false}
                    ]
    };

    instanciarDataTableServerSide(configuracion);

    /**
    *
    * Descripción. evento que elimina la información de un vehículo.
    * @author Johan Alejandro Aguirre Escobar
    */
    $('#tablaListarVehiculos tbody').on( 'click', '.eliminarVehiculo', function (e) {
        e.preventDefault();
        eliminar_registro('vehiculos/eliminar', $(this).attr("href"), '#tablaListarVehiculos');
    }); 

});
