 $(document).ready(function()
 { 	
    $("#tab-1").parent().addClass("active");    

    $('#btnCancelar').on('click', function(e){
        
    }); 
    $('#tab-1').on('click', function(e){        
        event.preventDefault();             
        $("#contact2").removeClass("show");
        $("#contact3").removeClass("show");
        $("#contact1").show("slow");
        $("#contact2").hide();
        $("#contact3").hide();          
    }); 
    $('#tab-2').on('click', function(e){ 
        event.preventDefault();     
        $("#contact1").removeClass("show");
        $("#contact3").removeClass("show"); 
        $("#contact1").hide();
        $("#contact3").hide();                  
        $("#contact2").show("slow");        
    }); 
    $('#tab-3').on('click', function(e){        
        event.preventDefault();     
        $("#tab-1").removeClass("show");
        $("#tab-2").removeClass("show");
        $("#contact3").show("slow");        
        $("#contact1").hide();
        $("#contact2").hide();          
        $("#contact2").removeClass("show");
        $("#contact1").removeClass("show");         
        
    }); 
     
    $('#btnGuardar').on('click', function(e){

    	var form = $('#formProveedor');

    	form.validate ({
    		rules:{
    			razon_social     :{ required:true },
    			telefono 	     :{ required:true },
    			email 		     :{ required:true },    			
    		}
    	});

    	if (form.valid()){
    		guardar_registro('formProveedor', '/proveedores/listar', '#btnGuardar');	
    	}
		
	});
});
