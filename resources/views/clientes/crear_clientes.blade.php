
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_clientes')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
	        "home" 					=> trans('copies.breadcrumbs.home'),
	        "clientes/listar" 		=> trans('copies.breadcrumbs.list_clientes'),
	        "active" 				=> trans('copies.breadcrumbs.crear_clientes')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
      <div class="ibox">
      <div class="ibox-content">
        <form id="formCrearCliente" action="{{ route('clientes/guardar') }}" class="wizard-big form-horizontal" method="post" enctype="multipart/form-data">
          <h1>{{trans('copies.gestion_cliente.info_cliente')}}</h1>
          <fieldset>
            <div class="scroll">
            <div class="form-group">
              {{ Form::label('razon_social', trans('copies.gestion_cliente.razon_social'), ['class' => 'col-sm-2 control-label']) }}
              <div class="col-sm-6 col-lg-10">
                {{ Form::text('razon_social', '', ['class' => 'form-control required', 'placeholder' => '', 'maxlength' => '100' ]) }}
              </div>
            </div>
            <div class="form-group">
                {{ Form::label('nombre_comercial', trans('copies.gestion_cliente.nombre_comercial'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-6 col-lg-10">
                  {{ Form::text('nombre_comercial',  '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('cod_tipo_cliente', trans('copies.gestion_cliente.cod_tipo_cliente'), ['class' => 'col-sm-2  control-label']) }}
                <div class="col-sm-2 col-lg-2">
                  {{ Form::select('cod_tipo_cliente', $tipo_cliente, '', ['id'=>'cod_tipo_cliente', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.gestion_cliente.cod_tipo_cliente') ]) }}
                </div>
                {{ Form::label('porcentaje_dscto', trans('copies.gestion_cliente.porcentaje_dscto'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-2 col-lg-2">
                  {{ Form::number('porcentaje_dscto', '', ['class' => 'form-control required', 'placeholder' => '', 'maxlength' => '10' ]) }}
                </div>
                {{ Form::label('identificacion_fiscal', trans('copies.gestion_cliente.identificacion_fiscal'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-2 col-lg-2">
                  {{ Form::text('nro_fiscal', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '10' ]) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 col-md-2 col-lg-2">
                    {{ Form::label('ubicacion', trans('copies.gestion_cliente.ubicacion').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                </div>
                <div class="col-sm-3 col-md-2 col-lg-2">
                    {{ Form::select('cod_pais', [], null, ['id'=>'cod_pais', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_pais') ]) }}
                </div>
                <div class="col-sm-3 col-md-2 col-lg-2">
                    {{ Form::select('cod_estado', [], null, ['id'=>'cod_estado', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_estado') ]) }}
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    {{ Form::select('cod_ciudad', [], null, ['id'=>'cod_ciudad', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_ciudad') ]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('cod_tipo_documento', trans('copies.gestion_cliente.cod_tipo_documento'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-3 col-md-2 col-lg-2">
                  {{ Form::select('cod_tipo_documento', $tipo_documento, '', ['id'=>'cod_tipo_documento', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.gestion_cliente.cod_tipo_documento') ]) }}
                </div>
                {{ Form::label('documento', trans('copies.gestion_cliente.documento'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-3 col-md-3 col-lg-6">
                  {{ Form::text('documento', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '20' ]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('direccion', trans('copies.gestion_cliente.direccion'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-6 col-lg-10">
                  {{ Form::textarea('direccion', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '120', 'rows'=>'2' ]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('telefono1', trans('copies.gestion_cliente.telefono1'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-3 col-md-2 col-lg-4">
                  {{ Form::text('telefono1', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                </div>
                {{ Form::label('telefono2', trans('copies.gestion_cliente.telefono2'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-3 col-md-2 col-lg-4">
                  {{ Form::text('telefono2', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('correo1', trans('copies.gestion_cliente.correo1'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-6 col-lg-4">
                  {{ Form::text('correo1', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                </div>
                {{ Form::label('correo2', trans('copies.gestion_cliente.correo2'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-6 col-lg-4">
                  {{ Form::text('correo2', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('pagina_web', trans('copies.gestion_cliente.pagina_web'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-6 col-lg-10">
                  {{ Form::text('pagina_web', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                </div>
            </div>
          </div>
          </fieldset>
          <h1>{{trans('copies.gestion_cliente.info_cliente_otros')}}</h1>
          <fieldset>
            <div class="scroll">
            <div class="form-group">
              {{ Form::label('ref_tour_lider', trans('copies.gestion_cliente.ref_tour_lider'), ['class' => 'col-sm-2 control-label']) }}
              <div class="col-sm-3 col-md-3 col-lg-10">
                {{ Form::text('ref_tour_lider', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '60' ]) }}
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('codigo_postal', trans('copies.gestion_cliente.codigo_postal'), ['class' => 'col-sm-2 control-label']) }}
              <div class="col-sm-3 col-md-3 col-lg-4">
                {{ Form::text('codigo_postal', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '10' ]) }}
              </div>
              {{ Form::label('fecha_inicio', trans('copies.gestion_cliente.fecha_inicio'), ['class' => 'col-sm-2 control-label']) }}
              <div class="col-sm-3 col-md-3 col-lg-4">
                {{ Form::date('fecha_inicio_relacion_laboral', '', ['class' => 'form-control ', 'placeholder' => '', 'maxlength' => '12' ]) }}
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('motivo_inicio', trans('copies.gestion_cliente.motivo_inicio'), ['class' => 'col-sm-2 control-label']) }}
              <div class="col-sm-3 col-md-6 col-lg-10">
                {{ Form::textarea('motivo_inicio_relacion_ciente', '', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '60', 'rows'=>'3' ]) }}
              </div>
            </div>
            <!-- fotos -->
            <div class="form-group">
                {{ Form::label('foto', trans('copies.gestion_cliente.fotos'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-3 col-md-6 col-lg-10">
                    {{ Form::file('foto', ['id' => 'foto', 'name' => 'foto[]', 'class' => '', 'multiple'=>'false' ])}}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('destinos', trans('copies.gestion_cliente.destinos'), ['class' => 'col-sm-2 control-label']) }}
                <div class="col-sm-3 col-md-7 col-lg-10">
                  {{ Form::select('cod_destino', $destinos, '', ['id'=>'cod_destino', 'name'=>'cod_destino[]', 'class' => 'form-control select2 required chosen-select', 'placeholder' => '' ,'multiple'=>'multiple' ]) }}
                </div>
            </div>
          </div>
          </fieldset>
        </form>
      </div>
      </div> <!-- ibox-->
      </div>
		</div>
	</div>
@endsection
@section('codigo_scripts')
  <script> 
      var ruta_sitio = "{{asset('/')}}";
      var ruta_adjuntos = "{{Config::get('constants.RUTA_FOTOS_CLIENTE')}}";
      var array_rutas_adjuntos = new Array();
  </script>    
  <script src="{{ asset('/js/clientes/crear_cliente.js') }}"></script>
@endsection
