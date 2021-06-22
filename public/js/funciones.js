
// Función para mostrar mensaje de error.
   // ======================================
   function mensajeError(idMensaje, mensaje,timeout=1){

        $('#'+idMensaje).parents(':eq(2)').removeClass("navy-bg yellow-bg").addClass("red-bg");
        $('#'+idMensaje).html('<p font-color="red">'+mensaje+'</p>');
        $('#'+idMensaje).parent().prev().find('i').removeClass().addClass('icon-eliminar_b fa-3x');
        $('#'+idMensaje).parents(':eq(2)').fadeIn('slow');
        if (timeout == 1)
            setTimeout(function(){ $('#'+idMensaje).parents(':eq(2)').fadeOut('slow'); }, 10000);
    }

//documentar
function guardar_registro(idFormSave, rutaFinal=null, buttonSave=null, error=null, idDataTableRecargar=null, modalhide=null){
    // animación del botón guardar
    if(buttonSave){
        var load = $(buttonSave).ladda();
        load.ladda('start');
    }

	var formData = new FormData(document.getElementById(idFormSave));

    var form = $('#'+idFormSave);

    $.ajax({
        headers: { "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content'), },
        url:            form.attr('action'),
        type:           form.attr('method'),
        enctype:        'multipart/form-data',
        data:           formData,
        cache:          false,
        contentType:    false,
        processData:    false,
        success: function(data){
            if(data.success === true){

                // mensaje de exito para guardar la información
                var mensaje1 = mensajes_generales.exito_guardar;
                // mensaje1 = mensaje1.replace(general.string_replace, mensaje);
                swal({
                        title: mensajes_generales.mensaje_exito,
                        confirmButtonColor: "#1e8ac2",
                        text: mensaje1,
                        confirmButtonText: mensajes_generales.swal_aceptar,
                        type: "success"
                    },
                    function(isConfirm) {
                        // validar si el usuario confirmo el suit alert
                        if (isConfirm) {
                            // console.log(conf.baseURL + laroute.route(rutaFinal));

                            if (rutaFinal !== null) {
                                $(location).attr('href', conf.baseURL+rutaFinal);
                            }

                            if (modalhide != null) { 
                                $(modalhide).modal('hide'); 
                            }
                        }
                    });
            }else if(data.success === false){

                // mensaje de exito para guardar la información
                var mensaje1 = mensajes_generales.error_guardar;
                // mensaje1 = mensaje1.replace(general.string_replace, mensaje);
                swal({
                        title: mensajes_generales.mensaje_error,
                        confirmButtonColor: "#1e8ac2",
                        text: mensaje1,
                        confirmButtonText: mensajes_generales.swal_aceptar,
                        type: "warning"
                    },
                    function(isConfirm) {
                        // validar si el usuario confirmo el suit alert
                        if (isConfirm) {
                            // console.log(conf.baseURL + laroute.route(rutaFinal));
                            if (rutaFinal !== null) {
                                $(location).attr('href', conf.baseURL+rutaFinal);
                            }
                        }
                    });
                }else if (data.fecha_invalida) {
                    modalhide = null;
                    swal(mensajes_generales.advertencia_title, mensajes_generales.fechas_inv_tar, "warning");
                }else if (data.errors) {
                    // console.log(data.errors);
                    var cadenaErrores = '';
                    var linea_error;
                     $.each( data.errors, function( key, value ) {
                        linea_error = "- " + value + "<br>";
                        cadenaErrores = cadenaErrores.concat(linea_error);
                    });
                    mensajeError(error, cadenaErrores);
                }else{
                    var mensaje1 = mensajes_generales.error_guardar;
                    // mensaje1 = mensaje1.replace(general.string_replace, mensaje);
                    // mensaje de error al guardar la informaci�n
                    mensajeError(error, mensaje1);
                }
        },
        error: function(jqXHR, textStatus, errorThrown){

            if(jqXHR.status===401){ location.href = conf.baseURL + '/login'; }
        },
        complete: function() {
            // if (modalhide != null) { $(modalhide).modal('hide'); }
            if (idDataTableRecargar != null) {  recargardatatable(idDataTableRecargar); }
            if(buttonSave)
                load.ladda('stop');
        }
    });
}

//documentar
// el input del form debe tener un id con el mismo nombre del campo de la base de datos
function editar_usuario(id_perfil, perfil){
    var id = id_perfil;
    //la variable ruta se declara así porque no permite el conf.baseURL dentro de la función por lo que es llamada desde un blade
    var ruta = "http://localhost/kuravaina/public/"+perfil+"/consultar";
    $.ajax({
        url: ruta,
        type: 'GET',
        data: {id: id},
        success: function(data){
                  for (var i in data) {
                        $("#"+i).val(data[i]);
                        //problema con selects, file, caché
                  }

                  if (perfil == 'tarifas_guias') {
                    var servicio = data['servicio'];
                    var destino = data['cod_destino'];
                    var pais = data['cod_pais']
                    var estado = data['cod_estado']
                    var ciudad = data['cod_ciudad']
                    select2Ubicacion('#cod_pais_tar_guia_edit', '#cod_estado_tar_guia_edit', '#cod_ciudad_tar_guia_edit', pais, estado, ciudad, '#cod_destino_edit', destino, '#servicio_edit_gui', servicio, 'guia');

                  }else if (perfil == 'tarifas_choferes') {
                    var servicio = data['servicio'];
                    var destino = data['cod_destino'];
                    var pais = data['cod_pais']
                    var estado = data['cod_estado']
                    var ciudad = data['cod_ciudad']
                    var tipo_vehiculo = data['cod_tipo_vehiculo']
                    select2Ubicacion('#cod_pais_tar_chofer_edit', '#cod_estado_tar_chofer_edit', '#cod_ciudad_tar_chofer_edit', pais, estado, ciudad, '#cod_destino_tar_chofer_edit', destino, '#servicio_cho', servicio, 'chofer');
                    select2TipoVehiculo('#tipo_vehiculo_editar', tipo_vehiculo, pais);
                  }
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR.status);
            console.log(errorThrown);
            if(jqXHR.status===500){
                // error de respuesta del servidor
                console.log(errores.conexion_servidor);

            }
            if(jqXHR.status===401){
                // error de Unauthorized se pierde la sesión
                location.href = conf.baseURL + '/login';
            }
        }

        });
}


