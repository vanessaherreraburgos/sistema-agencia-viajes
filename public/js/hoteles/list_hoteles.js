$(document).ready(function(){

	/**
	*
	* Descripción. instancia dataTable para listar los hoteles.
	* @author Vanessa Herrera
	*/
    var configuracion = {
        idTabla:'tablaListarHoteles', 
        ruta:'hoteles/datatable', 
        columnas:   [
                     {data:'foto', orderable: false, width: '10%'},
                     {data:'nombre_comercial', orderable: true, width: '20%'},
                     {data:'destino', orderable: true, width: '10%'},
                     {data:'telefonos', orderable: true, width: '10%'},
                     {data:'correos', orderable: true, width: '10%'},
                     {data:'categoria_hotel', orderable: true, width: '10%'},
                     {data:'min_estadia', orderable: true, width: '10%'},
                     {data:'action', orderable: false, width: '20%'}
                    ],       
    };

    instanciarDataTableServerSide(configuracion);

});