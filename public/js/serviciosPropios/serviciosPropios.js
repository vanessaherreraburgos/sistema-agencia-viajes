$(document).ready(function(){
  /**
  *
  * Descripción. evento que crea un servicio propio nuevo. ( guarda desde el wizard)
  * @author Adrián Felipe Arroyave Tabares
  */
  $('#btnCrearServicioPropio').on('click', function(e){
    guardar_registro('create_servicios_propios', '/serviciosPropios/listar', '#btnCrearServicioPropio', 'message_servicio_propio');
  });

  /**
  *
  * Descripción. evento que edita un servicio propio ( guarda la ediciòn desde el wizard)
  * @author Adrián Felipe Arroyave Tabares
  */
  $('#btnEditarServicioPropio').on('click', function(e){
    guardar_registro('update_servicios_propios', '/serviciosPropios/listar', '#btnEditarServicioPropio', 'message_servicio_propio');
  });

  /**
  *
  * Descripción. evento que cancela la creación o edición de un servicio propio
  * @author Adrián Felipe Arroyave Tabares
  */
  $('#btnCancelarServicioPropio').on('click', function(e){
    $(location).attr('href', conf.baseURL+'/serviciosPropios/listar');
  });



});
