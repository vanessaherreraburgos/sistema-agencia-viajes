
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.editar_tipo_avion')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 					 => trans('copies.breadcrumbs.home'),
	        "tipos_aviones/listar"    => trans('copies.breadcrumbs.list_tipo_avion'),
	        "active" 				 => trans('copies.breadcrumbs.editar_tipo_avion')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.breadcrumbs.editar_tipo_avion')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                    	{{ Form::model($tipoAvion, array('url' => url('tipos_aviones/actualizar',$tipoAvion->codigo), 'method' => 'PATCH', 'id' => 'formEditarTipoAvion', 'class' => 'form-horizontal')) }}

                            @component('tiposAviones.formularios.datos_tipo_avion')
                                @slot('estado')  
                                    <div class="form-group">
                                        {{ Form::label('activo', trans('copies.gestion_tipo_aviones.estado').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
                                        <div class="col-sm-10">
                                            <div class="radio radio-primary radio-inline">
                                                {{ Form::radio('activo', '1', false, ['id' => 'activo_si']) }}
                                                <label for="activo_si"> {{trans('copies.generales.activo')}}</label>
                                            </div>
                                            <div class="radio radio-danger radio-inline">
                                                {{ Form::radio('activo', '0', false, ['id' => 'activo_no']) }}
                                                <label for="activo_no"> {{trans('copies.generales.inactivo')}} </label>
                                            </div>
                                        </div>
                                    </div>  
                                @endslot
                            @endcomponent

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white']) }}
                                    {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnEditarTipoAvion', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
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
	<script src="{{ asset('/js/gestion/tiposAviones/editar_tipo_avion.js') }}"></script>
@endsection