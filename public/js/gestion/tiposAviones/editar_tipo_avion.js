$(document).ready(function(){

	/**
	*
	* Descripción. evento que edita la información de un tipo de avión.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnEditarTipoAvion').on('click', function(e){
		if(validarFormularioEditarTipoAvion())
			guardar_registro('formEditarTipoAvion', '/tipos_aviones/listar', '#btnEditarTipoAvion', 'mensajeGestionTipoAvion');
	}); 

    /**
	*
	* Descripción. valida los campos del formulario de edición de tipos de avión.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioEditarTipoAvion(){

        var form = $('#formEditarTipoAvion'); 

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
                "cantidad_max_pasajeros":   {required: true, number: true},
                "cantidad_ventanas":        {required: true, number: true},
                "activo": 					{required: true, number: true},
            }
        });

        return form.valid();
    }

});