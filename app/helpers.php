<?php

use App\Models\tarifasServPropios\tarifasServPropios;
use App\Models\tarifasGuias\tarifasGuias;
use App\Models\tarifasChofer\tarifasChofer;
/*
* Genera el array mutinivel con el contenido del menu.
* @author  Alejandro Aguirre
* @data    12/03/2018
* @param   Ninguno
* @return  Array menu, arreglo multinivel con todas las opciones del menu.
*/
function contenidoMenu(){

    $menu = [
    			[
    				'ulid'     	=> 'side-menu',
	                'ulClass'	=> 'nav metismenu',
	            ],
	            [
	                'ulClass'  	=> '',
	                'url'       => 'home',
	                'icon'      => 'fa fa-home',
	                'text'      => trans('copies.menu.home'),
	            ],
	            [
                    'ulClass'   => 'nav nav-second-level collapse',
                    'url'       => 'destinos/listar',
                    'icon'      => 'fa fa-map-marker',
                    'text'      => trans('copies.menu.gestion.destinos'),
                ],
                [
	                'ulClass'   => '',
	                'url'       => 'hoteles/listar',
	                'icon'      => 'fa fa-building-o',
	                'text'      => trans('copies.menu.hoteles'),

	            ],
	            [
	                'ulClass'   => '',
	                'url'       => 'clientes/listar',
	                'icon'      => 'fa fa-user-circle-o',
	                'text'      => trans('copies.menu.clientes'),

	            ],	            
	            [
	                'ulClass'   => '',
	                'url'       => '#',
	                'icon'      => 'fa fa fa-cog',
	                'text'      => trans('copies.menu.configuracion.modulo'),
	                'nodes'     =>	[
				                       
										[
				                            'ulClass'   => 'nav nav-second-level collapse',
				                            'url'       => 'tipos_vehiculos/listar',
				                            'icon'      => 'fa fa-car',
				                            'text'      => trans('copies.menu.gestion.tipos_vehiculos'),
				                        ],
				                        [
				                            'ulClass'   => 'nav nav-second-level collapse',
				                            'url'       => 'vehiculos/listar',
				                            'icon'      => 'fa fa-car',
				                            'text'      => trans('copies.menu.gestion.vehiculos'),
				                        ],
				                        [
				                            'ulClass'   => 'nav nav-second-level collapse',
				                            'url'       => 'tipos_aviones/listar',
				                            'icon'      => 'fa fa-plane',
				                            'text'      => trans('copies.menu.gestion.tipos_aviones'),
				                        ],				                        
				                        [
				                            'ulClass'   => 'nav nav-second-level collapse',
				                            'url'       => 'aviones/listar',
				                            'icon'      => 'fa fa-plane',
				                            'text'      => trans('copies.menu.gestion.aviones'),
				                        ],
				                        // [
				                        //     'ulClass'   => 'nav nav-second-level collapse',
				                        //     'url'       => 'lineas_aereas/listar',
				                        //     'icon'      => 'fa fa-ticket',
				                        //     'text'      => trans('copies.menu.gestion.lineas_aereas'),
				                        // ],
				                        [
				                            'ulClass'   => 'nav nav-second-level collapse',
				                            'url'       => 'choferes/listar',
				                            'icon'      => 'fa fa-bus',
				                            'text'      => trans('copies.menu.gestion.choferes'),
				                        ],
				                        [
				                            'ulClass'   => 'nav nav-second-level collapse',
				                            'url'       => 'guias/listar',
				                            'icon'      => 'fa fa-street-view',
				                            'text'      => trans('copies.menu.gestion.guias'),
				                        ],
				                        [
				                            'ulClass'   => 'nav nav-second-level collapse',
				                            'url'       => 'serviciosPropios/listar',
				                            'icon'      => 'fa fa-cart-plus',
				                            'text'      => trans('copies.menu.gestion.serv_propios'),
				                        ],				                       
                    			   	],
	            ],
	             [
	                'ulClass'   => '',
	                'url'       => 'logout',
	                'icon'      => 'fa fa-power-off',
	                'text'      => 'Cerrar sesión',

	            ],	

        	];

	return $menu ;
}

