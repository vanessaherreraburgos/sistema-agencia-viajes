$(document).ready(function(){
  /**
  *
  * Descripción. instancia dataTable para listar choferes.
  * @author Adriancho 10-04-2018
  */
  var configuracion = {
    idTabla:'tablaListarTarifasServiciosPropios',
    ruta:'',
    rutaParametro: tarifasDatatable,
    columnas:   [
      {data:'fechas'},
      {data:'precio'},
      {data:'action', orderable: false}
    ]
  };

  instanciarDataTableServerSide(configuracion);
  enrutarFormEditTarifas("#tablaListarTarifasServiciosPropios tbody", "servicio_propio");
  enrutarFormDelete("#tablaListarTarifasServiciosPropios", 'tarifasServiciosPropios/eliminar');
});

$('#createTarSrvProp').on('click', function(e){
  guardar_registro('FormCrearTarSerPro', null, '#createTarSrvProp', 'message_tar_servicio_propio', '#tablaListarTarifasServiciosPropios','#modalTarifasServPropios');
});
$('#updateTarSrvProp').on('click', function(e){
  guardar_registro('FormEditTarSerProp', null, '#updateTarSrvProp', 'message_tar_e_servicio_propio', '#tablaListarTarifasServiciosPropios','#modalTarifasServPropiosEditar');
});
