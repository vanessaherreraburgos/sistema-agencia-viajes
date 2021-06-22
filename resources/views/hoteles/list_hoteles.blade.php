
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_hotel')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_hotel')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_hoteles.listado_hotel')}}<small></small></h5>
                        <div class="ibox-tools">
                            <a class="btn btn-white" href="{{url('hoteles/crear')}}">
                                <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
						@component('components.tabla_elementos')    
	                		@slot('id')
						        tablaListarHoteles
						    @endslot
					        @slot('headers', [
					            'Foto',
						        trans('copies.gestion_hoteles.nombre_nomercial'),
						        trans('copies.gestion_hoteles.destino'),
	                            trans('copies.gestion_hoteles.telefonos'),
						        trans('copies.gestion_hoteles.correos'),
						        trans('copies.gestion_hoteles.categoria_hotel'),
						        trans('copies.gestion_hoteles.min_estadia'),	
						        trans('copies.gestion_hoteles.acciones')
						    ])
					    @endcomponent
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
	<script src="{{ asset('/js/hoteles/list_hoteles.js') }}"></script>
@endsection