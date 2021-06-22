$(document).ready(function(){

    /**
	*
	* Descripción. Se inicializa el plug in fileinput.
	* @author Johan Alejandro Aguirre Escobar
	*/
	instanciarFileInput('foto', arrayRutaArchivos);

	/**
	*
	* Descripción. evento que edita la información de un vehículo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnEditarVehiculo').on('click', function(e){
		if(validarFormularioEditarVehiculo())
			guardar_registro('formEditarVehiculo', '/vehiculos/listar', '#btnEditarVehiculo', 'mensajeGestionVehiculo');
	}); 

    /**
	*
	* Descripción. valida los campos del formulario de edición de vehículos.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioEditarVehiculo(){

        var form = $('#formEditarVehiculo'); 

        form.validate({
            errorPlacement: function (error, element)
            {
                if(element.is(':radio'))
                    element.parents(':eq(1)').append('<br>').append(error);
                else if(element.is('select'))
                    element.parent().append(error);
                else if(element.is(':file'))
                    element.parents(':eq(3)').after(error);
                else
                    element.after(error);
            },
            messages:{
            },
            rules: {
                "foto_vehiculo": 			{extension: validacion.LISTA_BLANCA_IMAGENES_JS, },
                "placa": 					{alphanum: true},
                "numero": 					{number: true},
                "anno_vehiculo": 			{number: true},
                "modelo": 					{required: true, texto: true},
                "marca": 					{required: true, texto: true},
                "color": 					{alpha: true},
                "cod_tipo_vehiculo":        {required: true, alphanum: true},
                "es_propio": 				{required: true, number: true},
                "cod_proveedor_vehiculo": 	{alphanum: true},
                "activo": 					{number: true},
            }
        });
        //.settings.ignore = ":hidden:not(#array_fotos_antecedentes)";

        return form.valid();
    }

});