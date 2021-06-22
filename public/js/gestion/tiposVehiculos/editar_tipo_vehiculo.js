$(document).ready(function(){

	/**
	*
	* Descripción. evento que edita la información de un tipo de vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnEditarTipoVehiculo').on('click', function(e){
		if(validarFormularioEditarTipoVehiculo())
			guardar_registro('formEditarTipoVehiculo', '/tipos_vehiculos/listar', '#btnEditarTipoVehiculo', 'mensajeGestionTipoVehiculo');
	}); 

    /**
	*
	* Descripción. valida los campos del formulario de edición de tipos de vehículos.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioEditarTipoVehiculo(){

        var form = $('#formEditarTipoVehiculo'); 

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
                "descripcion":              {required: true, texto: true},
                "cantidad_max_pasajeros":   {number: true},
                "cantidad_ventanas":        {number: true},
                "activo": 					{number: true},
            }
        });

        return form.valid();
    }

});