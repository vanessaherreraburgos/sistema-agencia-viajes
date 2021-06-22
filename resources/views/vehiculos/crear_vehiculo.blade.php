
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_vehiculo')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 					=> trans('copies.breadcrumbs.home'),
	        "vehiculos/listar" 		=> trans('copies.breadcrumbs.list_vehiculo'),
	        "active" 				=> trans('copies.breadcrumbs.crear_vehiculo')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_vehiculos.crear_vehiculo')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                    	{{ Form::open(array('url' => 'vehiculos/guardar', 'files' => true, 'id' => 'formCrearVehiculo', 'class' => 'form-horizontal')) }}

                            @component('vehiculos.formularios.datos_vehiculo')
                                @slot('tiposVehiculo', $tiposVehiculo)
                                @slot('proveedoresVehiculo', $proveedoresVehiculo)
                            @endcomponent
                            
	                        <div class="hr-line-dashed"></div>
                    		<div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white']) }}
                                	{{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearVehiculo', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
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
    <script src="{{ asset('/js/gestion/vehiculos/vehiculo.js') }}"></script>
    <script src="{{ asset('/js/gestion/vehiculos/crear_vehiculo.js') }}"></script>
@endsection