/*
* Genera el menu de la aplicación de forma dinamica.
* @author  Alejandro Aguirre
* @data    12/03/2018
* @param   Array menu, arreglo multinivel con todas las opciones del menu.
* @return  HTML con menu generado.
*/
function generarMenu($menu){

	$ulid  	  = !empty ($menu[0]['ulid']) ? $menu[0]['ulid']  : '';
	$ulClass  = $menu[0]['ulClass'];
	$html 	  = "<ul class='".$ulClass."' id='".$ulid."'>";

	foreach ($menu as $index => $opcionMenu){

		if(!empty ($opcionMenu['ulid'])){

			// genera el header del menu.
			$html .= 	"<li class='nav-header'>
				            <div class='dropdown profile-element' style='height: 43px'>
				            </div>
				            <div class='logo-element'>
				                <img src='".asset('/images/logo-peq.png')."'/>
				            </div>
				        </li>";
		}
		else{

			$url  	= $opcionMenu['url'];
			$icon 	= $opcionMenu['icon'];
			$text 	= $opcionMenu['text'];
			$nodes 	= !empty ($opcionMenu['nodes']) ? $opcionMenu['nodes']  : null;

			$html .= 	"<li>";
			$html .= 	"<a href='".url($url)."'>
							<i class='".$icon."'></i> <span class='nav-label'>".$text."</span>"
							.(!empty($nodes) ? "</span><span class='fa arrow'></span>" : '')
						."</a>";

			if(!empty($nodes)){
				$html .= generarMenu($nodes);
				$html .= 	"</li>";
			}
			else
				$html .= 	"</li>";
		}
   	}

   	$html .= "</ul>";
   	return $html;
}

/**
 * Elimina un archivo del disco duro.
 * @param  Request $rutaArchivo, ruta del archivo desde la caperta /images en adelante.
 * @return  elimina archivo si existe
 *          0 si el archivo no existe
 *         -1 ocurrio excepción
 */
function eliminarArchivo($rutaArchivo){

    try{

        $rutaReemplazar = public_path($rutaArchivo);
        $buscar      = array(url('/').'/', "/");
        $remplazar   = array("", "\\");

        // la ruta se vuelve como una ubicación de disco duro.
        $rutaArchivoEliminar = str_replace( $buscar, $remplazar, $rutaReemplazar);

        if(file_exists($rutaArchivoEliminar))
            return unlink($rutaArchivoEliminar);
        else
            return 0;
    }
    catch(\Exception $e){
        return -1;
    }
}



/*
* Genera la fecha actual en formato d/m/Y.
* @author  Alejandro Aguirre
* @data    15/04/2018
* @return  fecha actual en formato d/m/Y.
*/
function fechaActual(){
	return \Carbon\Carbon::now()->format('d/m/Y');
}

/*
* Valida que no se crucen las fechas de las tarifas de un servicio propio.
* @author  Adrián Felipe Arroyave Tabares
* @data    12/08/2018
* @return  fecha válida o no
*/
function validarFechasTarifasSP($request, $editar=null){

	// Opción 1: si la fecha final de una tarifa es menor a la fecha inicial de la nueva tarifa es válido
	// ó
	// Opción 2: si la fecha final de la nueva tarifa es menor a la fecha inicial de una tarifa tarifa existente es válido
	//-----------------------------------------------------------------------------------------------------------------------
	//$editar: es el paràmetro que se recibe desde las modales de edición de tarifas.

	//si se está editando una tarifa no se tiene en cuenta validar la fecha de la actual tarifa.
	if ($editar != null) {
		$tarifas = tarifasServPropios::where('cod_serv_propio', $request->cod_serv_propio)->where('codigo', '!=', $request->id_tarifa)->get();  
	}else{ // si se va a crear valida todas las fechas de las tarifas 
		$tarifas = tarifasServPropios::where('cod_serv_propio', $request->cod_serv_propio)->get();  
	}
	$valido = true;
	// se recorren las tarifas y se comparan las fechas
	foreach ($tarifas as $tarifa) {
		if (!(($tarifa->fecha_final_tsp < $request->fecha_inicio_tsp) || ($request->fecha_final_tsp < $tarifa->fecha_inicio_tsp))) {
			$valido = false;
		}else{
			$valido = true;
		}
	}
		return $valido;
}


