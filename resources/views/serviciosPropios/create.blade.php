
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_servicios_propios')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
	        "home" 					=> trans('copies.breadcrumbs.home'),
	        "vehiculos/listar" 		=> trans('copies.breadcrumbs.list_servicios_propios'),
	        "active" 				=> trans('copies.breadcrumbs.crear_servicios_propios')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_servicios_propios.crear_servicio_propio')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                    	{{ Form::open(array('url' => 'serviciosPropios/almacenar', 'id' => 'create_servicios_propios', 'class' => 'form-horizontal')) }}
                              @component('serviciosPropios.forms.form_servicio_propio')
                                @slot('buttonText') {{trans('copies.generales.boton_guardar')}} @endslot
                                @slot('buttonCanId') btnCancelarServicioPropio  @endslot
                                @slot('buttonId') btnCrearServicioPropio  @endslot
                              @endcomponent

                              
	                    {{ Form::close() }}
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('codigo_scripts')
	<script src="{{ asset('/js/serviciosPropios/serviciosPropios.js') }}"></script>
@endsection
