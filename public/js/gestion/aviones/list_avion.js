
$(document).ready(function(){

	/**
	*
	* Descripción. instancia dataTable para listar aviones.
	* @author Johan Alejandro Aguirre Escobar
	*/
    var configuracion = {
        idTabla:'tablaListarAviones', 
        ruta:'aviones/datatable', 
        columnas:   [{data:'foto', orderable: false},
                     {data:'anno_avion', orderable: true},
                     {data:'modelo', orderable: true},
                     {data:'marca', orderable: true},
                     {data:'tipo_avion', orderable: true},
                     {data:'cod_prov_avion', orderable: true},
                     {data:'activo', orderable: true},
                     {data:'action', orderable: false, searchable: false}
                    ]
    };

    instanciarDataTableServerSide(configuracion);

    /**
    *
    * Descripción. evento que elimina la información de un avión.
    * @author Johan Alejandro Aguirre Escobar
    */
    $('#tablaListarAviones tbody').on( 'click', '.eliminarAvion', function (e) {
        e.preventDefault();
        eliminar_registro('aviones/eliminar', $(this).attr("href"), '#tablaListarAviones');
    }); 

});