//documentar
function loadWizard(id, rutaFinal, idButton = null, error_message = null ){
        $("#wizard").steps();
        $("#"+id).steps({
            bodyTag: "fieldset",
            transitionEffect: 1,
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex)
                {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18)
                {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex)
            {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18)
                {
                    $(this).steps("Siguiente");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3)
                {
                    $(this).steps("Anterior");
                }
            },
            onFinishing: function (event, currentIndex)
            {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                // var form = $(this);
                // alert("ff");
                // // Submit form input
                // form.submit();
                guardar_registro(id, rutaFinal, idButton, error_message);
            }
        }).validate({
                    errorPlacement: function (error, element)
                    {
                        element.before(error);
                    },
                    rules: {
                        confirm: {
                            equalTo: "#password"
                        }
                    }
                });
}

function select2Ubicacion(select2_pais, select2_estado, select2_ciudad, pais_usuario=null, estado_usuario=null, ciudad_usuario=null, select2_destino=null, destino_usuario=null, select2_servicio = null, servicio_usuario=null, tipo_servidor=null){
   
    $(select2_pais+','+select2_estado+','+select2_ciudad+','+select2_destino+','+select2_servicio).select2({ width:'100%' });
    var baseURL = 'http://localhost/kuravaina/public/';
    // verificar variables
        pais_usuario     = pais_usuario    === '' || pais_usuario    === 'null' ? null: pais_usuario;
        estado_usuario   = estado_usuario  === '' || estado_usuario  === 'null' ? null: estado_usuario;
        ciudad_usuario   = ciudad_usuario  === '' || ciudad_usuario  === 'null' ? null: ciudad_usuario;
        destino_usuario  = destino_usuario === '' || destino_usuario === 'null' ? null: destino_usuario;
        servicio_usuario  = servicio_usuario === '' || servicio_usuario === 'null' ? null: servicio_usuario;
    // constantes
    // ruta para consultar todos los paises

    var ruta_pais = conf.baseURL+"/list/paises";//'list/paises';


    //instanciar el select2 de paises
        //formatoSelect2(select2_pais, select2.pais);
    // cargar la lista de paises
         ajaxGenericoSelect2(ruta_pais, select2_pais, pais_usuario, null, null,  select2.pais);

    //crear evento para cambiar estados al cargar el pais
        var eventPais = $(select2_pais);

        eventPais.on("select2:select",function(e){
            estados(select2_estado, select2_ciudad, select2_destino, $(this).val(), null, null, null, select2_servicio, null, tipo_servidor);
        });
    //crear evento para cambiar las ciudades según el estado seleccionado
        var eventEstado = $(select2_estado);
        eventEstado.on("select2:select",function(e){
            ciudades(select2_ciudad, select2_destino, $(this).val());
        });
        if(select2_destino!==null){
            //crear evento para cambiar los destinos según la ciudad seleccionada
            var eventCiudad = $(select2_ciudad);
            eventCiudad.on("select2:select",function(e){
                destinos(select2_destino, $(this).val());
            });
        }
        if(select2_servicio!==null){
            //crear evento para cambiar los destinos según la ciudad seleccionada
            var eventDestino = $(select2_destino);
            eventDestino.on("select2:select",function(e){
                servicios(select2_servicio, $(this).val());
            });
        }
    //inicializar los estados y ciudades dependiente de un pais pre cargado o no


        if(pais_usuario!==null){
                estados(select2_estado, select2_ciudad, select2_destino, pais_usuario, estado_usuario, ciudad_usuario, destino_usuario, select2_servicio, servicio_usuario, tipo_servidor);
            }else{
                $(select2_estado).empty();
                $(select2_estado).html("<option>" + mensajes_generales.debe_selec_pais + "</option>");
                $(select2_ciudad).empty();
                $(select2_ciudad).html("<option>" + mensajes_generales.debe_selec_estado + "</option>");
                if(select2_destino!==null){
                    $(select2_destino).empty();
                    $(select2_destino).html("<option>" + mensajes_generales.debe_selec_ciudad + "</option>");
                }
                if(select2_servicio!==null){
                    $(select2_servicio).empty();
                    $(select2_servicio).html("<option>" + mensajes_generales.debe_selec_destino + "</option>");
                }
            }
}

