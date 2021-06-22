$(document).ready(function(){

 	var rutaFinal = '/hoteles/listar'; 
    //loadWizard('formHotel', rutaFinal, null,'message_hoteles');    
    $('#cod_pais, #cod_estado, #cod_ciudad, #cod_destino_vende, #cod_tipo_alojamiento, #categoria_hotel','#clase_hab','#tipo_hab','#banco','#tipo_cuenta').select2();
    select2Ubicacion('#cod_pais', '#cod_estado', '#cod_ciudad', null, null, null, '#cod_destino_vende');
    //select2Ubicacion('#pais', '#estado', '#ciudad', null, null, null, '#destino');


    $("#fotos").fileinput({   
        // showDelete: true,
        showUpload: false,
        // showCaption: false,
        // showPreview: false,
        allowedFileExtensions: ["jpg", "png", "jpeg"],
        //maxImageWidth: 250,
        // maxImageHeight: 250,            
        // maxFileCount: 20,
        maxFileSize: 5000,
        language: 'es',                                     
    }); 

    $('#btnCrearInfBasicaHotel').on('click', function(e){
        alert('entro en crear hotel');
        //if(validarFormularioInformacionBasica())
        //    guardar_registro('formHotelInfBasica', '/hoteles/guardar', '#btnCrearInfBasicaHotel', 'mensajeGestionTipoVehiculo');
    }); 

    function validarFormularioInformacionBasica(){
        var form = $('#formHotelInfBasica'); 

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
                "identificacion_fiscal":  {required: true, texto: true},
                "nombre_comercial":       {required: true, texto: true},
                "razon_social":           {required: true, texto: true},
                "cod_pais":               {required: true, number: true},
                "cod_estado":             {required: true, number: true},
                "cod_ciudad":             {required: true, number: true},
                "cod_destino_vende":      {required: true, number: true},
                "direccion_fiscal":       {required: true, texto: true},
                "telefono1":              {required: true, number: true},
                "correo1":                {required: true, texto: true},
            }  
        });

        return form.valid();
    }

    }


    $('#btnCrearTarifaTipoVehiculo').on('click', function(e){
        guardar_registro('formCrearTarifaTipoVehiculo', null, '#btnCrearTarifaTipoVehiculo');
        recargardatatable('#tablaTarifasTipoVehiculo');
    }); 
});