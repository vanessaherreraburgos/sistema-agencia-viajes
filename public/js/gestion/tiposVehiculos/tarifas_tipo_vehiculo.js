$(document).ready(function(){

	/**
	*
	* Descripción. instancia dataTable para listar tarifas de un 
	* tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
    var configuracion = {
        idTabla:'tablaTarifasTipoVehiculo',
        ruta:'',
        rutaParametro: tarifasTipoVehiculoDatatable,
        columnas:   [{data:'fechas', orderable: true},
                     {data:'cod_destino', orderable: true},
                     {data:'cod_serv_tipo_veh', orderable: true},
                     {data:'precio_usd', orderable: true},
                     {data:'action', orderable: false}
                    ]
    };

    instanciarDataTableServerSide(configuracion);

    /**
	*
	* Descripción. se carga paises, estados, ciudades, destinos
	* @author Johan Alejandro Aguirre Escobar
	*/
	select2Ubicacion('#pais_crear', '#estado_crear', '#ciudad_crear', null, null, null, '#destino_crear');

	/**
	*
	* Descripción. evento para abrir ventana modal para 
	* crear una nueva tarifa de un tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnNuevaTarifa').on( 'click', function () {

		// se resetea los campos del formulario.
		$('#formCrearTarifaTipoVehiculo')[0].reset();
		// $("#pais_crear, #estado_crear, #ciudad_crear, #destino_crear").each(function(){
		//     if($(this).hasClass("select2-hidden-accessible")){
		//     	console.log('existe isntancia select2');
		//     	$(this).select2('destroy'); 
		//     }
		// });
		// select2Ubicacion('#pais_crear', '#estado_crear', '#ciudad_crear', null, null, null, '#destino_crear');

		$('.selectBusqueda').select2({'width': '100%'});
		$("#modalCrearTarifaTipoVehiculo").modal();
	});

	/**
	*
	* Descripción. evento que crea una nueva tarifa de un
	* tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnCrearTarifaTipoVehiculo').on('click', function(e){
		if(validarFormularioTarifasTipoVehiculo('#formCrearTarifaTipoVehiculo'))
			guardar_registro('formCrearTarifaTipoVehiculo', null, '#btnCrearTarifaTipoVehiculo', 'mensajeCrearTarifaTipoVeh', '#tablaTarifasTipoVehiculo', '#modalCrearTarifaTipoVehiculo');
	}); 

	/**
	*
	* Descripción. evento para abrir ventana modal para 
	* editar la información de una tarifa de un tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#tablaTarifasTipoVehiculo tbody').on( 'click', '.editarTarifaTipoVehiculo', function (e) {

		e.preventDefault();
		var load = $(this).ladda();
        load.ladda('start');

		$.get( $(this).attr("href") )
		.done(function(response) {

			$('#formEditarTarifaTipoVehiculo')
            .find('[name="codigo"]').val(response.codigo).end()
            .find('[name="fecha_inicial"]').val(response.fecha_inicial).end()
            .find('[name="fecha_final"]').val(response.fecha_final).end()
            .find('[name="precio_usd"]').val(response.precio_usd).end();

            select2Ubicacion('#pais_editar', '#estado_editar', '#ciudad_editar', response.cod_pais, response.cod_estado, response.cod_ciudad, '#destino_editar', response.cod_destino);

            $('[name="cod_serv_tipo_veh"]').val(response.cod_serv_tipo_veh).trigger('change');

			$("#modalEditarTarifaTipoVehiculo").modal();
		})
		.fail(function() {
			alert( "error" );
		})
		.always(function() {
			load.ladda('stop'); 
		});
	});

	/**
	*
	* Descripción. evento que edita la información de una tarifa de
	* un tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnEditarTarifaTipoVehiculo').on('click', function(e){
		if(validarFormularioTarifasTipoVehiculo('#formEditarTarifaTipoVehiculo'))
			guardar_registro('formEditarTarifaTipoVehiculo', null, '#btnEditarTarifaTipoVehiculo', 'mensajeEditarTarifaTipoVeh', '#tablaTarifasTipoVehiculo', '#modalEditarTarifaTipoVehiculo');
	});

	/**
	*
	* Descripción. evento que elimina la información de una tarifa de un
	* tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#tablaTarifasTipoVehiculo tbody').on( 'click', '.eliminarTarifaTipoVehiculo', function (e) {
		e.preventDefault();
		eliminar_registro('tipos_vehiculos/tarifas/eliminar', $(this).attr("href"), '#tablaTarifasTipoVehiculo');
	}); 

	/**
	*
	* Descripción. valida los campos del formulario de creación o
	* edición de tarifas de un tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioTarifasTipoVehiculo(form){

        var form = $(form); 

        form.validate({
            errorPlacement: function (error, element)
            {
                if(element.is('select'))
                    element.parent().append(error);
                else
                    element.after(error);
            },
            messages:{
            },
            rules: {
                "codigo": 				{number: true},
                "cod_pais": 			{number: true},
                "cod_estado": 			{number: true},
                "cod_ciudad": 			{number: true},
                "cod_destino": 			{required: true, number: true},
                "cod_serv_tipo_veh": 	{required: true, number: true},
                "fecha_inicial": 		{required: true, date_dmy: true},
                "fecha_final": 			{required: true, date_dmy: true},
                "precio_usd": 			{required: true, number: true},
            }
        });
        // .settings.ignore = ":hidden:not(#codigo)";

        return form.valid();
    }

});