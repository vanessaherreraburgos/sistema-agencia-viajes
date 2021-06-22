
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_clientes')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_clientes')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
          <div class="ibox">
              <div class="ibox-title border-bottom">
                  <h5>{{trans('copies.gestion_cliente.listado_cliente')}}<small></small></h5>
                  <div class="ibox-tools">
                      <a class="btn btn-white" href="{{route('clientes/crear')}}">
                          <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
        			@component('components.tabla_elementos')
                  @slot('id')
        			        tablaListarClientes
        			    @endslot
        		        @slot('headers', [                      
        			        trans('copies.gestion_cliente.cod_tipo_cliente'),
                      trans('copies.gestion_cliente.cod_tipo_cliente'),
                      trans('copies.gestion_cliente.nombre_comercial'),
        			        trans('copies.gestion_cliente.cod_pais'),
        			        trans('copies.gestion_cliente.telefono1'),
                      trans('copies.gestion_cliente.acciones')
        			    ])
        		    @endcomponent
              </div>
          </div>
      </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
    <script src="{{ asset('/js/clientes/list_cliente.js') }}"></script>
@endsection
