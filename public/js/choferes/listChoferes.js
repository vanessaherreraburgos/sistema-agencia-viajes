$(document).ready(function(){

  /**
  * 31/03/2018
  * Descripción. evento que carga el formulario de nuevo chofer
  * @author Adrián Felipe Arroyave Tabares
  */
  $('#AddChofer').on('click', function(e){
    $(location).attr('href', conf.baseURL+'/choferes/crear');
  });


  /**
  *
  * Descripción. instancia dataTable para listar choferes.
  * @author Adriancho 31-03-2018
  */

  var configuracion = {
      idTabla:'tablaListarChoferes',
      ruta:'choferes/datatable',
      columnas:   [
        {data:'foto'},
        {data:'cod_tipo_documento', orderable: true},
        {data:'nombre', orderable: true},
        {data:'residencia', orderable: true},
        {data:'telefonos', orderable: true},
        {data:'email', orderable: true},
        {data:'cod_grado_licencia', orderable: true},
        {data:'vigencia_licencia', orderable: true},
        {data:'action', orderable: false, "width": "15%"}
      ]
  };

  instanciarDataTableServerSide(configuracion);

    // PARA ENRUTAR A LA VISTA DE EDICIÓN ADRIAN - 29/03/2018
    enrutarFormEdit("#tablaListarChoferes tbody", 'choferes');
    enrutarFormDelete("#tablaListarChoferes", 'choferes/eliminar');

  });