/*
* Valida que no se crucen las fechas de las tarifas de un guía.
* @author  Adrián Felipe Arroyave Tabares
* @data    12/08/2018
* @return  fecha válida o no
*/
function validarFechasTarifasGuias($request, $editar=null){

	// Opción 1: si la fecha final de una tarifa es menor a la fecha inicial de la nueva tarifa es válido
	// ó
	// Opción 2: si la fecha final de la nueva tarifa es menor a la fecha inicial de una tarifa tarifa existente es válido
	//-----------------------------------------------------------------------------------------------------------------------
	//$editar: es el paràmetro que se recibe desde las modales de edición de tarifas.

	//si se está editando una tarifa no se tiene en cuenta validar la fecha de la actual tarifa.
	if ($editar != null) {
		$tarifas = tarifasGuias::where('cod_guia', $request->idTarifaGui)->where('cod_destino', $request->cod_destino)->where('servicio', $request->servicio)->where('codigo', '!=', $request->id_tarifa_guias)->get();  
	}else{ // si se va a crear valida todas las fechas de las tarifas 
		$tarifas = tarifasGuias::where('cod_guia', $request->idTarifaGui)->where('cod_destino', $request->destino)->where('servicio', $request->servicio)->get();  
	}
	$valido = true;
	// se toman los valores del request dependiendo del formulario que llega
	if ($editar != null) {
		$fecha_inicio_request = $request->fecha_inicial_tar_gui;  
		$fecha_fin_request = $request->fecha_final_tar_gui;  
	}else{  
		$fecha_inicio_request = $request->fecha_inicio;  
		$fecha_fin_request = $request->fecha_fin;  
	}

	foreach ($tarifas as $tarifa) {
		if (!(($tarifa->fecha_final_tar_gui < $fecha_inicio_request) || ($fecha_fin_request < $tarifa->fecha_inicial_tar_gui))) {
			$valido = false;
		}else{
			$valido = true;
		}
	}
		return $valido;
}


/*
* Valida que no se crucen las fechas de las tarifas de un chofer.
* @author  Adrián Felipe Arroyave Tabares
* @data    12/08/2018
* @return  fecha válida o no
*/
function validarFechasTarifasChoferes($request, $editar=null){

	// Opción 1: si la fecha final de una tarifa es menor a la fecha inicial de la nueva tarifa es válido
	// ó
	// Opción 2: si la fecha final de la nueva tarifa es menor a la fecha inicial de una tarifa tarifa existente es válido
	//-----------------------------------------------------------------------------------------------------------------------
	//$editar: es el paràmetro que se recibe desde las modales de edición de tarifas.

	//si se está editando una tarifa no se tiene en cuenta validar la fecha de la actual tarifa.
	if ($editar != null) {
		$tarifas = tarifasChofer::where('cod_chofer', $request->idTarifaCho)->where('cod_destino', $request->destino_tar_chofer)->where('servicio', $request->servicio_tar_chofer)->where('cod_tipo_vehiculo', $request->tipo_vehiculo)->where('codigo', '!=', $request->id_tarifa_choferes)->get();  
	}else{ // si se va a crear valida todas las fechas de las tarifas 
		$tarifas = tarifasChofer::where('cod_chofer', $request->idTarifaCho)->where('cod_destino', $request->destino)->where('servicio', $request->servicio)->where('cod_tipo_vehiculo', $request->tipo_vehiculo)->get();  
	}
	$valido = true;

		$fecha_inicio_request = $request->fecha_inicio;  
		$fecha_fin_request = $request->fecha_fin;  
	

	foreach ($tarifas as $tarifa) {
		if (!(($tarifa->fecha_final_tar_cho < $fecha_inicio_request) || ($fecha_fin_request < $tarifa->fecha_inicial_tar_cho))) {
			$valido = false;
		}else{
			$valido = true;
		}
	}
		return $valido;
}

/*
* Especifica los valores que no seran tenidos en cuenta por la función
* php array_filter
* @author  Alejandro Aguirre
* @data    02/09/2018
* @param   Ninguno
* @return  boolean
*/
function filtroPersonalizado($var){
  return ($var !== FALSE && $var !== '');
}










