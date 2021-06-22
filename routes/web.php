<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
* Vanessa Herrera
*
* AUTENTICACION
* ***********************************************************************************************
*/

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/', function () {
	    return view('auth.login');
	});

	Route::get ('logout',['uses'=>'Auth\LoginController@logout','as'=>'logout']);

	/**
     *--------------------------------------------
     * RUTAS PARA GESTION PAQUETES
     *--------------------------------------------
     * @author Vanessa Herrera
     *--------------------------------------------
    */
	Route::get('paquetes/create', ['uses'=>'paquetes\PaquetesController@create','as'=>'paquetes/create']);


/*
*
* GRUPOS DE RUTAS PARA EL PERFIL DE USUARIO ADMINISTRADOR
* ***********************************************************************************************
*/
Route::group(['middleware'=>['auth','admin']], function(){
	Route::get('paises', function () {
	    	return view('configuracion.pais');
	});

	Route::get('paises/list', ['uses'=>'configuracion\PaisController@index','as'=>'paises/list']);

	/**
     *--------------------------------------------
     * RUTAS PARA GESTION VEHÍCULOS
     *--------------------------------------------
     * @author Alejandro Aguirre
     *--------------------------------------------
    */
	Route::get('vehiculos/listar', ['uses'=>'vehiculos\VehiculosController@index','as'=>'vehiculos/listar']);
	Route::get('vehiculos/datatable', ['uses'=>'vehiculos\VehiculosController@dataTableVehiculos','as'=>'vehiculos/datatable']);
	Route::get('vehiculos/crear', ['uses'=>'vehiculos\VehiculosController@create','as'=>'vehiculos/crear']);
	Route::post('vehiculos/guardar', ['uses'=>'vehiculos\VehiculosController@store','as'=>'vehiculos/guardar']);
	Route::get('vehiculos/editar/{id}', ['uses'=>'vehiculos\VehiculosController@edit','as'=>'vehiculos/editar']);
	Route::patch('vehiculos/actualizar/{id}', ['uses'=>'vehiculos\VehiculosController@update','as'=>'vehiculos/actualizar']);
	Route::post('vehiculos/eliminar', ['uses'=>'vehiculos\VehiculosController@destroy','as'=>'vehiculos/eliminar']);
	
	/**
     *--------------------------------------------
     * RUTAS PARA GESTION DE TIPOS DE VEHÍCULOS
     *--------------------------------------------
     * @author Alejandro Aguirre
     *--------------------------------------------
    */
    Route::get('tipos_vehiculos/listar', ['uses'=>'vehiculos\TipoVehiculoController@index','as'=>'tipos_vehiculos/listar']);
	Route::get('tipos_vehiculos/datatable', ['uses'=>'vehiculos\TipoVehiculoController@dataTableTiposVehiculos','as'=>'tipos_vehiculos/datatable']);
	Route::get('tipos_vehiculos/crear', ['uses'=>'vehiculos\TipoVehiculoController@create','as'=>'tipos_vehiculos/crear']);
	Route::post('tipos_vehiculos/guardar', ['uses'=>'vehiculos\TipoVehiculoController@store','as'=>'tipos_vehiculos/guardar']);
	Route::get('tipos_vehiculos/editar/{id}', ['uses'=>'vehiculos\TipoVehiculoController@edit','as'=>'tipos_vehiculos/editar']);
	Route::patch('tipos_vehiculos/actualizar/{id}', ['uses'=>'vehiculos\TipoVehiculoController@update','as'=>'tipos_vehiculos/actualizar']);
	Route::post('tipos_vehiculos/eliminar', ['uses'=>'vehiculos\TipoVehiculoController@destroy','as'=>'tipos_vehiculos/eliminar']);

	Route::get('tipos_vehiculos/tarifas/{id}', ['uses'=>'vehiculos\TarifasTipoVehiculoController@index','as'=>'tipos_vehiculos/tarifas']);
	Route::get('tipos_vehiculos/tarifas/datatable/{id}', ['uses'=>'vehiculos\TarifasTipoVehiculoController@dataTableTarifasTipoVehiculo','as'=>'tipos_vehiculos/tarifas/datatable']);
	Route::patch('tipos_vehiculos/tarifas/guardar', ['uses'=>'vehiculos\TarifasTipoVehiculoController@store','as'=>'tipos_vehiculos/tarifas/guardar']);
	Route::get('tipos_vehiculos/tarifas/editar/{id}', ['uses'=>'vehiculos\TarifasTipoVehiculoController@edit','as'=>'tipos_vehiculos/tarifas/editar']);
	Route::patch('tipos_vehiculos/tarifas/actualizar', ['uses'=>'vehiculos\TarifasTipoVehiculoController@update','as'=>'tipos_vehiculos/tarifas/actualizar']);
	Route::post('tipos_vehiculos/tarifas/eliminar', ['uses'=>'vehiculos\TarifasTipoVehiculoController@destroy','as'=>'tipos_vehiculos/tarifas/eliminar']);

	/**
     *--------------------------------------------
     * RUTAS PARA GESTION DE TIPOS DE AVIONES
     *--------------------------------------------
     * @author Alejandro Aguirre
     *--------------------------------------------
    */

    Route::get('tipos_aviones/listar', ['uses'=>'aviones\TipoAvionController@index','as'=>'tipos_aviones/listar']);
	Route::get('tipos_aviones/datatable', ['uses'=>'aviones\TipoAvionController@dataTableTiposAviones','as'=>'tipos_aviones/datatable']);
	Route::get('tipos_aviones/crear', ['uses'=>'aviones\TipoAvionController@create','as'=>'tipos_aviones/crear']);
	Route::post('tipos_aviones/guardar', ['uses'=>'aviones\TipoAvionController@store','as'=>'tipos_aviones/guardar']);
	Route::get('tipos_aviones/editar/{id}', ['uses'=>'aviones\TipoAvionController@edit','as'=>'tipos_aviones/editar']);
	Route::patch('tipos_aviones/actualizar/{id}', ['uses'=>'aviones\TipoAvionController@update','as'=>'tipos_aviones/actualizar']);
	Route::post('tipos_aviones/eliminar', ['uses'=>'aviones\TipoAvionController@destroy','as'=>'tipos_aviones/eliminar']);

	Route::get('tipos_aviones/tarifas/{id}', ['uses'=>'aviones\TarifasTipoAvionController@index','as'=>'tipos_aviones/tarifas']);
	Route::get('tipos_aviones/tarifas/datatable/{id}', ['uses'=>'aviones\TarifasTipoAvionController@dataTableTarifasTipoAvion','as'=>'tipos_aviones/tarifas/datatable']);
	Route::patch('tipos_aviones/tarifas/guardar', ['uses'=>'aviones\TarifasTipoAvionController@store','as'=>'tipos_aviones/tarifas/guardar']);
	Route::get('tipos_aviones/tarifas/editar/{id}', ['uses'=>'aviones\TarifasTipoAvionController@edit','as'=>'tipos_aviones/tarifas/editar']);
	Route::patch('tipos_aviones/tarifas/actualizar', ['uses'=>'aviones\TarifasTipoAvionController@update','as'=>'tipos_aviones/tarifas/actualizar']);
	Route::post('tipos_aviones/tarifas/eliminar', ['uses'=>'aviones\TarifasTipoAvionController@destroy','as'=>'tipos_aviones/tarifas/eliminar']);

	/**
     *--------------------------------------------
     * RUTAS PARA GESTION AVIONES
     *--------------------------------------------
     * @author Alejandro Aguirre
     *--------------------------------------------
    */
  	Route::get('aviones/listar', ['uses'=>'aviones\AvionesController@index','as'=>'aviones/listar']);
	Route::get('aviones/datatable', ['uses'=>'aviones\AvionesController@dataTableAviones','as'=>'aviones/datatable']);
	Route::get('aviones/crear', ['uses'=>'aviones\AvionesController@create','as'=>'aviones/crear']);
	Route::post('aviones/guardar', ['uses'=>'aviones\AvionesController@store','as'=>'aviones/guardar']);
	Route::get('aviones/editar/{id}', ['uses'=>'aviones\AvionesController@edit','as'=>'aviones/editar']);
	Route::patch('aviones/actualizar/{id}', ['uses'=>'aviones\AvionesController@update','as'=>'aviones/actualizar']);
	Route::post('aviones/eliminar', ['uses'=>'aviones\AvionesController@destroy','as'=>'aviones/eliminar']);

	/**
     *--------------------------------------------
     * RUTAS PARA GESTION LINEAS AEREAS
     *--------------------------------------------
     * @author Alejandro Aguirre
     *--------------------------------------------
    */
  	Route::get('lineas_aereas/listar', ['uses'=>'lineasAereas\LineasAereasController@index','as'=>'lineas_aereas/listar']);
	// Route::get('lineas_aereas/datatable', ['uses'=>'lineasAereas\LineasAereasController@dataTableAviones','as'=>'aviones/datatable']);
	Route::get('lineas_aereas/crear', ['uses'=>'lineasAereas\LineasAereasController@create','as'=>'lineas_aereas/crear']);

	/*
	 * Franklin Saavedra
	 *
	 * INICIO GESTION DESTINOS
	 * ***********************************************************************************************
	 */
	// visualizacion
	Route::get('destinos/listar', ['uses'=>'destinos\DestinosController@index', 'as'=>'destinos/listar']);
	Route::get('destinos/consultar/{id}', ['uses'=>'destinos\DestinosController@consultar', 'as'=>'destinos/consultar']);
	Route::get('destinos/datatable', ['uses'=>'destinos\DestinosController@dataTableDestinos', 'as'=>'destinos/datatable']);
	// crear
	Route::get('destinos/crear', ['uses'=>'destinos\DestinosController@create','as'=>'destinos/crear']);
	Route::post('destinos/guardar', ['uses'=>'destinos\DestinosController@guardar_destino','as'=>'destinos/guardar']);
	// edit
	Route::get('destinos/editar/{id}', ['uses'=>'destinos\DestinosController@edit','as'=>'destinos/editar']);
	Route::post('destinos/actualizar/{id}', ['uses'=>'destinos\DestinosController@update','as'=>'destinos/actualizar']);
	// eliminar
	Route::post('destinos/eliminar/', ['uses'=>'destinos\DestinosController@destroy','as'=>'destinos/eliminar']);


	/**
     *--------------------------------------------
     * RUTAS PARA GESTIÓN DE CHOFERES
     *--------------------------------------------
     * @author Adrián Felipe
     *--------------------------------------------
    */


	//listar
	Route::get('choferes/listar', ['uses'=>'choferes\ChoferesController@index','as'=>'choferes_list']);
	// consultar la información de los choferes para editar
	Route::get('choferes/consultar', ['uses'=>'choferes\ChoferesController@consultar','as'=>'choferes_consultar']);
	// agregar
	Route::get('choferes/crear', ['uses'=>'choferes\ChoferesController@create','as'=>'choferes_create']);
	// almacenar
	Route::post('choferes/almacenar', ['uses'=>'choferes\ChoferesController@store','as'=>'choferes_store']);
	// editar
	Route::get('choferes/{id}/editar',['uses'=>'choferes\ChoferesController@edit','as'=>'choferes_edit']);
	// actualizar
	Route::post('choferes/actualizar',['uses'=>'choferes\ChoferesController@update','as'=>'choferes_update']);
	// eliminar
  Route::post('choferes/eliminar',['uses'=>'choferes\ChoferesController@eliminar', 'as'=>'choferes_eliminar']);
  //list en datatable
  Route::get('choferes/datatable', ['uses'=>'choferes\ChoferesController@dataTableChoferes','as'=>'choferes/datatable']);
	//list de tarifas
	Route::get('choferes/tarifas/{id}', ['uses'=>'choferes\TarifasChoferes@tarifas','as'=>'choferes/tarifas']);
	// Route::get('choferes/tarifas', ['uses'=>'choferes\TarifasChoferes@dataTableTarifasChoferes','as'=>'choferes_tarifas']);
	//guardar de tarifas
	Route::post('choferes/tarifas/almacenar', ['uses'=>'choferes\TarifasChoferes@almacenar','as'=>'choferes/tarifas/almacenar']);
	//actualización de tarifas
	Route::post('choferes/tarifas/actualizar', ['uses'=>'choferes\TarifasChoferes@update','as'=>'choferes/tarifas/actualizar']);
		// elimina la tarifa de un chofer
	Route::post('choferes/tarifas/eliminar', ['uses'=>'choferes\TarifasChoferes@eliminar','as'=>'choferes/tarifas/eliminar']);
	//recuperar tarifas de choferes
	Route::get('choferes/tarifas/datatable/{id}', ['uses'=>'choferes\TarifasChoferes@dataTableTarifasChoferes','as'=>'choferes/tarifas/datatable']);
	// consultar la información de las tarifas de los servicios propios para editar
	Route::get('tarifas_choferes/consultar', ['uses'=>'choferes\TarifasChoferes@consultar','as'=>'choferes_tarifas_consultar']);
	/**
     *--------------------------------------------
     * RUTAS PARA GESTIÓN DE GUÍAS
     *--------------------------------------------
     * @author Adrián Felipe
     *--------------------------------------------
    */

	//listar
	Route::get('guias/listar', ['uses'=>'guias\GuiasController@index','as'=>'guias_list']);
	// agregar
	Route::get('guias/crear', ['uses'=>'guias\GuiasController@create','as'=>'guias_create']);
	// almacenar
	Route::post('guias/almacenar', ['uses'=>'guias\GuiasController@store','as'=>'guias_store']);
    //list en datatable
    Route::get('guias/datatable', ['uses'=>'guias\GuiasController@dataTableGuias','as'=>'guias/datatable']);
    // ruta para eliminar guías
    Route::post('guias/eliminar',['uses'=>'guias\GuiasController@eliminar', 'as'=>'guias_eliminar']);
	// editar
	Route::get('guias/{id}/editar',['uses'=>'guias\GuiasController@edit','as'=>'guias_edit']);
	// actualizar
	Route::post('guias/actualizar',['uses'=>'guias\GuiasController@update','as'=>'guias_update']);
	// consultar la información de los servicios propios para editar
	Route::get('guias/consultar', ['uses'=>'guias\GuiasController@consultar','as'=>'guias_consultar']);
	// consultar la información de los servicios propios para editar
	Route::get('guias_tarifas/consultar', ['uses'=>'guias\TarifaGuias@consultar','as'=>'guias_tarifas_consultar']);
	// elimina la tarifa de una guia
	Route::post('guias/tarifas/eliminar', ['uses'=>'guias\TarifaGuias@eliminar','as'=>'guias/tarifas/eliminar']);
	//list de tarifas
	Route::get('guias/tarifas/{id}', ['uses'=>'guias\TarifaGuias@tarifas','as'=>'guias/tarifas']);
	//guardar de tarifas
	Route::post('guias/tarifas/almacenar', ['uses'=>'guias\TarifaGuias@almacenar','as'=>'guias/tarifas/almacenar']);
	//actualización de tarifas
	Route::post('guias/tarifas/actualizar', ['uses'=>'guias\TarifaGuias@update','as'=>'guias/tarifas/actualizar']);
	//recuperar tarifas de guias
	Route::get('guias/tarifas/datatable/{id}', ['uses'=>'guias\TarifaGuias@dataTableTarifasGuias','as'=>'guias/tarifas/datatable']);
	// consultar la información de las tarifas de los servicios propios para editar
	Route::get('tarifas_guias/consultar', ['uses'=>'guias\TarifaGuias@consultar','as'=>'guias_tarifas_consultar']);
	
	// consultar la información de las tarifas de los servicios propios para editar
	Route::get('tarifas_guias/ciudad_destino', ['uses'=>'guias\TarifaGuias@ciudad_destino','as'=>'ciudad_destino']);
	/**
     *--------------------------------------------
     * RUTAS PARA GESTIÓN DE CLIENTES
     *--------------------------------------------
     * @author Franklin Saavedra
     *--------------------------------------------
    */
	Route::get('clientes/listar', 	['uses'=>'clientes\ClientesController@index','as'=>'clientes/listar']);
	Route::get('clientes/datatable',['uses'=>'clientes\ClientesController@dataTableCliente','as'=>'clientes/datatable']);
  	//crear
	Route::get('clientes/crear', 	['uses'=>'clientes\ClientesController@create','as'=>'clientes/crear']);
	Route::get('clientes/editar/{id}', 	['uses'=>'clientes\ClientesController@edit','as'=>'clientes/editar']);
  	Route::post('clientes/guardar', ['uses'=>'clientes\ClientesController@store','as'=>'clientes/guardar']);

	/**
     *--------------------------------------------
     * RUTAS PARA GESTIÓN DE HOTELES
     *--------------------------------------------
     * @author Vanessa Herrera
     *--------------------------------------------
    */
	Route::get('hoteles/listar', ['uses'=>'hoteles\HotelesController@index','as'=>'hoteles/listar']);
	Route::get('hoteles/crear', ['uses'=>'hoteles\HotelesController@create','as'=>'hoteles/crear']);
	Route::get('hoteles/crear2', ['uses'=>'hoteles\HotelesController@create2','as'=>'hoteles/crear2']);
	Route::get('hoteles/datatable', ['uses'=>'hoteles\HotelesController@dataTableHoteles','as'=>'hoteles/datatable']);
	Route::post('hoteles/guardar', ['uses'=>'hoteles\HotelesController@store','as'=>'hoteles/guardar']);
	Route::get('hoteles/editar/{id}', ['uses'=>'hoteles\HotelesController@edit','as'=>'hoteles/editar']);
	Route::patch('hoteles/actualizar/{id}', ['uses'=>'hoteles\HotelesController@update','as'=>'hoteles/actualizar']);
	Route::post('hoteles/eliminar', ['uses'=>'hoteles\HotelesController@destroy','as'=>'hoteles/eliminar']);
	Route::get('hoteles/tarifas/{idHotel}', ['uses'=>'hoteles\HotelesController@indexTarifas','as'=>'hoteles/tarifas']);
	Route::get('hoteles/tarifasHabitaciones', ['uses'=>'hoteles\HotelesController@TarifasHabitaciones','as'=>'hoteles/tarifasHabitaciones']);

	/*
	*
	* RUTAS GENERICAS
	* ************************************************************************************************
	*/
	//listar paises
	Route::get('list/paises', ['uses'=>'destinos\DestinosController@getListPais','as'=>'listar_paises']);
	//listar estados de un pais
	Route::get('list/estados_pais/{pais}', ['uses'=>'destinos\DestinosController@getListEstadosPais','as'=>'listar_estados_pais']);

	//listar estados
	Route::get('list/estados', ['uses'=>'destinos\DestinosController@getListEstados','as'=>'listar_estados']);

	//listar ciudades de un estado
	Route::get('list/ciudades/{estado}', ['uses'=>'destinos\DestinosController@getListCiudadesEstado','as'=>'listar_ciudades_estado']);

	//listar ciudades
	Route::get('list/ciudades', ['uses'=>'destinos\DestinosController@getListCiudades','as'=>'listar_ciudades']);

	//listar destinos de una ciudad
	Route::get('list/destinos/{ciudad}', ['uses'=>'destinos\DestinosController@getListDestinosCiudad','as'=>'listar_destinos_ciudad']);

	//listar destinos
	Route::get('list/destinos', ['uses'=>'destinos\DestinosController@getListCiudades','as'=>'listar_ciudades']);

	//listar servicios de un destino
	Route::get('list/servicios/{destino}/{tipo}', ['uses'=>'servicios\ServiciosController@getListServiciosDestino','as'=>'listar_servicios_destino']);

	//listar tipo de vehìculos
	Route::get('list/tipoVehiculo', ['uses'=>'vehiculos\VehiculosController@listTipoVehiculos','as'=>'listar_tiposVehiculos']);

	//listar nacionalidades
	Route::get('list/nacionalidades', ['uses'=>'destinos\DestinosController@getListNacionalidades','as'=>'listar_nacionalidades']);

	//listar los tipos de documento
	Route::get('list/tipo_documento', ['uses'=>'parametrizacion\TiposDocumentoController@getListTiposDocumento','as'=>'listar_nacionalidades']);

		//listar los tipos de documento
	Route::get('list/num_licencia', ['uses'=>'choferes\ChoferesController@getListNumLicencia','as'=>'listar_numeros_licencia']);
	/*
	* ********************************************************************************************
	*
	* FIN RUTAS GENERICAS
	*/


  /**
     *--------------------------------------------
     * RUTAS PARA SERVICIOS PROPIOS
     *--------------------------------------------
     * @author Adrián Felipe
     *--------------------------------------------
  */
  //listar
  Route::get('serviciosPropios/listar', ['uses'=>'serviciosPropios\ServiciosPropiosController@index','as'=>'servicios_propios_list']);
  //list en datatable
  Route::get('serviciosPropios/datatable', ['uses'=>'serviciosPropios\ServiciosPropiosController@dataTableServiciosPropios','as'=>'serviciosPropios/datatable']);
  // // agregar
  Route::get('serviciosPropios/crear', ['uses'=>'serviciosPropios\ServiciosPropiosController@create','as'=>'servicios_propios_create']);
  // // almacenar
  Route::post('serviciosPropios/almacenar', ['uses'=>'serviciosPropios\ServiciosPropiosController@store','as'=>'servicios_propios_store']);
  // editar
  Route::get('serviciosPropios/{id}/editar',['uses'=>'serviciosPropios\ServiciosPropiosController@edit','as'=>'servicios_propios_edit']);
  // actualizar
	Route::put('serviciosPropios/actualizar/{id}',['uses'=>'serviciosPropios\ServiciosPropiosController@update','as'=>'servicios_propios_update']);
  // consultar la información de los servicios propios para editar
  Route::get('serviciosPropios/consultar', ['uses'=>'serviciosPropios\ServiciosPropiosController@consultar','as'=>'servicios_propios_consultar']);
  // ruta para eliminar el servicio público
  Route::post('serviciosPropios/eliminar',['uses'=>'serviciosPropios\ServiciosPropiosController@eliminar', 'as'=>'servicios_propios_eliminar']);
	//list de tarifas
	Route::get('serviciosPropios/tarifas/{id}', ['uses'=>'serviciosPropios\TarifasServiciosPropios@tarifas','as'=>'servicios_propios/tarifas']);
	//recuperar tarifas de servicios propios
	Route::get('serviciosPropios/tarifas/datatable/{id}', ['uses'=>'serviciosPropios\TarifasServiciosPropios@dataTableTarifasServPropios','as'=>'serviciosPropios/tarifas/datatable']);
	//guardar de tarifas
	Route::post('serviciosPropios/tarifas/almacenar', ['uses'=>'serviciosPropios\TarifasServiciosPropios@almacenar','as'=>'servicios_propios/tarifas/almacenar']);
	// consultar la información de las tarifas de los servicios propios para editar
	Route::get('tarifas_servicio_propio/consultar', ['uses'=>'serviciosPropios\TarifasServiciosPropios@consultar','as'=>'servicios_propios_tarifas_consultar']);
	// ruta para eliminar la tarifa de un servicio público
	Route::post('tarifasServiciosPropios/eliminar',['uses'=>'serviciosPropios\TarifasServiciosPropios@eliminar', 'as'=>'servicios_propios_tarifas_eliminar']);
	// actualizar tarifas
	// Route::post('tarifasServiciosPropios/actualizar',['uses'=>'serviciosPropios\TarifasServiciosPropios@update','as'=>'actualizar_tarifas_sp']);
	Route::post('update_tar_ser_propio/',['uses'=>'serviciosPropios\TarifasServiciosPropios@update','as'=>'update_tar_ser_propio']);
	Route::resource('serviciosPropios','serviciosPropios\ServiciosPropiosController');

	/**
     *--------------------------------------------
     * RUTAS PARA GESTIÓN TIPOS DE CLIENTES
     *--------------------------------------------
     * @author Vanessa Herrera
     *--------------------------------------------
    */
	Route::get('tipo_cliente/listar', ['uses'=>'Parametrizacion\TipoClienteController@index','as'=>'tipo_cliente/listar']);	
	 Route::get('tipo_cliente/datatable', ['uses'=>'Parametrizacion\TipoClienteController@dataTableTipoCliente','as'=>'tipo_cliente/datatable']);
	

	/**
     *--------------------------------------------
     * RUTAS PARA GESTIÓN DE PROVEEDORES
     *--------------------------------------------
     * @author Franklin Saavedra
     *--------------------------------------------
    */
	Route::get('proveedores/listar', 	['uses'=>'proveedores\ProveedoresController@index','as'=>'proveedores/listar']);
	Route::get('proveedores/datatable',['uses'=>'proveedores\ProveedoresController@dataTableProveedor','as'=>'proveedores/datatable']);
  	//crear
	Route::get('proveedores/crear', 	['uses'=>'proveedores\ProveedoresController@create','as'=>'proveedores/crear']);
	Route::get('proveedores/editar/{id}', 	['uses'=>'proveedores\ProveedoresController@edit','as'=>'proveedores/editar']);
  	Route::post('proveedores/guardar', ['uses'=>'proveedores\ProveedoresController@store','as'=>'proveedores/guardar']);
  	// eliminar
	Route::post('proveedores/eliminar/', ['uses'=>'proveedores\ProveedoresController@destroy','as'=>'proveedores/eliminar']);

});
