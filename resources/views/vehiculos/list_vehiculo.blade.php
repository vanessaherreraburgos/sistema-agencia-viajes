
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_vehiculo')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_vehiculo')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_vehiculos.list_vehiculo')}}<small></small></h5>
                        <div class="ibox-tools-link">
                            <a class="btn btn-default" href="{{url('vehiculos/crear')}}">
                                <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
						@component('components.tabla_elementos')    
	                		@slot('id')
						        tablaListarVehiculos
						    @endslot
					        @slot('headers', [
								trans('copies.gestion_vehiculos.foto'),
						        trans('copies.gestion_vehiculos.numero'),
						        trans('copies.gestion_vehiculos.especif_vehiculo'),
						        trans('copies.gestion_vehiculos.tipo_vehiculo'),
						        trans('copies.gestion_vehiculos.proveedor_vehiculo'),
						        trans('copies.gestion_vehiculos.estado'),
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
	<script src="{{ asset('/js/gestion/vehiculos/list_vehiculo.js') }}"></script>
@endsection