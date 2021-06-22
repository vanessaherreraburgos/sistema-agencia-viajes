
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_avion')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> trans('copies.breadcrumbs.list_avion')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_aviones.list_avion')}}<small></small></h5>
                        <div class="ibox-tools-link">
                            <a class="btn btn-white" href="{{url('aviones/crear')}}">
                                <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @component('components.tabla_elementos')    
                            @slot('id')
                                tablaListarAviones
                            @endslot
                            @slot('headers', [
                                trans('copies.gestion_aviones.foto'),
                                trans('copies.gestion_aviones.anno_avion'),
                                trans('copies.gestion_aviones.modelo'),
                                trans('copies.gestion_aviones.marca'),
                                trans('copies.gestion_aviones.tipo_avion'),
                                trans('copies.gestion_aviones.proveedor_avion'),
                                trans('copies.gestion_aviones.estado'),
                                trans('copies.generales.acciones')
                            ])
                        @endcomponent
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
    <script src="{{ asset('/js/gestion/aviones/list_avion.js') }}"></script>
@endsection