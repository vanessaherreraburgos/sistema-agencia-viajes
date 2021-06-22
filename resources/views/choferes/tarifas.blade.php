@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_tarifas_cho')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"                  => trans('copies.breadcrumbs.home'),
            "choferes/listar"          => trans('copies.breadcrumbs.list_choferes'),
            "active"                => trans('copies.breadcrumbs.list_tarifas_cho')
        ])
    @endcomponent
@endsection


@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_choferes.listado_tarifas_chofer')}} <strong>{{$chofer->nombre}} {{$chofer->apellido1}} {{$chofer->apellido2}}</strong><small> - <span class="fuente_azul">{{$chofer->getTipoDocumento->abreviado}}: {{$chofer->documento}}</span></small></h5>

                        <div class="ibox-tools-link">
                          <!--Save-->
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTarifasChofer">
                            <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                          </button>
                        </div>

                    </div>
                    <div class="ibox-content">
						@component('components.tabla_elementos')
	                		@slot('id')
						        tablaListarTarChoferes
						    @endslot
					        @slot('headers', [
                    'Destino',
                    'Servicios',
                    'Fechas',
                    'Tipo de vehículo',
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
  <script type="text/javascript">
    var tarifaCodigo = '<?php echo $chofer->codigo; ?>';
    var tarifasDatatable = "{{url('choferes/tarifas/datatable', $chofer->codigo)}}";
  </script>
  <script src="{{ asset('/js/choferes/listTarifasChoferes.js') }}"></script>
  @include('choferes.formularios.tarifas_chofer')
  @include('choferes.formularios.tarifas_chofer_editar')
@endsection
