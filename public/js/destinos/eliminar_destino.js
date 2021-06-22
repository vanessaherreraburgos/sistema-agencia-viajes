$(document).ready(function()
 { 	
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
    		eliminar_registro('formCrearDestino', '/destinos/listar', '#btnCrearDestino');	
    	}		
	});
});