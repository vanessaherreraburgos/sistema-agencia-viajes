$(document).ready(function(){

	/**
	*
	* Descripción. evento que crea un tipo de avión nuevo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnCrearTipoAvion').on('click', function(e){
		if(validarFormularioCrearTipoAvion())
			guardar_registro('formCrearTipoAvion', '/tipos_aviones/listar', '#btnCrearTipoAvion', 'mensajeGestionTipoAvion');
	}); 

    /**
	*
	* Descripción. valida los campos del formulario de creación de tipos de aviones.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioCrearTipoAvion(){

        var form = $('#formCrearTipoAvion'); 

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