

$(document).ready(function(){

	/**
	*
	* Descripción. instancia dataTable para listar tipos de vehículos.
	* @author Johan Alejandro Aguirre Escobar
	*/
    var configuracion = {
        idTabla:'tablaListarTiposVehiculos', 
        ruta:'tipos_vehiculos/datatable', 
        columnas:   [{data:'descripcion', orderable: false},
                     {data:'cantidad_max_pasajeros', orderable: true},
                     {data:'cantidad_ventanas', orderable: true},
                     {data:'activo', orderable: true},
                     {data:'action', orderable: false}
                    ]
    };

    instanciarDataTableServerSide(configuracion);

    /**
    *
    * Descripción. evento que elimina la información de un tipo de vehículo.
    * @author Johan Alejandro Aguirre Escobar
    */
    $('#tablaListarTiposVehiculos tbody').on( 'click', '.eliminarTipoVehiculo', function (e) {
        e.preventDefault();
        eliminar_registro('tipos_vehiculos/eliminar', $(this).attr("href"), '#tablaListarTiposVehiculos');
    }); 

});