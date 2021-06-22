$(document).ready(function(){

	/**
	*
	* Descripción. evento que crea un tipo de vehículo nuevo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnCrearTipoVehiculo').on('click', function(e){
		if(validarFormularioCrearTipoVehiculo())
			guardar_registro('formCrearTipoVehiculo', '/tipos_vehiculos/listar', '#btnCrearTipoVehiculo', 'mensajeGestionTipoVehiculo');
	}); 

    /**
	*
	* Descripción. valida los campos del formulario de creación de tipos de vehículos.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioCrearTipoVehiculo(){

        var form = $('#formCrearTipoVehiculo'); 

        form.validate({
            errorPlacement: function (error, element)
            {
                if(element.is(':radio'))
                    element.parents(':eq(1)').append('<br>').append(error);
                else if(element.is('select'))
                    element.parent().append(error);
                else
                    element.after(error);
            },
            messages:{
            },
            rules: {
                "descripcion": 					{required: true, texto: true},
                "cantidad_max_pasajeros": 		{required: true, number: true},
                "cantidad_ventanas": 			{required: true, number: true},
            }
        });

        return form.valid();
    }

});