$(document).ready(function()
{
	/**
	*
	* Descripción. instancia dataTable para listar Clientes.
	* @author Franklin
	*/
    var configuracion = {
        idTabla:'tablaListarClientes',
        ruta:'clientes/datatable',
        columnas:   [{data:'foto_cliente', orderable: false},
                     {data:'cod_tipo_cliente', orderable: true},
                     {data:'nombre_comercial', orderable: true},
                     {data:'cod_pais', orderable: true},
                     {data:'telefono1', orderable: false},
                     {data:'action', orderable: false}
                    ]
    };
    instanciarDataTableServerSide(configuracion);
});
