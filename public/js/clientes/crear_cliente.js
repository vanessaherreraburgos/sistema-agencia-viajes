 $(document).ready(function(){
    var rutaFinal = '/clientes/listar';
    loadWizard('formCrearCliente', rutaFinal);
    $('#cod_pais', '#cod_estado', '#cod_ciudad').select2();    
    select2Ubicacion('#cod_pais', '#cod_estado', '#cod_ciudad');  

    $('#foto').fileinput({
    	initialPreview: array_rutas_adjuntos,
    	initialPreviewAsData: true,
    	initialPreviewFileType: 'image',
    	allowedFileTypes:["image", "video"]
    });        
});
