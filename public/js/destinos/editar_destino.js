$(document).ready(function()
 { 	
    select2Ubicacion('#pais', '#estado', '#ciudad', 1, 1, 1);
    $('#pais, #estado, #ciudad').select2();

    $('#fotos').fileinput({
    	initialPreview: array_rutas_adjuntos,
    	initialPreviewAsData: true,
    	initialPreviewFileType: 'image',
    	allowedFileTypes:["image", "video"]
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
