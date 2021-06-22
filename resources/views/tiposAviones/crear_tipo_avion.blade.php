
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_tipo_avion')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 					  => trans('copies.breadcrumbs.home'),
	        "tipos_aviones/listar"    => trans('copies.breadcrumbs.list_tipo_avion'),
	        "active" 				  => trans('copies.breadcrumbs.crear_tipo_avion')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_tipo_aviones.crear_tipo_avion')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                    	{{ Form::open(array('url' => 'tipos_aviones/guardar', 'files' => true, 'id' => 'formCrearTipoAvion', 'class' => 'form-horizontal')) }}

                            @component('tiposAviones.formularios.datos_tipo_avion')
                            @endcomponent
                            
	                        <div class="hr-line-dashed"></div>
                    		<div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white']) }}
                                	{{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearTipoAvion', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
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
    <script src="{{ asset('/js/gestion/tiposAviones/tipo_avion.js') }}"></script>
    <script src="{{ asset('/js/gestion/tiposAviones/crear_tipo_avion.js') }}"></script>
@endsection