function estados(select2_estado, select2_ciudad, select2_destino, pais_usuario=null, estado_usuario=null, ciudad_usuario=null, destino_usuario=null, select2_servicio=null, servicio_usuario=null, tipo_servidor){
    pais_usuario     = pais_usuario    === '' ? null: pais_usuario;
    estado_usuario   = estado_usuario  === '' ? null: estado_usuario;
    ciudad_usuario   = ciudad_usuario  === '' ? null: ciudad_usuario;
    select2_destino  = select2_destino === '' ? null: select2_destino;
    select2_servicio  = select2_servicio === '' ? null: select2_servicio;

    // constantes
    // ruta para elegir estados
        var ruta_estado = pais_usuario!==null ? conf.pais_estado_list + "/" + pais_usuario : conf.estado_list;
    //instanciar el select2 de estados
        formatoSelect2(select2_estado, select2.estado);
    // cargar la lista de estados
        ajaxGenericoSelect2(ruta_estado, select2_estado, estado_usuario, null, null, select2.estado);
    //cargar evento de cargar ciudades según estado seleccionado
        var eventEstado = $(select2_estado);

        eventEstado.on("select2:select",function(e){
            ciudades(select2_ciudad, select2_destino, $(this).val(), null, null, select2_servicio, null, tipo_servidor);
        });


         if(estado_usuario!==null){
            ciudades(select2_ciudad, select2_destino, estado_usuario, ciudad_usuario, destino_usuario, select2_servicio, servicio_usuario, tipo_servidor);
            }else{
                $(select2_ciudad).empty();
                $(select2_ciudad).html("<option>" + mensajes_generales.debe_selec_estado + "</option>");
                if(select2_destino!==null){
                    $(select2_destino).empty();
                    $(select2_destino).html("<option>" + mensajes_generales.debe_selec_ciudad + "</option>");
                }
                if(select2_servicio!==null){
                    $(select2_servicio).empty();
                    $(select2_servicio).html("<option>" + mensajes_generales.debe_selec_destino + "</option>");
                }
            }
}

function ciudades(select2_ciudad, select2_destino, estado_usuario, ciudad_usuario=null, destino_usuario=null, select2_servicio=null, servicio_usuario=null, tipo_servidor=null){

    ciudad_usuario  =  ciudad_usuario === '' ? null: ciudad_usuario;
    destino_usuario = destino_usuario === '' ? null: destino_usuario;
    select2_destino = select2_destino === '' ? null: select2_destino;
    select2_servicio  = select2_servicio === '' ? null: select2_servicio;
    // constantes
    // ruta para elegir ciudades
        var ruta_ciudad = conf.ciudad_list;
        if(estado_usuario!==null){
            var ruta_ciudad = conf.ciudad_list + "/" + estado_usuario;
        }
    //instanciar el select2 de ciudad
        formatoSelect2(select2_ciudad, select2.ciudad);
    // cargar la lista de ciudad
        ajaxGenericoSelect2(ruta_ciudad, select2_ciudad, ciudad_usuario, null, null, select2.ciudad);

        //cargar evento de cargar ciudades según estado seleccionado
        var eventCiudad = $(select2_ciudad);

        eventCiudad.on("select2:select",function(e){
            destinos(select2_destino, $(this).val(), null, select2_servicio, null, tipo_servidor);
        });
    // cargar lista de destinos si corresponde
        if(select2_destino!==null){
            // //crear evento para cambiar los destinos según la ciudad seleccionada
            // var eventCiudad = $(select2_ciudad);
            // eventCiudad.on("select2:select",function(e){
            //     destinos(select2_destino, $(this).val());
            // });
            //inicializar los destinos dependiente de una ciudad pre cargado o no

            if(ciudad_usuario!==null){
                destinos(select2_destino, ciudad_usuario, destino_usuario, select2_servicio, servicio_usuario, tipo_servidor);
            }else{
                $(select2_destino).empty();
                $(select2_destino).html("<option>" + mensajes_generales.debe_selec_ciudad + "</option>");
                if(select2_servicio!==null){
                    $(select2_servicio).empty();
                    $(select2_servicio).html("<option>" + mensajes_generales.debe_selec_destino + "</option>");
                }
            }
        }
}
//documentar
function destinos(select2_destino, ciudad_usuario, destino_usuario, select2_servicio, servicio_usuario, tipo_servidor){

    destino_usuario = destino_usuario==='' ? null: destino_usuario;
    select2_destino = select2_destino==='' ? null: select2_destino;
    select2_servicio  = select2_servicio === '' ? null: select2_servicio;

    // constantes
    // ruta para elegir ciudades
        var ruta_destinos = conf.destino_list + "/" + ciudad_usuario;
    //instanciar el select2 de ciudad
        formatoSelect2(select2_destino, select2.destino);

    // cargar la lista de ciudad
        ajaxGenericoSelect2(ruta_destinos, select2_destino, destino_usuario, null, null, select2.destino, true);

        //cargar evento de cargar ciudades según estado seleccionado
        var eventDestino = $(select2_destino);

        eventDestino.on("select2:select",function(e){
            servicios(select2_servicio, $(this).val(), null, tipo_servidor);
        });
    // cargar lista de destinos si corresponde
        if(select2_servicio!==null){
  
            if(destino_usuario!==null){
                servicios(select2_servicio, destino_usuario, servicio_usuario, tipo_servidor);
            }else{
                $(select2_servicio).empty();
                $(select2_servicio).html("<option>" + mensajes_generales.debe_selec_destino + "</option>");
            }
        }
}

