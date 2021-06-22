 $(document).ready(function()
 { 	

     select2Ubicacion('#pais', '#estado', '#ciudad');    

    $('#pais, #estado, #ciudad').select2();

    $("#fotos").fileinput({   
        // showDelete: true,
        showUpload: false,
        // showCaption: false,
        // showPreview: false,
        allowedFileExtensions: ["jpg", "png", "jpeg"],
        //maxImageWidth: 1250,
        // maxImageHeight: 250,            
        // maxFileCount: 20,
        maxFileSize: 5000,
        language: 'es',                                     
    }); 

    $('#btnCrearDestino').on('click', function(e){

    	var form = $('#formCrearDestino');

    	form.validate ({
    		rules:{
    			pais 		:{ required:true },
    			estado 		:{ required:true },
    			ciudad 		:{ required:true },
    			nombre		:{ required:true },
    			direccion	:{ required:true }
    		}

    	});

    	if (form.valid()){
    		guardar_registro('formCrearDestino', '/destinos/listar', '#btnCrearDestino');	
    	}
		
	});
});
