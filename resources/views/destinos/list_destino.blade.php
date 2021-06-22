@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_destino')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_destino')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
          <div class="ibox">
              <div class="ibox-title border-bottom">
                  <h5>{{trans('copies.gestion_destinos.titulo')}}<small></small></h5>
                  <div class="ibox-tools">
                      <a class="btn btn-white" href="{{route('destinos/crear')}}">
                          <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
        			@component('components.tabla_elementos')
                  @slot('id')
        			      tablaListarDestinos
        			    @endslot
        		        @slot('headers', [
                      trans('copies.gestion_destinos.destino'),
        			        trans('copies.gestion_destinos.direccion'),
        			        trans('copies.gestion_destinos.km_recorrer'),
        			        trans('copies.gestion_destinos.cant_dias_tras'),
                      trans('copies.gestion_destinos.acciones')
        			    ])
        		    @endcomponent
              </div>
          </div>
      </div>
		</div>
	</div>
@endsection

@section('codigo_scripts') 
	<script src="{{ asset('/js/gestion/list_destino.js') }}"></script>
@endsection
