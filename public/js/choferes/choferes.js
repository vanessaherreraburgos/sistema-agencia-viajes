 $(document).ready(function(){
        $('#cod_tipo_documento, #cod_pais_nacionalidad, #cod_grado_licencia, #cod_pais_res, #cod_estado_res, #cod_ciudad_res').select2();


    });
    function jsCrearChofer(){
      var rutaFinal = '/choferes/listar';
      loadWizard('create_choferes', rutaFinal, null, 'message_chofer');
      select2Ubicacion('#cod_pais_res', '#cod_estado_res', '#cod_ciudad_res');
    }

    function jsEditarChofer(paisres, estadores, ciudadres, nacionalidad, tipo_documento, licencia, chofer_id){
      var rutaFinal = '/choferes/listar';
      loadWizard('update_choferes', rutaFinal, null, 'message_chofer');
      deshabilitarcampos();
      editar_usuario(chofer_id, 'choferes');
      select2TipoDocumento('#cod_tipo_documento', tipo_documento);
      select2Nacionalidad('#cod_pais_nacionalidad', nacionalidad);
      select2_num_licencia('#cod_grado_licencia', licencia);
      select2Ubicacion('#cod_pais_res', '#cod_estado_res', '#cod_ciudad_res', paisres, estadores, ciudadres);
    }
