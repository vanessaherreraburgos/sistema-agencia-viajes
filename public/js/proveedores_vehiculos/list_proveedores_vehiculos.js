$(document).ready(function()
{
	/**
	*
	* Descripción. instancia dataTable para listar Proveedores de Vehiculos.
	* @author Franklin
	*/
    var configuracion = {
        idTabla:'tablaListarProveedores',
        ruta:'Proveedores/datatable',
        columnas:   [{data:'codigo', orderable: false},                     
                     {data:'razon_social', orderable: true},
                     {data:'nombre', orderable: true},
                     {data:'telefono', orderable: false},
                     {data:'email', orderable: false},
                     {data:'action', orderable: false}
                    ]
    };
    instanciarDataTableServerSide(configuracion);
});
