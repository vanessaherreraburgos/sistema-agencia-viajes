
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_tipo_vehiculo')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_tipo_vehiculo')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_tipo_vehiculos.list_tipo_vehiculo')}}<small></small></h5>
                        <div class="ibox-tools-link">
                            <a class="btn btn-white" href="{{url('tipos_vehiculos/crear')}}">
                                <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @component('components.tabla_elementos')    
                            @slot('id')
                                tablaListarTiposVehiculos
                            @endslot
                            @slot('headers', [
                                trans('copies.gestion_tipo_vehiculos.descripcion'),
                                trans('copies.gestion_tipo_vehiculos.cantidad_max_pasajeros'),
                                trans('copies.gestion_tipo_vehiculos.cantidad_ventanas'),
                                trans('copies.gestion_tipo_vehiculos.estado'),
                                trans('copies.generales.acciones')
                            ])
                        @endcomponent
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
    <script src="{{ asset('/js/gestion/tiposVehiculos/list_tipo_vehiculo.js') }}"></script>
@endsection