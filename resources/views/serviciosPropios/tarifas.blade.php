@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_tarifas_sep')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"                                    => trans('copies.breadcrumbs.home'),
            "serviciosPropios/listar"                  => trans('copies.breadcrumbs.list_servicios_propios'),
            "active"                                  => trans('copies.breadcrumbs.list_tarifas_sep')
        ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_servicios_propios.listado_tarifas_servprop')}} <strong>{{$serviciosPropios->nombre}} </strong></h5>
                        <div class="ibox-tools-link">
                          <!--Save-->
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTarifasServPropios">
                          <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                          </button>
                          
                        </div>
                    </div>
                    <div class="ibox-content">
						@component('components.tabla_elementos')
	                		@slot('id')
						        tablaListarTarifasServiciosPropios
						    @endslot
					        @slot('headers', [
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
  @include('serviciosPropios.forms.tarifas_servPropios')
  @include('serviciosPropios.forms.tarifas_servPropios_editar')
@endsection

@section('codigo_scripts')
  <script>
    var tarifaCodigo = '<?php echo $serviciosPropios->codigo; ?>';
    var tarifasDatatable = "{{url('serviciosPropios/tarifas/datatable', $serviciosPropios->codigo)}}";
  </script>
	<script src="{{ asset('/js/serviciosPropios/listTarifasServPropios.js') }}"></script>

@endsection
