
$(document).ready(function(){

    /**
    *
    * Descripción. Se inicializa el plug in fileinput.
    * @author Johan Alejandro Aguirre Escobar
    */
    instanciarFileInput('foto');

	/**
	*
	* Descripción. evento que crea un avión nuevo.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('#btnCrearAvion').on('click', function(e){
        if(validarFormularioCrearAvion())
		  guardar_registro('formCrearAvion', '/aviones/listar', '#btnCrearAvion', 'mensajeGestionAviones');
	}); 

    /**
    *
    * Descripción. valida los campos del formulario de creación de aviones.
    * @author Johan Alejandro Aguirre Escobar
    */
    function validarFormularioCrearAvion(){

        var form = $('#formCrearAvion'); 

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
            }
        });

        return form.valid();
    }

});