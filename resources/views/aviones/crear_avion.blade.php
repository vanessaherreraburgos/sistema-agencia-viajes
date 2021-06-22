
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_avion')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 					=> trans('copies.breadcrumbs.home'),
	        "aviones/listar" 		=> trans('copies.breadcrumbs.list_avion'),
	        "active" 				=> trans('copies.breadcrumbs.crear_avion')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_aviones.crear_avion')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open(array('url' => 'aviones/guardar', 'files' => true, 'id' => 'formCrearAvion', 'class' => 'form-horizontal')) }}
                            
                            @component('aviones.formularios.datos_avion')
                                @slot('tiposAviones', $tiposAviones)
                                @slot('ProveedoresAvion', $ProveedoresAvion)
                            @endcomponent

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white']) }}
                                    {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearAvion', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
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
    <script src="{{ asset('/js/gestion/aviones/avion.js') }}"></script>
    <script src="{{ asset('/js/gestion/aviones/crear_avion.js') }}"></script>
@endsection