$(document).ready(function(){
/**
*
* Descripción. instancia dataTable para listar tarifas de choferes.
* @author Adrián 10-04-2018
*/
var configuracion = {
    idTabla:'tablaListarTarChoferes',
    ruta:'',
    rutaParametro: tarifasDatatable,
    columnas:   [
      {data:'destino'},
      {data:'servicios'},
      {data:'fechas'},
      {data:'tipo_vehiculo'},
      {data:'precio'},
      {data:'action', orderable: false}
    ]
};

instanciarDataTableServerSide(configuracion);
enrutarFormDelete("#tablaListarTarChoferes", 'choferes/tarifas/eliminar');

$('#createTarChof').on('click', function(e){
  guardar_registro('FormCrearTarCho', null, '#createTarChof', 'message_tar_cho', '#tablaListarTarChoferes', '#modalTarifasChofer');
});

$('#updateTarChof').on('click', function(e){
  guardar_registro('FormUpdateTarCho', null, '#updateTarChof', 'message_tar_e_cho', '#tablaListarTarChoferes', '#modalTarifasChoferEditar');
});

});


function jsCrearTarChofer(){
  select2Ubicacion('#cod_pais_tar', '#cod_estado_tar', '#cod_ciudad_tar', null, null, null, '#cod_destino_tar', null, '#servicio', null, 'chofer');
  select2TipoVehiculo('#tipo_vehiculo');
}

function jsEditarTarChofer(paisres, estadores, ciudadres, destino, servicio, guia_id){

enrutarFormEditTarifas("#tablaListarTarChoferes tbody", "choferes");

 // select2Ubicacion('#cod_pais_tar_guia_edit', '#cod_estado_tar_guia_edit', '#cod_ciudad_tar_guia_edit', paisres, estadores, ciudadres, '#cod_destino_edit', '1', '#servicio_edit_gui', servicio, 'guia');
}

