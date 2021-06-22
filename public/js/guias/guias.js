 $(document).ready(function(){

        $('#cod_tipo_documento, #cod_pais_nacionalidad, #cod_grado_licencia, #cod_estado_res, #cod_ciudad_res').select2();

    });

    function jsCrearGuia(){
      var rutaFinal = '/guias/listar';
      loadWizard('create_guias', rutaFinal, null, 'message_guia');
      select2Ubicacion('#cod_pais_res', '#cod_estado_res', '#cod_ciudad_res');
    }

    function jsEditarGuia(paisres, estadores, ciudadres, nacionalidad, tipo_documento, guia_id){
      var rutaFinal = '/guias/listar';
      loadWizard('update_guias', rutaFinal, null, 'message_guia');
      deshabilitarcampos();
      editar_usuario(guia_id, 'guias');
      select2TipoDocumento('#cod_tipo_documento', tipo_documento);
      select2Nacionalidad('#cod_pais_nacionalidad', nacionalidad);
      select2Ubicacion('#cod_pais_res', '#cod_estado_res', '#cod_ciudad_res', paisres, estadores, ciudadres);
    }