//documentar- Adriàn 11/06/2018
function servicios(select2_servicio, destino_usuario, servicio_usuario, tipo_servidor){
    servicio_usuario = servicio_usuario==='' ? null: servicio_usuario;
    select2_servicio = select2_servicio==='' ? null: select2_servicio;

    // constantes
    // ruta para elegir ciudades
        var ruta_servicios = null;
        if (destino_usuario && tipo_servidor) {   
            ruta_servicios = conf.servicios_list + "/" + destino_usuario + "/" + tipo_servidor;
        }

    //instanciar el select2 de ciudad
        formatoSelect2(select2_servicio, select2.servicio);

    // cargar la lista de ciudad
    if (ruta_servicios) {
        ajaxGenericoSelect2(ruta_servicios, select2_servicio, servicio_usuario, null, null, select2.servicio, true);
    }
}

function formatoSelect2(select2, placeholder=null, multiple=false){
    if(placeholder===null){
        placeholder =  select2.seleccione;
    }
    return $(select2).select2({
            width: "100%",
            placeholder : placeholder,
            minimumResultsForSearch : 10,
            multiple : multiple
        });
}

function ajaxGenericoSelect2(ruta, select2, val_predefinido, usuario=null, persona_asiste=null, placeholder=null, descripcion_por_nombre=null, nacionalidad_por_nombre=null){
    //eliminar el select2 si ya tiene datos cargados

    $(select2).empty();
    $.ajax({
        url: ruta,
        type: 'GET',
        data: {usuario: usuario, persona_asiste:persona_asiste},
        success: function(data, textStatus, jqXHR){
            var option = "<option></option>";
            var name = "";
            data.forEach(function(item){
              if(descripcion_por_nombre != null){
                var nombre = item.descripcion;
              }else if(nacionalidad_por_nombre != null){
                var nombre = item.nacionalidad;
              }else{
                var nombre = item.nombre;
              }
                if(val_predefinido!==null){
                    if(typeof(val_predefinido)==='object'){
                        val_predefinido.forEach(function(value){
                            if(value.codigo===item.codigo){
                                option += "<option value='" + item.codigo + "' selected='selected'>" + nombre + "</option>";
                            }else{
                                option += "<option value='" + item.codigo + "' >" + nombre + "</option>";
                            }
                        })
                    }else{
                        if(val_predefinido===item.codigo.toString()){
                            option += "<option value='" + item.codigo + "' selected='selected'>" + nombre + "</option>";
                        }else{
                            option += "<option value='" + item.codigo + "' >" + nombre + "</option>";
                        }
                    }
                }else{
                    option += "<option value='" + item.codigo + "' >" + nombre + "</option>";
                }
            });
            //cargar opciones
            $(select2).html(option);
            //instanciar para que sean visibles
            if(val_predefinido!==null){
                if(typeof(val_predefinido)==='object'){
                    var tdo = formatoSelect2(select2, placeholder, true);
                }else{
                    var tdo = formatoSelect2(select2, placeholder);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            // console.log(ruta); console.log(jqXHR.status); console.log(errorThrown);
            // if(jqXHR.status===500){ console.log(errores.conexion_servidor); } // error de respuesta del servidor
            if(jqXHR.status===401){ location.href = conf.baseURL + '/login'; } // error de Unauthorized se pierde la sesión
        }
    });
}

/*
 * @author          Alejandro Aguirre
 * @description     resalta la opción del menu que este activa.
 */
$("ul#side-menu").each(function(){

    var url = $(location).attr('href')
    var opcionMenu = '';

    $(this).find("li:not('.nav-header'):not('.divider')").each(function(){

        opcionMenu = $(this).find('a').attr('href');

        if(url == opcionMenu){
            $(this).addClass('active');

            if($(this).parents(':eq(1)').is( "li" ))
                $(this).parents(':eq(1)').addClass('active');
        }
    });
});

/**
*
* Descripción. genera una instancia de DataTable básica (sin filtros, sin ordenamientos)
*              utilizada por ejemplo para creación de tarifas.
* @author Johan Alejandro Aguirre Escobar
*
* @param {String}   idTabla         Id de la tabla html.
*
* @return {DataTable} instancia del DataTable.
*/
function instanciarDataTable(idTabla){

    /* se obtiene cantidad de columnas de la tabla para generar
    el valor utilizado por la propiedad columns de dataTables.*/
    var columns = [];
    $('#'+idTabla+' thead th').each(function (index, item){
        columns.push({ "data":  index+'.text', });
    });

    var dataTable = $('#'+idTabla).DataTable({
        language: {
            "url": conf.language_datatable,
        },
        pageLength  : 10,
        lengthMenu  : [[10, 25, 50, -1], [10, 25, 50, mensajes_generales.todos]],
        responsive  : true,
        searching   : false,
        columns: columns,
        columnDefs  : [{
            targets: "_all",
            orderable: false,
        }]
    });

    // se remueven iconos de ordenamiento en headers de dataTable.
    dataTable.columns('.sorting')
    .header()
    .to$()
    .removeClass('sorting');

    dataTable.columns('.sorting_asc')
    .header()
    .to$()
    .removeClass('sorting_asc');

    dataTable.columns('.sorting_desc')
    .header()
    .to$()
    .removeClass('sorting_desc');

    return dataTable;
}

/**
*
* Descripción. agregra una fila al datatable.
* @author Johan Alejandro Aguirre Escobar
*
* @param {DataTable}    tabla                       contiene la instancia del dataTable.
* @param {Array}        elementosFila               array que contiene los datos con los cuales se generara la nueva fila.
* @param {Object}       [confValidacion=null]       Objeto que si es enviado por parametro indicará que se aplicará validación
*                                                   de filaExiste. El objeto contiene el id del elemento donde se ubicara el
*                                                   mensaje de error y el mensaje de error a mostrar. El valor por defecto
*                                                   de esta variable opcional es null.
*
* @return {void}.
*/
function agregarElementoDataTable(tabla, elementosFila, confValidacion = null){

    var validacion = false;

    // se aplican las validaciones configuradas.
    if(confValidacion){
        if(confValidacion.mensaje){
            validacion = validacionFilaExiste(tabla, elementosFila);

            if(validacion == true){
                $('#'+confValidacion.idMensaje).html(confValidacion.mensaje).animate2('shake');
                return;
            }
            else
                $('#'+confValidacion.idMensaje).empty();
        }

        if(confValidacion.mensajeRangoFechasDest){
            validacion = validacionRangoFechasDest(tabla, elementosFila);

            if(validacion == true){
                $('#'+confValidacion.idMensaje).html(confValidacion.mensajeRangoFechasDest).animate2('shake');
                return;
            }
            else
                $('#'+confValidacion.idMensaje).empty();
        }
    }

    if(validacion == false){

        tabla.row.add(elementosFila)
            .draw(false)
            .columns('.sorting_asc')
            .header()
            .to$()
            .removeClass('sorting_asc');
    }

    console.dir(obtenerElementosDataTable(tabla));
}

/**
*
* Descripción. valida si una fila que se añade a la tabla ya existe.
* @author Johan Alejandro Aguirre Escobar
*
* @param {DataTable}    table               contiene la instancia del dataTable.
* @param {Array}        elementosFila       array que contiene los datos con los cuales se generara la nueva fila.
*
* @return {boolean}.
*/
function validacionFilaExiste(tabla, elementosFila){

    // se recorren todas las filas de la tabla.
    var elementoExiste = false;
    tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {

        // se recorren todas las celdas de una fila.
        var cont = 0;
        $.each( this.data(), function( key, value ) {

            /* se analiza si hay coincidencias en todas las celdas de una fila
            de la tabla contra los elemenetos que se van a ingresar en la tabla.*/
            if(value.val == elementosFila[key].val)
                cont = cont + 1;
        });

        if(cont == this.data().length){
            elementoExiste = true;
            return elementoExiste;
        }
    });

    return elementoExiste;
}

/**
*
* Descripción. valida si una fila que se añade a la tabla no tiene repetida
*              sus rangos de fechas para un destino especifico.
* @author Johan Alejandro Aguirre Escobar
*
* @param {DataTable}    table               contiene la instancia del dataTable.
* @param {Array}        elementosFila       array que contiene los datos con los cuales se generara la nueva fila.
*
* @return {boolean}.
*/
function validacionRangoFechasDest(tabla, elementosFila){

    var fechaCompararInicio, fechaCompararFin, fechaInicio, fechaFin, respFechaInicio, respFechaFin;
    var resp = false;
    var destinoExiste = false;

    tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {

        $.each( this.data(), function( key, value ) {

            /* almacena los rangos de fechas y el destino si estos
            existen.*/
            if(elementosFila[key].fecIni){
                fechaCompararInicio = elementosFila[key].val;
                fechaInicio         = value.val;
            }

            if(elementosFila[key].fecFin){
                fechaCompararFin = elementosFila[key].val;
                fechaFin         = value.val;
            }

            if(elementosFila[key].dest)
                destinoExiste = elementosFila[key].val == value.val ? true : false;
        });

        respFechaInicio  = compararConRangoFechas(fechaCompararInicio, fechaInicio, fechaFin);
        respFechaFin     = compararConRangoFechas(fechaCompararFin, fechaInicio, fechaFin);

        if((respFechaInicio == true || respFechaFin == true) && destinoExiste == true )
            resp = true;
    });

    return resp;
}

