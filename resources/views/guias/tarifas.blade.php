@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_tarifas_gui')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"                  => trans('copies.breadcrumbs.home'),
            "guias/listar"          => trans('copies.breadcrumbs.list_guias'),
            "active"                => trans('copies.breadcrumbs.list_tarifas_gui')
        ])
    @endcomponent
@endsection


@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_guias.listado_tarifas_guias')}} <strong>{{$guias->nombre}} {{$guias->apellido1}} {{$guias->apellido2}}</strong><small> - <span class="fuente_azul">{{$guias->getTipoDocumento->abreviado}}: {{$guias->documento}}</span></small></h5>
                        <div class="ibox-tools-link">
                          <!--Save-->
                          <button type="button" class="btn btn-default" id="crear_tarifa" data-toggle="modal" data-target="#modalTarifasGuia">
                            <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                          </button>
                        </div>

                    </div>
                    <div class="ibox-content">
						@component('components.tabla_elementos')
	                		@slot('id')
						        tablaListarTarGuias
						    @endslot
					        @slot('headers', [
                    'Destino',
                    'servicios',
                    'Fechas',
                    'Precio',
						        'acción'
						    ])
					    @endcomponent
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
  <script>
  var tarifaCodigo = '<?php echo $guias->codigo; ?>';
  var tarifasDatatable = "{{url('guias/tarifas/datatable', $guias->codigo)}}";
  </script>
  <script src="{{ asset('/js/guias/listTarifasGuias.js') }}"></script>
  @include('guias.formularios.tarifas_guias')
  @include('guias.formularios.tarifas_guias_editar')

@endsection
