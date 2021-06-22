$(document).ready(function(){

    /**
	*
	* Descripción. Se inicializa el plug in fileinput.
	* @author Johan Alejandro Aguirre Escobar
	*/
	instanciarFileInput('foto', arrayRutaArchivos);

	/**
	*
	* Descripción. evento que edita la información de un avión.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnEditarAvion').on('click', function(e){
		if(validarFormularioEditarAvion())
			guardar_registro('formEditarAvion', '/aviones/listar', '#btnEditarAvion', 'mensajeGestionAviones');
	}); 

    /**
	*
	* Descripción. valida los campos del formulario de edición de aviones.
	* @author Johan Alejandro Aguirre Escobar
	*/
    function validarFormularioEditarAvion(){

        var form = $('#formEditarAvion'); 

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
                "foto_avion":               {extension: validacion.LISTA_BLANCA_IMAGENES_JS, },
                "anno_avion":               {number: true},
                "modelo":                   {required: true, texto: true},
                "marca":                    {required: true, texto: true},
                "cod_tipo_avion":           {required: true, alphanum: true},
                "es_propio":                {required: true, number: true},
                "cod_prov_avion":           {alphanum: true},
                "activo": 					{number: true},
            }
        });

        return form.valid();
    }

});