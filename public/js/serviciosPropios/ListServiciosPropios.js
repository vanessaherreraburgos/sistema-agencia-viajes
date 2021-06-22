

$(document).ready(function(){

  /**
  * 20/03/2018
  * Descripción. evento que cancela la creación o edición de un servicio propio
  * @author Adrián Felipe Arroyave Tabares
  */
  $('#AddServicioPropio').on('click', function(e){
    $(location).attr('href', conf.baseURL+'/serviciosPropios/crear');
  });

	/**
	*
	* Descripción. instancia dataTable para listar servicios propios.
	* @author Adriancho 29-03-2018
	*/

  var configuracion = {
      idTabla:'tablaListarServiciosPropios',
      ruta:'serviciosPropios/datatable',
      columnas:   [{data:'nombre', orderable: true},
        {data:'descripcion', orderable: true},
        {data:'action', orderable: false}
      ]
  };

  instanciarDataTableServerSide(configuracion);


    // PARA ENRUTAR A LA VISTA DE EDICIÓN ADRIAN - 29/03/2018
    enrutarFormEdit("#tablaListarServiciosPropios tbody", 'serviciosPropios');
    enrutarFormDelete("#tablaListarServiciosPropios", 'serviciosPropios/eliminar');



});




// $(document).ready(function(){
//
// var elementos = [
//   {"data":"placa","orderable":'true'},
//   {"data":"placa","orderable":'true'},
//   {"data":"modelo","orderable":'true'},
//   {"data":"action","orderable":'false'},
// ];
//
// generarDatatable('tablaListarServiciosPropios', 'vehiculos/datatable', elementos);
//
//
// });
//
// //Alejandro y Adrián
// function generarDatatable(id_dt, ruta, elements){
//   $('#'+id_dt).DataTable({
//         // "language": {
//         //     //"processing": "<img src='"+datatable.loader+"' class='img img-responsive'>",
//         //     "url": datatable.language_datatable,
//         // },
//         "processing":true,
//         "searching": false,
//         "serverSide": true,
//         "responsive": true,
//         //"scrollY": "400px",
//         //"scrollX": true,
//         //"dom": 'lTfgtip',
//         "order": [[ 0, "desc" ]],
//         "ajax": {
//             url: conf.baseURL+laroute.route(ruta)
//         },
//         "columns":[
//           elements.forEach(function(element) {
//             {data: element.data, orderable: true}
//           })
//         ]
//     });
// }
