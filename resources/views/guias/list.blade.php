@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.list_guias')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"                  => trans('copies.breadcrumbs.home'),
            "active"                => trans('copies.breadcrumbs.list_guias')
        ])
    @endcomponent
@endsection


@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_guias.listado_guias')}}<small></small></h5>
                        <div class="ibox-tools-link">

                          <!--Save-->
                          <button class="btn btn-default" id="AddGuia" type="button">
                            <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                          </button>

                        </div>

                    </div>
                    <div class="ibox-content">
						@component('components.tabla_elementos')
	                		@slot('id')
						        tablaListarGuias
						    @endslot
					        @slot('headers', [
                    '',
                    'Documento',
                    'Nombres',
                    'Residencia',
                    'Teléfonos',
                    'Email',
                    'Credencial de turismo',
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
	<script src="{{ asset('/js/guias/listGuias.js') }}"></script>
@endsection
