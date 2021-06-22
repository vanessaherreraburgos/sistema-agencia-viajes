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
		if(validarFormulario())
			guardar_registro('formProveedor', '/proveedores/listar', '#btnGuardar', 'mensajeGestionVehiculo');
	}); 	
	/**
	*
	* Descripción. valida los campos del formulario de edición de vehículos.
	* @author 
	*/
    function validarFormulario(){

        var form = $('#formProveedor'); 

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
                "razon_social":				{alphanum: true},
                "telefono": 				{number: true},
                "modelo": 					{required: true, texto: true},
                "marca": 					{required: true, texto: true},
                "email": 					{alphanum: true},                
            }
        });
        //.settings.ignore = ":hidden:not(#array_fotos_antecedentes)";

        return form.valid();
    }
});