/**
*
* Descripción. valida si una fecha ingresada se encuentra entre el rango
*              de dos fechas dadas. Utilizada por ejemplo para verificar
*              una fecha dada entre la fecha de inicio y fin de una tarifa.
* @author Johan Alejandro Aguirre Escobar
*
* @param {String}    fechaComparar      contiene la fecha en formato (d/m/Y) que compararemos contra el rango de fechas.
* @param {String}    fechaInicio        fecha inicial en formato (d/m/Y) del rango.
* @param {String}    fechaFin           fecha final en formato (d/m/Y) del rango.
*
* @return {boolean}.
*/
function compararConRangoFechas(fechaComparar, fechaInicio, fechaFin){

    const [dayComp, monthComp, yearComp] = fechaComparar.split("/");
    var fecComparar = new Date(yearComp, monthComp - 1, dayComp);

    const [dayIni, monthIni, yearIni] = fechaInicio.split("/");
    var fechaIni = new Date(yearIni, monthIni - 1, dayIni);

    const [dayEnd, monthEnd, yearEnd] = fechaFin.split("/");
    var fechaEnd = new Date(yearEnd, monthEnd - 1, dayEnd);

    if (!/Invalid|NaN/.test(fecComparar) && !/Invalid|NaN/.test(fechaIni) && !/Invalid|NaN/.test(fechaEnd)) {
        if (fecComparar >= fechaIni && fecComparar <= fechaEnd)
            return true;
        else
            return false;
    }
}

