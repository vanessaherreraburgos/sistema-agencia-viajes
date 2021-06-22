@extends('layouts.template')

	@section('title')
		{{trans('copies.breadcrumbs.crear_destino')}}
	@endsection

	@section('hist_navegacion')
		@component('components.historial_navegacion')    
			@slot('breadcrumbs', [
				"home" 					=> trans('copies.breadcrumbs.home'),
				"destinos/listar" 		=> trans('copies.breadcrumbs.list_destino'),
				"active" 				=> trans('copies.breadcrumbs.crear_destino')
			])
		@endcomponent
	@endsection

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title border-bottom">
					<h5>
						{{ trans('copies.gestion_destinos.crear_destino') }}
						<small></small>
					</h5>
				</div>
				<div class="ibox-content">
					<form id="formCrearDestino" action="{{ route('destinos/guardar') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
						<input name="_token" type="hidden" value="{{ csrf_token() }}" />
						<!-- ubicación -->							
						<div class="form-group">
				            <div class="col-md-2">
				                {{ Form::label('ubicacion', trans('copies.gestion_destinos.ubicacion').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
				            </div>
				            <div class="col-md-3">
				                {{ Form::select('pais', [], null, ['id'=>'pais', 'class' => 'form-control select2', 'placeholder' => trans('copies.generales.select_pais'),  'required'=>'required' ]) }}
				            </div>
				            <div class="col-md-3">
				                {{ Form::select('estado', [], null, ['id'=>'estado', 'class' => 'form-control select2 ', 'placeholder' => trans('copies.generales.select_estado') , 'required'=>'required' ]) }}
				            </div>
				            <div class="col-md-3">
				                {{ Form::select('ciudad', [], null, ['id'=>'ciudad', 'class' => 'form-control select2 ', 'placeholder' => trans('copies.generales.select_ciudad') , 'required'=>'required' ]) }}
				            </div>
			            </div>	
						<!-- nombre -->
						<div class="form-group">
							<label class="col-sm-2 control-label">
								{{ trans('copies.gestion_destinos.nombre') }}
							</label>
							<div class="col-sm-6 col-md-9">
								<input type="text" class="form-control" name="nombre_destino" id="nombre_destino" required/>
							</div>
						</div>
						<!-- descripcion -->
						<div class="form-group">
							<label class="col-sm-2 control-label">
								{{ trans('copies.gestion_destinos.descripcion') }}
							</label>
							<div class="col-sm-6 col-md-9">
							<input type="text" class="form-control" name="descripcion_destino" id="descripcion_destino" required>
							</div>
						</div>
						<!-- direccion -->
						<div class="form-group">
							<label class="col-sm-2 control-label">
								{{ trans('copies.gestion_destinos.direccion') }}
							</label>
							<div class="col-sm-6 col-md-9">									
								 <textarea class="form-control" name="direccion_destino" id="direccion_destino" rows="3" maxlength=50 required></textarea>
							</div>
						</div>
						<!-- kilometros -->						
						<div class="form-group">
						{{ Form::label('cant_km_recorrer', trans('copies.gestion_destinos.cant_km'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-3 col-md-3 col-lg-3">
							{{ Form::number('cant_km_recorrer', '', ['class' => 'form-control required', 'placeholder' => '', 'maxlength' => '6', 'required'=>'required' ]) }}
							</div>
						</div>	
						<!-- dias -->						
						<div class="form-group">
						{{ Form::label('cant_km_recorrer', trans('copies.gestion_destinos.cant_dias'), ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-3 col-md-3 col-lg-3">
							{{ Form::number('cant_dias_traslado', '', ['class' => 'form-control required', 'placeholder' => '', 'maxlength' => '6', 'required'=>'required'  ]) }}
							</div>
						</div>	
						<!-- fotos -->						
						<div class="form-group">						 		
	                        {{ Form::label('fotos', trans('copies.gestion_destinos.fotos'), ['class' => 'col-sm-2 control-label']) }}
	                        <div class=" col-sm-6 col-md-9">
	                            {{ Form::file('fotos', ['id' => 'fotos', 'name' => 'fotos[]', 'class' => '', 'multiple'=>'true' ])}}
	                        </div>                        	
                        </div>	
						<hr>
						<!-- guardar -->
						<div class="form-group text-right">
							<div class="col-sm-6 col-md-11">
								<button id="btnCrearDestino" type="button" class="btn btn-primary">
									{{ trans('copies.generales.guardar') }}
								</button>
								<button type="reset" class="btn btn-secondary">
									{{ trans('copies.generales.limpiar') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
@endsection

@section('codigo_scripts') 
	<script src="{{ asset('/js/destinos/crear_destinos.js') }}"></script>
@endsection
