$(document).ready(function(){

    /**
	*
	* Descripción. Se inicializa el plug in fileinput.
	* @author Johan Alejandro Aguirre Escobar
	*/
    instanciarFileInput('foto');

	/**
	*
	* Descripción. evento que crea un vehículo nuevo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnCrearVehiculo').on('click', function(e){
		if(validarFormularioCrearVehiculo())
			guardar_registro('formCrearVehiculo', '/vehiculos/listar', '#btnCrearVehiculo', 'mensajeGestionVehiculo');
	}); 

    /**
	*
	* Descripción. valida los campos del formulario de creación de vehículos.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioCrearVehiculo(){

        var form = $('#formCrearVehiculo'); 

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
                "cod_tipo_vehiculo":		{required: true, alphanum: true},
                "es_propio": 				{required: true, number: true},
                "cod_proveedor_vehiculo": 	{alphanum: true},
            }
        });
        //.settings.ignore = ":hidden:not(#array_fotos_antecedentes)";

        return form.valid();
    }

});