/**
*
* Descripción. genera un evento que hace que se elimine una fila del datatable al hacer click sobre
*              el elemento con la clase classElementoPulsar.
* @author Johan Alejandro Aguirre Escobar
*
* @param {String}       idTabla                         id de la tabla html.
* @param {DataTable}    tabla                           contiene la instancia del dataTable.
* @param {String}       [classElementoPulsar=btn-link]  clase css del elemento que se presionara para eliminar la fila.
*                                                       El valor por defecto de esta variable opcional es btn-link.
*
* @return {void}.
*/
function eliminarElementoDataTable(idTabla, tabla, classElementoPulsar = 'btn-link'){

    $('#'+idTabla+' tbody').on( 'click', '.'+classElementoPulsar, function () {

        tabla.row( $(this).parents('tr') )
        .remove()
        .draw()
        .columns('.sorting_asc')
        .header()
        .to$()
        .removeClass('sorting_asc');

        console.dir(obtenerElementosDataTable(tabla));
    });
}

/**
*
* Descripción. devuelve todos los valores contenidos dentro de un datatable en formato JSon.
* @author Johan Alejandro Aguirre Escobar
*
* @param {DataTable}  tabla                     contiene la instancia del dataTable del cual se obtendran todos sus valores.
* @param {Array}      [atributosObjeto=null]    contiene el nombre de los atributos con los cuales se generara la colección
*                                               de objetos que se retornara en json. El valor por defecto de esta variable
*                                               opcional es null.
*                                               (Ej: ["temporada", "precio"]. la cantidad de atributos debe coincidir
*                                               con la cantidad de columnas del dataTable )
*
* @return {json} elementos de la tabla en formato Json.
*/
function obtenerElementosDataTable(tabla, atributosObjeto = null){

    var elementosTabla = new Array();
    tabla.data().each( function ( value, index ) {

        var objeto = new Object();
        value.forEach(function (item, index){

            if(atributosObjeto){
                /* se usa cada uno de los elementos de atributosObjeto para covertirlo en el atributo
                de la variable objeto*/
                objeto[atributosObjeto[index]] = item.val.trim();
            }
            else{
                /*Obtiene cada uno de los elementos del header de la tabla para convertirlos
                en los atributos de la variable objeto*/
                var cabeceraTabla = tabla.column(index).header();
                objeto[($(cabeceraTabla).html().replace(" ", "_")).toLowerCase()] = item.val.trim();
            }
        });

        elementosTabla.push(objeto);
    });

    return JSON.stringify(elementosTabla);
}

// PARA ENRUTAR A LA VISTA DE EDICIÓN ADRIAN - 29/03/2018
function enrutarFormEdit(id_tabla, nombre){
  $(id_tabla).on("click", "button.editar", function(){
    var data = $(this).val();
    $(location).attr('href', conf.baseURL+'/'+nombre+'/'+data+'/editar');
  })
}

// PARA ENRUTAR A LA VISTA DE EDICIÓN ADRIAN - 31/03/2018 exclusivo de datatables
function enrutarFormDelete(id_tabla, ruta){
  $(id_tabla).on("click", "button.eliminar", function(){
    var data = $(this).val();
    eliminar_registro(ruta, data, id_tabla);
  })
}

// PARA ENRUTAR A LA VISTA DE EDICIÓN DE TARIFAS ADRIAN - 11/05/2018
function enrutarFormEditTarifas(id_tabla, rol){

    $(id_tabla).on("click", "button.editar", function(){
      var data = $(this).val();
      $("#id_tarifa_"+rol).val(data);
      editar_usuario(data, 'tarifas_'+rol);
    })
}



// PARA ENRUTAR A LA ELIMINACIÒN - ADRIAN - 31/03/2018

