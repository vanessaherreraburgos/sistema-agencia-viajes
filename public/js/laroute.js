(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"home","name":"home","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"paquetes\/create","name":"paquetes\/create","action":"App\Http\Controllers\paquetes\PaquetesController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"paises","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"paises\/list","name":"paises\/list","action":"App\Http\Controllers\configuracion\PaisController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"vehiculos\/listar","name":"vehiculos\/listar","action":"App\Http\Controllers\vehiculos\VehiculosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"vehiculos\/datatable","name":"vehiculos\/datatable","action":"App\Http\Controllers\vehiculos\VehiculosController@dataTableVehiculos"},{"host":null,"methods":["GET","HEAD"],"uri":"vehiculos\/crear","name":"vehiculos\/crear","action":"App\Http\Controllers\vehiculos\VehiculosController@create"},{"host":null,"methods":["POST"],"uri":"vehiculos\/guardar","name":"vehiculos\/guardar","action":"App\Http\Controllers\vehiculos\VehiculosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"vehiculos\/editar\/{id}","name":"vehiculos\/editar","action":"App\Http\Controllers\vehiculos\VehiculosController@edit"},{"host":null,"methods":["PATCH"],"uri":"vehiculos\/actualizar\/{id}","name":"vehiculos\/actualizar","action":"App\Http\Controllers\vehiculos\VehiculosController@update"},{"host":null,"methods":["POST"],"uri":"vehiculos\/eliminar","name":"vehiculos\/eliminar","action":"App\Http\Controllers\vehiculos\VehiculosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_vehiculos\/listar","name":"tipos_vehiculos\/listar","action":"App\Http\Controllers\vehiculos\TipoVehiculoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_vehiculos\/datatable","name":"tipos_vehiculos\/datatable","action":"App\Http\Controllers\vehiculos\TipoVehiculoController@dataTableTiposVehiculos"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_vehiculos\/crear","name":"tipos_vehiculos\/crear","action":"App\Http\Controllers\vehiculos\TipoVehiculoController@create"},{"host":null,"methods":["POST"],"uri":"tipos_vehiculos\/guardar","name":"tipos_vehiculos\/guardar","action":"App\Http\Controllers\vehiculos\TipoVehiculoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_vehiculos\/editar\/{id}","name":"tipos_vehiculos\/editar","action":"App\Http\Controllers\vehiculos\TipoVehiculoController@edit"},{"host":null,"methods":["PATCH"],"uri":"tipos_vehiculos\/actualizar\/{id}","name":"tipos_vehiculos\/actualizar","action":"App\Http\Controllers\vehiculos\TipoVehiculoController@update"},{"host":null,"methods":["POST"],"uri":"tipos_vehiculos\/eliminar","name":"tipos_vehiculos\/eliminar","action":"App\Http\Controllers\vehiculos\TipoVehiculoController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_vehiculos\/tarifas\/{id}","name":"tipos_vehiculos\/tarifas","action":"App\Http\Controllers\vehiculos\TarifasTipoVehiculoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_vehiculos\/tarifas\/datatable\/{id}","name":"tipos_vehiculos\/tarifas\/datatable","action":"App\Http\Controllers\vehiculos\TarifasTipoVehiculoController@dataTableTarifasTipoVehiculo"},{"host":null,"methods":["PATCH"],"uri":"tipos_vehiculos\/tarifas\/guardar","name":"tipos_vehiculos\/tarifas\/guardar","action":"App\Http\Controllers\vehiculos\TarifasTipoVehiculoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_vehiculos\/tarifas\/editar\/{id}","name":"tipos_vehiculos\/tarifas\/editar","action":"App\Http\Controllers\vehiculos\TarifasTipoVehiculoController@edit"},{"host":null,"methods":["PATCH"],"uri":"tipos_vehiculos\/tarifas\/actualizar","name":"tipos_vehiculos\/tarifas\/actualizar","action":"App\Http\Controllers\vehiculos\TarifasTipoVehiculoController@update"},{"host":null,"methods":["POST"],"uri":"tipos_vehiculos\/tarifas\/eliminar","name":"tipos_vehiculos\/tarifas\/eliminar","action":"App\Http\Controllers\vehiculos\TarifasTipoVehiculoController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_aviones\/listar","name":"tipos_aviones\/listar","action":"App\Http\Controllers\aviones\TipoAvionController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_aviones\/datatable","name":"tipos_aviones\/datatable","action":"App\Http\Controllers\aviones\TipoAvionController@dataTableTiposAviones"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_aviones\/crear","name":"tipos_aviones\/crear","action":"App\Http\Controllers\aviones\TipoAvionController@create"},{"host":null,"methods":["POST"],"uri":"tipos_aviones\/guardar","name":"tipos_aviones\/guardar","action":"App\Http\Controllers\aviones\TipoAvionController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_aviones\/editar\/{id}","name":"tipos_aviones\/editar","action":"App\Http\Controllers\aviones\TipoAvionController@edit"},{"host":null,"methods":["PATCH"],"uri":"tipos_aviones\/actualizar\/{id}","name":"tipos_aviones\/actualizar","action":"App\Http\Controllers\aviones\TipoAvionController@update"},{"host":null,"methods":["POST"],"uri":"tipos_aviones\/eliminar","name":"tipos_aviones\/eliminar","action":"App\Http\Controllers\aviones\TipoAvionController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_aviones\/tarifas\/{id}","name":"tipos_aviones\/tarifas","action":"App\Http\Controllers\aviones\TarifasTipoAvionController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_aviones\/tarifas\/datatable\/{id}","name":"tipos_aviones\/tarifas\/datatable","action":"App\Http\Controllers\aviones\TarifasTipoAvionController@dataTableTarifasTipoAvion"},{"host":null,"methods":["PATCH"],"uri":"tipos_aviones\/tarifas\/guardar","name":"tipos_aviones\/tarifas\/guardar","action":"App\Http\Controllers\aviones\TarifasTipoAvionController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos_aviones\/tarifas\/editar\/{id}","name":"tipos_aviones\/tarifas\/editar","action":"App\Http\Controllers\aviones\TarifasTipoAvionController@edit"},{"host":null,"methods":["PATCH"],"uri":"tipos_aviones\/tarifas\/actualizar","name":"tipos_aviones\/tarifas\/actualizar","action":"App\Http\Controllers\aviones\TarifasTipoAvionController@update"},{"host":null,"methods":["POST"],"uri":"tipos_aviones\/tarifas\/eliminar","name":"tipos_aviones\/tarifas\/eliminar","action":"App\Http\Controllers\aviones\TarifasTipoAvionController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"aviones\/listar","name":"aviones\/listar","action":"App\Http\Controllers\aviones\AvionesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"aviones\/datatable","name":"aviones\/datatable","action":"App\Http\Controllers\aviones\AvionesController@dataTableAviones"},{"host":null,"methods":["GET","HEAD"],"uri":"aviones\/crear","name":"aviones\/crear","action":"App\Http\Controllers\aviones\AvionesController@create"},{"host":null,"methods":["POST"],"uri":"aviones\/guardar","name":"aviones\/guardar","action":"App\Http\Controllers\aviones\AvionesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"aviones\/editar\/{id}","name":"aviones\/editar","action":"App\Http\Controllers\aviones\AvionesController@edit"},{"host":null,"methods":["PATCH"],"uri":"aviones\/actualizar\/{id}","name":"aviones\/actualizar","action":"App\Http\Controllers\aviones\AvionesController@update"},{"host":null,"methods":["POST"],"uri":"aviones\/eliminar","name":"aviones\/eliminar","action":"App\Http\Controllers\aviones\AvionesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"lineas_aereas\/listar","name":"lineas_aereas\/listar","action":"App\Http\Controllers\lineasAereas\LineasAereasController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"lineas_aereas\/crear","name":"lineas_aereas\/crear","action":"App\Http\Controllers\lineasAereas\LineasAereasController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"destinos\/listar","name":"destinos\/listar","action":"App\Http\Controllers\destinos\DestinosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"destinos\/consultar\/{id}","name":"destinos\/consultar","action":"App\Http\Controllers\destinos\DestinosController@consultar"},{"host":null,"methods":["GET","HEAD"],"uri":"destinos\/datatable","name":"destinos\/datatable","action":"App\Http\Controllers\destinos\DestinosController@dataTableDestinos"},{"host":null,"methods":["GET","HEAD"],"uri":"destinos\/crear","name":"destinos\/crear","action":"App\Http\Controllers\destinos\DestinosController@create"},{"host":null,"methods":["POST"],"uri":"destinos\/guardar","name":"destinos\/guardar","action":"App\Http\Controllers\destinos\DestinosController@guardar_destino"},{"host":null,"methods":["GET","HEAD"],"uri":"destinos\/editar\/{id}","name":"destinos\/editar","action":"App\Http\Controllers\destinos\DestinosController@edit"},{"host":null,"methods":["POST"],"uri":"destinos\/actualizar\/{id}","name":"destinos\/actualizar","action":"App\Http\Controllers\destinos\DestinosController@update"},{"host":null,"methods":["POST"],"uri":"destinos\/eliminar","name":"destinos\/eliminar","action":"App\Http\Controllers\destinos\DestinosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"choferes\/listar","name":"choferes_list","action":"App\Http\Controllers\choferes\ChoferesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"choferes\/consultar","name":"choferes_consultar","action":"App\Http\Controllers\choferes\ChoferesController@consultar"},{"host":null,"methods":["GET","HEAD"],"uri":"choferes\/crear","name":"choferes_create","action":"App\Http\Controllers\choferes\ChoferesController@create"},{"host":null,"methods":["POST"],"uri":"choferes\/almacenar","name":"choferes_store","action":"App\Http\Controllers\choferes\ChoferesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"choferes\/{id}\/editar","name":"choferes_edit","action":"App\Http\Controllers\choferes\ChoferesController@edit"},{"host":null,"methods":["POST"],"uri":"choferes\/actualizar","name":"choferes_update","action":"App\Http\Controllers\choferes\ChoferesController@update"},{"host":null,"methods":["POST"],"uri":"choferes\/eliminar","name":"choferes_eliminar","action":"App\Http\Controllers\choferes\ChoferesController@eliminar"},{"host":null,"methods":["GET","HEAD"],"uri":"choferes\/datatable","name":"choferes\/datatable","action":"App\Http\Controllers\choferes\ChoferesController@dataTableChoferes"},{"host":null,"methods":["GET","HEAD"],"uri":"choferes\/tarifas\/{id}","name":"choferes\/tarifas","action":"App\Http\Controllers\choferes\TarifasChoferes@tarifas"},{"host":null,"methods":["POST"],"uri":"choferes\/tarifas\/almacenar","name":"choferes\/tarifas\/almacenar","action":"App\Http\Controllers\choferes\TarifasChoferes@almacenar"},{"host":null,"methods":["POST"],"uri":"choferes\/tarifas\/actualizar","name":"choferes\/tarifas\/actualizar","action":"App\Http\Controllers\choferes\TarifasChoferes@update"},{"host":null,"methods":["POST"],"uri":"choferes\/tarifas\/eliminar","name":"choferes\/tarifas\/eliminar","action":"App\Http\Controllers\choferes\TarifasChoferes@eliminar"},{"host":null,"methods":["GET","HEAD"],"uri":"choferes\/tarifas\/datatable\/{id}","name":"choferes\/tarifas\/datatable","action":"App\Http\Controllers\choferes\TarifasChoferes@dataTableTarifasChoferes"},{"host":null,"methods":["GET","HEAD"],"uri":"tarifas_choferes\/consultar","name":"choferes_tarifas_consultar","action":"App\Http\Controllers\choferes\TarifasChoferes@consultar"},{"host":null,"methods":["GET","HEAD"],"uri":"guias\/listar","name":"guias_list","action":"App\Http\Controllers\guias\GuiasController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"guias\/crear","name":"guias_create","action":"App\Http\Controllers\guias\GuiasController@create"},{"host":null,"methods":["POST"],"uri":"guias\/almacenar","name":"guias_store","action":"App\Http\Controllers\guias\GuiasController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"guias\/datatable","name":"guias\/datatable","action":"App\Http\Controllers\guias\GuiasController@dataTableGuias"},{"host":null,"methods":["POST"],"uri":"guias\/eliminar","name":"guias_eliminar","action":"App\Http\Controllers\guias\GuiasController@eliminar"},{"host":null,"methods":["GET","HEAD"],"uri":"guias\/{id}\/editar","name":"guias_edit","action":"App\Http\Controllers\guias\GuiasController@edit"},{"host":null,"methods":["POST"],"uri":"guias\/actualizar","name":"guias_update","action":"App\Http\Controllers\guias\GuiasController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"guias\/consultar","name":"guias_consultar","action":"App\Http\Controllers\guias\GuiasController@consultar"},{"host":null,"methods":["GET","HEAD"],"uri":"guias_tarifas\/consultar","name":"guias_tarifas_consultar","action":"App\Http\Controllers\guias\TarifaGuias@consultar"},{"host":null,"methods":["POST"],"uri":"guias\/tarifas\/eliminar","name":"guias\/tarifas\/eliminar","action":"App\Http\Controllers\guias\TarifaGuias@eliminar"},{"host":null,"methods":["GET","HEAD"],"uri":"guias\/tarifas\/{id}","name":"guias\/tarifas","action":"App\Http\Controllers\guias\TarifaGuias@tarifas"},{"host":null,"methods":["POST"],"uri":"guias\/tarifas\/almacenar","name":"guias\/tarifas\/almacenar","action":"App\Http\Controllers\guias\TarifaGuias@almacenar"},{"host":null,"methods":["POST"],"uri":"guias\/tarifas\/actualizar","name":"guias\/tarifas\/actualizar","action":"App\Http\Controllers\guias\TarifaGuias@update"},{"host":null,"methods":["GET","HEAD"],"uri":"guias\/tarifas\/datatable\/{id}","name":"guias\/tarifas\/datatable","action":"App\Http\Controllers\guias\TarifaGuias@dataTableTarifasGuias"},{"host":null,"methods":["GET","HEAD"],"uri":"tarifas_guias\/consultar","name":"guias_tarifas_consultar","action":"App\Http\Controllers\guias\TarifaGuias@consultar"},{"host":null,"methods":["GET","HEAD"],"uri":"tarifas_guias\/ciudad_destino","name":"ciudad_destino","action":"App\Http\Controllers\guias\TarifaGuias@ciudad_destino"},{"host":null,"methods":["GET","HEAD"],"uri":"clientes\/listar","name":"clientes\/listar","action":"App\Http\Controllers\clientes\ClientesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"clientes\/datatable","name":"clientes\/datatable","action":"App\Http\Controllers\clientes\ClientesController@dataTableCliente"},{"host":null,"methods":["GET","HEAD"],"uri":"clientes\/crear","name":"clientes\/crear","action":"App\Http\Controllers\clientes\ClientesController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"clientes\/editar\/{id}","name":"clientes\/editar","action":"App\Http\Controllers\clientes\ClientesController@edit"},{"host":null,"methods":["POST"],"uri":"clientes\/guardar","name":"clientes\/guardar","action":"App\Http\Controllers\clientes\ClientesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"hoteles\/listar","name":"hoteles\/listar","action":"App\Http\Controllers\hoteles\HotelesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"hoteles\/crear","name":"hoteles\/crear","action":"App\Http\Controllers\hoteles\HotelesController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"hoteles\/crear2","name":"hoteles\/crear2","action":"App\Http\Controllers\hoteles\HotelesController@create2"},{"host":null,"methods":["GET","HEAD"],"uri":"hoteles\/datatable","name":"hoteles\/datatable","action":"App\Http\Controllers\hoteles\HotelesController@dataTableHoteles"},{"host":null,"methods":["POST"],"uri":"hoteles\/guardar","name":"hoteles\/guardar","action":"App\Http\Controllers\hoteles\HotelesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"hoteles\/editar\/{id}","name":"hoteles\/editar","action":"App\Http\Controllers\hoteles\HotelesController@edit"},{"host":null,"methods":["PATCH"],"uri":"hoteles\/actualizar\/{id}","name":"hoteles\/actualizar","action":"App\Http\Controllers\hoteles\HotelesController@update"},{"host":null,"methods":["POST"],"uri":"hoteles\/eliminar","name":"hoteles\/eliminar","action":"App\Http\Controllers\hoteles\HotelesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"hoteles\/tarifas\/{idHotel}","name":"hoteles\/tarifas","action":"App\Http\Controllers\hoteles\HotelesController@indexTarifas"},{"host":null,"methods":["GET","HEAD"],"uri":"hoteles\/tarifasHabitaciones","name":"hoteles\/tarifasHabitaciones","action":"App\Http\Controllers\hoteles\HotelesController@TarifasHabitaciones"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/paises","name":"listar_paises","action":"App\Http\Controllers\destinos\DestinosController@getListPais"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/estados_pais\/{pais}","name":"listar_estados_pais","action":"App\Http\Controllers\destinos\DestinosController@getListEstadosPais"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/estados","name":"listar_estados","action":"App\Http\Controllers\destinos\DestinosController@getListEstados"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/ciudades\/{estado}","name":"listar_ciudades_estado","action":"App\Http\Controllers\destinos\DestinosController@getListCiudadesEstado"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/ciudades","name":"listar_ciudades","action":"App\Http\Controllers\destinos\DestinosController@getListCiudades"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/destinos\/{ciudad}","name":"listar_destinos_ciudad","action":"App\Http\Controllers\destinos\DestinosController@getListDestinosCiudad"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/destinos","name":"listar_ciudades","action":"App\Http\Controllers\destinos\DestinosController@getListCiudades"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/servicios\/{destino}\/{tipo}","name":"listar_servicios_destino","action":"App\Http\Controllers\servicios\ServiciosController@getListServiciosDestino"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/tipoVehiculo","name":"listar_tiposVehiculos","action":"App\Http\Controllers\vehiculos\VehiculosController@listTipoVehiculos"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/nacionalidades","name":"listar_nacionalidades","action":"App\Http\Controllers\destinos\DestinosController@getListNacionalidades"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/tipo_documento","name":"listar_nacionalidades","action":"App\Http\Controllers\parametrizacion\TiposDocumentoController@getListTiposDocumento"},{"host":null,"methods":["GET","HEAD"],"uri":"list\/num_licencia","name":"listar_numeros_licencia","action":"App\Http\Controllers\choferes\ChoferesController@getListNumLicencia"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/listar","name":"servicios_propios_list","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/datatable","name":"serviciosPropios\/datatable","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@dataTableServiciosPropios"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/crear","name":"servicios_propios_create","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@create"},{"host":null,"methods":["POST"],"uri":"serviciosPropios\/almacenar","name":"servicios_propios_store","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/{id}\/editar","name":"servicios_propios_edit","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@edit"},{"host":null,"methods":["PUT"],"uri":"serviciosPropios\/actualizar\/{id}","name":"servicios_propios_update","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/consultar","name":"servicios_propios_consultar","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@consultar"},{"host":null,"methods":["POST"],"uri":"serviciosPropios\/eliminar","name":"servicios_propios_eliminar","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@eliminar"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/tarifas\/{id}","name":"servicios_propios\/tarifas","action":"App\Http\Controllers\serviciosPropios\TarifasServiciosPropios@tarifas"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/tarifas\/datatable\/{id}","name":"serviciosPropios\/tarifas\/datatable","action":"App\Http\Controllers\serviciosPropios\TarifasServiciosPropios@dataTableTarifasServPropios"},{"host":null,"methods":["POST"],"uri":"serviciosPropios\/tarifas\/almacenar","name":"servicios_propios\/tarifas\/almacenar","action":"App\Http\Controllers\serviciosPropios\TarifasServiciosPropios@almacenar"},{"host":null,"methods":["GET","HEAD"],"uri":"tarifas_servicio_propio\/consultar","name":"servicios_propios_tarifas_consultar","action":"App\Http\Controllers\serviciosPropios\TarifasServiciosPropios@consultar"},{"host":null,"methods":["POST"],"uri":"tarifasServiciosPropios\/eliminar","name":"servicios_propios_tarifas_eliminar","action":"App\Http\Controllers\serviciosPropios\TarifasServiciosPropios@eliminar"},{"host":null,"methods":["POST"],"uri":"update_tar_ser_propio","name":"update_tar_ser_propio","action":"App\Http\Controllers\serviciosPropios\TarifasServiciosPropios@update"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios","name":"serviciosPropios.index","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/create","name":"serviciosPropios.create","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@create"},{"host":null,"methods":["POST"],"uri":"serviciosPropios","name":"serviciosPropios.store","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/{serviciosPropio}","name":"serviciosPropios.show","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"serviciosPropios\/{serviciosPropio}\/edit","name":"serviciosPropios.edit","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"serviciosPropios\/{serviciosPropio}","name":"serviciosPropios.update","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@update"},{"host":null,"methods":["DELETE"],"uri":"serviciosPropios\/{serviciosPropio}","name":"serviciosPropios.destroy","action":"App\Http\Controllers\serviciosPropios\ServiciosPropiosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"tipo_cliente\/listar","name":"tipo_cliente\/listar","action":"App\Http\Controllers\Parametrizacion\TipoClienteController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tipo_cliente\/datatable","name":"tipo_cliente\/datatable","action":"App\Http\Controllers\Parametrizacion\TipoClienteController@dataTableTipoCliente"},{"host":null,"methods":["GET","HEAD"],"uri":"proveedores\/listar","name":"proveedores\/listar","action":"App\Http\Controllers\proveedores\ProveedoresController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"proveedores\/datatable","name":"proveedores\/datatable","action":"App\Http\Controllers\proveedores\ProveedoresController@dataTableProveedor"},{"host":null,"methods":["GET","HEAD"],"uri":"proveedores\/crear","name":"proveedores\/crear","action":"App\Http\Controllers\proveedores\ProveedoresController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"proveedores\/editar\/{id}","name":"proveedores\/editar","action":"App\Http\Controllers\proveedores\ProveedoresController@edit"},{"host":null,"methods":["POST"],"uri":"proveedores\/guardar","name":"proveedores\/guardar","action":"App\Http\Controllers\proveedores\ProveedoresController@store"},{"host":null,"methods":["POST"],"uri":"proveedores\/eliminar","name":"proveedores\/eliminar","action":"App\Http\Controllers\proveedores\ProveedoresController@destroy"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

