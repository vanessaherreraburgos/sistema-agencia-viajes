@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_proveedores')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_proveedores')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
          <div class="ibox">
              <div class="ibox-title border-bottom">
                  <h5>{{trans('copies.gestion_proveedores.listado_proveedores')}}<small></small></h5>
                  <div class="ibox-tools">
                      <a class="btn btn-white" href="{{route('proveedores/crear')}}">
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
                      trans('copies.gestion_proveedores.codigo'),
                      trans('copies.gestion_proveedores.razon_social'),
        			        trans('copies.gestion_proveedores.nombre'),
        			        trans('copies.gestion_proveedores.telefono'),
                      trans('copies.gestion_proveedores.email'),
                      trans('copies.gestion_proveedores.acciones')
        			    ])
        		    @endcomponent
              </div>
          </div>
      </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
    <script src="{{ asset('/js/proveedores/list_proveedores.js') }}"></script>
@endsection
