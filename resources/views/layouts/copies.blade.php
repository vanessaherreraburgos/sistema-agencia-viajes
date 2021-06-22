<script>

var conf = {
	baseURL:                    "{{ url('/') }}",
	lenguaje_plugins:           "es",
	language_datatable:         "{{ asset('././theme_inspinia/js/plugins/dataTables/locales/es.json') }}",
	pais_estado_list:           "{{ url('/') }}"+"/list/estados_pais",
	estado_list:                "{{ url('/') }}"+"/list/estados",
	ciudad_list:                "{{ url('/') }}"+"/list/ciudades",
	destino_list:               "{{ url('/') }}"+"/list/destinos",
	servicios_list:             "{{ url('/') }}"+"/list/servicios",
	tipo_vehiculo_list:         "{{ url('/') }}"+"/list/tipoVehiculo",
	nacionalidad_list:          "{{ url('/') }}"+"/list/nacionalidades",
	tipo_documento_list:        "{{ url('/') }}"+"/list/tipo_documento",
	num_licencia_list:          "{{ url('/') }}"+"/list/num_licencia",

}

var mensajes_generales = {
	no_encontro_datos: 		"{{ trans('copies.generales.no_encontro_datos') }}",
	debe_selec_pais: 		"{{ trans('copies.generales.debe_selec_pais') }}",
	debe_selec_estado: 		"{{ trans('copies.generales.debe_selec_estado') }}",
	debe_selec_ciudad: 		"{{ trans('copies.generales.debe_selec_ciudad') }}",
	debe_selec_destino:     "{{ trans('copies.generales.debe_selec_destino') }}",
	exito_guardar: 			"{{ trans('copies.generales.exito_guardar') }}" ,
	error_guardar: 			"{{ trans('copies.generales.error_guardar') }}" ,
	exito_eliminar: 		"{{ trans('copies.generales.exito_eliminar') }}" ,
	error_eliminar: 		"{{ trans('copies.generales.error_eliminar') }}" ,
  	mensaje_exito:          "{{ trans('copies.generales.mensaje_exito') }}" ,
  	mensaje_error:          "{{ trans('copies.generales.mensaje_error') }}" ,
	swal_aceptar:           "{{ trans('copies.swal.acept') }}" ,
  	swal_cancelar:          "{{ trans('copies.swal.cancel') }}" ,
	advertencia_title:      "{{ trans('copies.swal.aviso') }}" ,
	confirmanularswal:      "{{ trans('copies.generales.confirmanularswal') }}",
	todos:      			"{{ trans('copies.generales.todos') }}",
	fechas_inv_tar:   	    "{{ trans('copies.generales.fechas_inv_tar') }}",
}

//para funciones genericas de select2
var select2   =   {
    pais:                       "{{ trans('copies.select2.pais')}}",
    estado:                     "{{ trans('copies.select2.estado')}}",
    ciudad:                     "{{ trans('copies.select2.ciudad')}}",
    destino:                    "{{ trans('copies.select2.destino')}}",
    servicio:                   "{{ trans('copies.select2.servicio')}}",
    tipo_vehiculo:              "{{ trans('copies.select2.tipo_vehiculo')}}",
	seleccione:					"{{ trans('copies.select2.seleccione') }}"
}

var perfiles  =   {
	chofer: 				    "{{ trans('copies.perfiles.chofer')}}",
}

var gestion_vehiculos  =   {
	elemento_existe: 		"{{ trans('copies.gestion_vehiculos.elemento_existe')}}",
	rango_fec_existem: 		"{{ trans('copies.gestion_vehiculos.rango_fec_existem')}}",
}

var validacion = {
	LISTA_BLANCA_IMAGENES_JS: "{{Config::get('constants.LISTA_BLANCA_IMAGENES_JS')}}",
}

</script>
