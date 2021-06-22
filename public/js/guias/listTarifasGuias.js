
$(document).ready(function(){
  /**
*
* Descripción. instancia dataTable para listar choferes.
* @author Adriancho 10-04-2018
*/

var configuracion = {
    idTabla:'tablaListarTarGuias',
    ruta:'',
    rutaParametro: tarifasDatatable,
    columnas:   [
      {data:'destino'},
      {data:'servicios'},
      {data:'fechas'},
      {data:'precio'},
      {data:'action', orderable: false}
    ]
};

instanciarDataTableServerSide(configuracion);
enrutarFormDelete("#tablaListarTarGuias", 'guias/tarifas/eliminar');

$('#createTarGuia').on('click', function(e){
  guardar_registro('FormCrearTarGuia', null, '#createTarGuia', 'message_tar_guia', '#tablaListarTarGuias', '#modalTarifasGuia');
});

$('#updateTarGuia').on('click', function(e){
  guardar_registro('FormUpdateTarGuia', null, '#updateTarGuia', 'message_tar_e_guia', '#tablaListarTarGuias', '#modalTarifasGuiaEditar');
});

});

function jsCrearTarGuia(){
select2Ubicacion('#cod_pais_tar_guia', '#cod_estado_tar_guia', '#cod_ciudad_tar_guia', null, null, null, '#destino_tar_guia', null, '#servicio_gui', null, 'guia');
}
function jsEditarTarGuia(paisres, estadores, ciudadres, destino, servicio, guia_id){

enrutarFormEditTarifas("#tablaListarTarGuias tbody", "guias");

 // select2Ubicacion('#cod_pais_tar_guia_edit', '#cod_estado_tar_guia_edit', '#cod_ciudad_tar_guia_edit', paisres, estadores, ciudadres, '#cod_destino_edit', '1', '#servicio_edit_gui', servicio, 'guia');
}



