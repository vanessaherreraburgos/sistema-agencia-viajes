
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_tipo_vehiculo')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 					 => trans('copies.breadcrumbs.home'),
	        "tipos_vehiculos/listar" => trans('copies.breadcrumbs.list_tipo_vehiculo'),
	        "active" 				 => trans('copies.breadcrumbs.crear_tipo_vehiculo')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_tipo_vehiculos.crear_tipo_vehiculo')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                    	{{ Form::open(array('url' => 'tipos_vehiculos/guardar', 'files' => true, 'id' => 'formCrearTipoVehiculo', 'class' => 'form-horizontal')) }}

                            @component('tiposVehiculos.formularios.datos_tipo_vehiculo')
                            @endcomponent
                            
	                        <div class="hr-line-dashed"></div>
                    		<div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white']) }}
                                	{{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearTipoVehiculo', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
                                </div>
                            </div>
	                    {{ Form::close() }}
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
    <script src="{{ asset('/js/gestion/tiposVehiculos/tipo_vehiculo.js') }}"></script>
    <script src="{{ asset('/js/gestion/tiposVehiculos/crear_tipo_vehiculo.js') }}"></script>
@endsection