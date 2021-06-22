$(document).ready(function()
{
    /**
    *
    * Descripción. instancia dataTable para listar destinos.
    * @author Franklin
    */
    var configuracion = {
        idTabla:'tablaListarDestinos',
        ruta:'destinos/datatable',
        columnas:   [{data:'descripcion', orderable: true},
                     {data:'direccion', orderable: true},
                     {data:'km_recorrer', orderable: false},
                     {data:'cant_dias_traslado', orderable: false},
                     {data:'action', orderable: false}
                    ]
    };
    instanciarDataTableServerSide(configuracion);

    
});

/*    
//nuevo destino
function nuevo_destino(){
    // console.log(conf.baseURL+laroute.route('destinos_crear'));
    // $(location).attr('href', conf.baseURL+laroute.route('destinos_crear'));
    $(location).attr('href', conf.baseURL+"/destinos/crear");
}

//editar destino
function editar_destino(){
    // $(location).attr('href', conf.baseURL + laroute.route('destinos_editar'));
    $(location).attr('href', conf.baseURL+"/destinos/editar");
}

//eliminar destino
function eliminar_destino(){
    // $(location).attr('href', conf.baseURL + laroute.route('destinos_eliminar'));
    $(location).attr('href', conf.baseURL+"/destinos/eliminar");
}
*/