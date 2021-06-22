@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_provee_vehiculos')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_provee_vehiculos')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
          <div class="ibox">
              <div class="ibox-title border-bottom">
                  <h5>{{trans('copies.gestion_proveedores_vehiculos.listado_proveedores')}}<small></small></h5>
                  <div class="ibox-tools">
                      <a class="btn btn-white" href="{{route('clientes/crear')}}">
                          <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
        			@component('components.tabla_elementos')
                  @slot('id')
        			        tablaListarProveedores
        			    @endslot
        		        @slot('headers', [                      
        			        trans('copies.gestion_proveedores_vehiculos.codigo'),
                      trans('copies.gestion_proveedores_vehiculos.codigo'),
                      trans('copies.gestion_proveedores_vehiculos.razon_social'),
        			        trans('copies.gestion_proveedores_vehiculos.nombre'),
        			        trans('copies.gestion_proveedores_vehiculos.telefono'),
                      trans('copies.gestion_proveedores_vehiculos.email'),
                      trans('copies.gestion_proveedores_vehiculos.acciones')
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