function eliminar_registro(ruta, idRegisterToDelete, iddatatable=null){//, ruta, idFormSave=null){ // id bot�, id a anular, ruta,
   swal({
            title: mensajes_generales.advertencia_title,
            text: mensajes_generales.confirmanularswal,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1e8ac2",
            confirmButtonText: mensajes_generales.swal_aceptar,
            cancelButtonText: mensajes_generales.swal_cancelar,
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            allowOutsideClick: false

        },function () {
            // var l = Ladda.create( document.querySelector('#btn-delete'));
            $.ajax({
                headers: {
                  "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content'),
                },
                url:            conf.baseURL+'/'+ruta,
                // url:            ruta,
                type:           "POST",
                data:           {id: idRegisterToDelete},

                success: function(data){
                    if(data.success){
                         swal({title: mensajes_generales.exito_eliminar, confirmButtonColor: "#1e8ac2", type: "success" },
                            function(isConfirm) {
                                    if (isConfirm) {
                                      if (iddatatable != null){
                                          recargardatatable(iddatatable);
                                      }

                                    }
                                });
                    }else{
                        swal({
                            title: messages.erroranularswal,
                            confirmButtonColor: "#1e8ac2",
                            type: "error"
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status===500){
                        /*$("#"+error).html('<div class="content-error"><i class="icon-eliminar_b"></i> '
                            + errores.conexion_servidor + '</div>');*/
                        swal({title: "Error!", confirmButtonColor: "#1e8ac2",
                            text: messages.erroranularswal, type: "error" });
                    }
                    if(jqXHR.status===401){
                        // error de Unauthorized se pierde la sesi�n
                        location.href = conf.baseURL + '/login';
                    }
                },complete: function(){

                            // l.stop();

                }
            });

        });
}

/*
 * Adrian F Arroyave
 * 31/03/2018
 * función para recargar dataTable
 * @param   string      idDataTable      id de la datatable a recargar
 */
function recargardatatable(idDataTable){
    $(idDataTable).DataTable().ajax.reload();
}
// =========================================================================================

/**
*
* Descripción. genera una instancia de DataTable la cual se usa en las visualizaciones de las gestiones
* @author Johan Alejandro Aguirre Escobar
*
* @param {Object} configuracion   Objeto que contiene la configuración del datatable con los siguientes atributos.
*                                 - idTabla         Id de la tabla html.
*                                 - ruta            Ruta de donde se extraera los datos para llenar la tabla.
*                                 - rutaParametro   Ruta acompañada de parametro get de donde se extraera los datos para llenar la tabla.
*                                 - columnas        Array de objetos con la configuración de las columnas del datatable.
*                                   (Ej: [{data:'placa', orderable: true}, {data:'anno_vehiculo', orderable: true}])
*
* @return {DataTable} instancia del DataTable.
*/
function instanciarDataTableServerSide(configuracion){
    var dataTable = $('#'+configuracion.idTabla).DataTable({
        "language": {
            //"processing": "<img src='"+datatable.loader+"' class='img img-responsive'>",
            "url": conf.language_datatable,
        },
        "processing":true,
        "searching": true,
        "serverSide": true,
        "order": [[ 0, "desc" ]],
        "ajax": {
            url: configuracion.ruta ? conf.baseURL+laroute.route(configuracion.ruta) : configuracion.rutaParametro
        },
        "columns": configuracion.columnas,
        // initComplete: function () {
        //     this.api().columns().every(function () {
        //         var column = this;
        //         var input = document.createElement("input");
        //         $(input).appendTo($(column.footer()).empty())
        //         .on('change', function () {
        //             column.search($(this).val()).draw();
        //         });
        //     });
        // }
    });

    return dataTable;
}

/**
*
* Descripción. genera una instancia de DataTable la cual se usa en las visualizaciones de las gestiones
* @author adrian --- documentar -- 8/04/2018
*
*/
function deshabilitarcampos(){
    document.getElementById("documento").readOnly = true;
    document.getElementById("cod_tipo_documento").disabled = true;

}

/**
*
* Descripción. Se inicializa el plug in select2 basico sobre todos los inputs
* con la clase selectBusqueda.
* @author Johan Alejandro Aguirre Escobar
*/
$('.selectBusqueda').select2({'width': '100%'});

/**
*
* Descripción. Se configura lenguaje por defecto del datepicker en español.
* @author Johan Alejandro Aguirre Escobar
*/
$.fn.datepicker.defaults.language = conf.lenguaje_plugins;
$.fn.select2.defaults.set('language', 'es');

/**
*
* Descripción. Se inicializa el plug in datepicker basico sobre todos los inputs
* con la clase calendario.
* @author Johan Alejandro Aguirre Escobar
*/
$('.calendario').datepicker({
    // language: 'es',
    format: 'dd/mm/yyyy',
    defaultDate: new Date(),
    todayBtn: "linked",
    calendarWeeks: true,
    autoclose: true,
    forceParse: true,
});

$(".calendario").keydown(false);

/**
*
* Descripción. Se inicializa el plug in datepicker para rangos de fechas
* sobre todos inputs con la clase rangoFechas.
* @author Johan Alejandro Aguirre Escobar
*/
$('.rangoFechas .input-daterange').datepicker({
    keyboardNavigation: false,
    forceParse: true,
    autoclose: true,
});

$(".rangoFechas .input-daterange").keydown(false);

/**
*
* Descripción. Se inicializa el plug in fileinput sobre un input en especifico
* @author Johan Alejandro Aguirre Escobar
*
* @param {String} idInputFile             id del input file HTML al aplicar fileinput.
* @param {Array}  [arrayRutaArchivo=[]]   contiene el array con los archivos se se precargaran en el fileinput.
*                                         El valor por defecto de esta variable opcional es [] (array vacio).
*
* @return {json} elementos de la tabla en formato Json.
*/
function instanciarFileInput(idInputFile, arrayRutaArchivos = [])
{
    var fileinput = $("#"+idInputFile).fileinput({   
        // showDelete: true,
        initialPreview: arrayRutaArchivos,
        showUpload: false,
        initialPreviewAsData: true,
        initialPreviewFileType: 'image',
        // showCaption: false,
        // showPreview: false,
        // allowedFileExtensions: ["image"],
        // maxImageWidth: 250,
        // maxImageHeight: 250,            
        // maxFileCount: 20,
        maxFileSize: 5000,
        language: 'es',                                     
    }); 

    return fileinput;
}






/*
 * Adrian Arroyave
 * 10/05/2018
 *
 * No retorna nada, pero carga en formularios la lista de tipos de vehìculos con sus respectivas condiciones,
 * como seg�n el pais del usuario logueado
 *
 * @param   string      select2_tipo_vehiculo       que es el selector del elemento html select2 en el
 *                                              formulario para cargar los estratos
 *          int         tipo_vehiculo_usuario        identificador del tipo_vehiculo pre cargado, por defecto es null
 */
function select2TipoVehiculo(select2_tipo_vehiculo, tipo_vehiculo_usuario=null, id_pais=null){

    if (tipo_vehiculo_usuario === ''){
        tipo_vehiculo_usuario = null;
    }
    //constante de ruta para listar las tipos de vehìculo
        var ruta_estrato = conf.tipo_vehiculo_list;

    //instanciar el select2 de estrato
    formatoSelect2(select2_tipo_vehiculo, select2.tipo_vehiculo);

    // cargar la lista de paises
    ajaxGenericoSelect2(ruta_estrato, select2_tipo_vehiculo, tipo_vehiculo_usuario, null, null, null, true);
}


/*
 * Adrian Arroyave
 * 19/11/2017
 *
 * No retorna nada, pero carga en formularios la lista de nacionalidades con sus respectivas condiciones,
 * como seg�n el pais del usuario logueado
 *
 * @param   string      select2_nacionalidades        que es el selector del elemento html select2 en el
 *                                              formulario para cargar las nacionalidades
 *          int         nacionalidades_usuario        identificador del estrato pre cargado, por defecto es null
 *          int         id_pais                 parametro para listar tipo de documentos validos por pais,
 *                                              por defecto es null (Pensado para usar en registro p�blico)
 */
function select2Nacionalidad(select2_nacionalidad, nacionalidad_usuario=null){

    if  (nacionalidad_usuario === ''){
       nacionalidad_usuario = null;
    }
    //constante de ruta para listar las estrato seg�n el pais del usuario logueado

    var ruta_nacionalidad = conf.nacionalidad_list;

    //instanciar el select2 de estrato
    formatoSelect2(select2_nacionalidad);

    // cargar la lista de paises
    ajaxGenericoSelect2(ruta_nacionalidad, select2_nacionalidad, nacionalidad_usuario, null, null, null, null, true);

}


/*
 * Adrian Arroyave
 * 09/11/2017
 *
 * No retorna nada, pero carga en formularios la lista de tipos de documento con sus respectivas condiciones,
 * como seg�n el pais del usuario logueado
 *
 * @param   string      select2_tipos_documento        que es el selector del elemento html select2 en el
 *                                              formulario para cargar las tipos_documento
 *          int         tipos_documento_usuario        identificador del estrato pre cargado, por defecto es null
 *          int         id_pais                 parametro para listar tipo de documentos validos por pais,
 *                                              por defecto es null (Pensado para usar en registro p�blico)
 */
function select2TipoDocumento(select2_tipo_documento, tipo_documento_usuario=null){

    if  (tipo_documento_usuario === ''){
       tipo_documento_usuario = null;
    }
    //constante de ruta para listar las estrato seg�n el pais del usuario logueado

    var ruta_tipo_documento = conf.tipo_documento_list;

    //instanciar el select2 de estrato
    formatoSelect2(select2_tipo_documento);

    // cargar la lista de paises
    ajaxGenericoSelect2(ruta_tipo_documento, select2_tipo_documento, tipo_documento_usuario);
}


/*
 * Adrian Arroyave
 * 11/06/2018
 *
 * No retorna nada, pero carga en formularios la lista de nùmeros de licencia con sus respectivas condiciones
 *
 * @param   string      select2_num_licencia        que es el selector del elemento html select2 en el
 *                                              formulario para cargar las números de licencia
 *          int         num_licencia_usuario        identificador del número de licencia pre cargado, por defecto es null
 */
function select2_num_licencia(select2num_licencia, num_licencia_usuario=null){

    if  (num_licencia_usuario === ''){
       num_licencia_usuario = null;
    }
    //constante de ruta para listar las estrato seg�n el pais del usuario logueado

    var ruta_num_licencia = conf.num_licencia_list;

    //instanciar el select2 de estrato
    formatoSelect2(select2num_licencia);

    // cargar la lista de paises
    ajaxGenericoSelect2(ruta_num_licencia, select2num_licencia, num_licencia_usuario);
}



