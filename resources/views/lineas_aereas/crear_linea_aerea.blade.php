
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_linea_aerea')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 					=> trans('copies.breadcrumbs.home'),
	        "lineas_aereas/listar" 	=> trans('copies.breadcrumbs.list_linea_aerea'),
	        "active" 				=> trans('copies.breadcrumbs.crear_linea_aerea')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_lineas_aereas.crear_linea_aerea')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open(array('url' => '', 'id' => 'formCrearLineaAerea', 'class' => 'form-horizontal')) }}
                            <div class="form-group">
                                {{ Form::label('descripcion', trans('copies.gestion_lineas_aereas.descripcion').' *', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('descripcion', '', ['size' => '50x3', 'class' => 'form-control', 'maxlength' => '100' ]) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('tipo', trans('copies.gestion_lineas_aereas.tipo'), ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('tipo', ['1' => 'Nacional', '2' => 'Internacional'], null, ['class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('', trans('copies.gestion_lineas_aereas.rutas_linea_aerea'), ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">

                                    <div class="form-inline m-b-md">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                {{ Form::select('cod_destino', ['L' => 'Large', 'S' => 'Small'], null, ['id' => 'cod_destino', 'class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                {{ Form::text('precio', '', ['id' => 'precio', 'class' => 'form-control', 'maxlength' => '15' ]) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                {{ Form::button(trans('copies.generales.boton_agregar'), ['id' => 'agregar', 'class' => 'btn btn-primary']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div id="mensaje_error" class="col-md-12">
                                            
                                        </div>
                                    </div>

                                    @component('components.tabla_elementos')    
                                        @slot('id')
                                            tabla
                                        @endslot
                                        @slot('headers', [
                                            'Rendering engine',
                                            'Browser',
                                            'acción'
                                        ])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white']) }}
                                    {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearVehiculo', 'class' => 'btn btn-primary', 'data-style' => 'zoom-in']) }}
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
@endsection