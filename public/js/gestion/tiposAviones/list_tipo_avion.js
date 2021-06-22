

$(document).ready(function(){

	/**
	*
	* Descripción. instancia dataTable para listar tipos de aviones.
	* @author Johan Alejandro Aguirre Escobar
	*/
    var configuracion = {
        idTabla:'tablaListarTiposAviones', 
        ruta:'tipos_aviones/datatable', 
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
    * Descripción. evento que elimina la información de un tipo de avión.
    * @author Johan Alejandro Aguirre Escobar
    */
    $('#tablaListarTiposAviones tbody').on( 'click', '.eliminarTipoAvion', function (e) {
        e.preventDefault();
        eliminar_registro('tipos_aviones/eliminar', $(this).attr("href"), '#tablaListarTiposAviones');
    }); 

});