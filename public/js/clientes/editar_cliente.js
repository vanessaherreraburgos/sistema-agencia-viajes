$(document).ready(function()
 { 	
 	loadWizard('formCliente', '/clientes/listar');    
    select2Ubicacion('#cod_pais', '#cod_estado', '#cod_ciudad',pais, estado, ciudad);    
    $('#cod_pais', '#cod_estado', '#cod_ciudad').select2();
    
    $('#foto').fileinput({
    	initialPreview: array_rutas_adjuntos,
    	initialPreviewAsData: true,
    	initialPreviewFileType: 'image',
    	allowedFileTypes:["image", "video"]
    });     
});