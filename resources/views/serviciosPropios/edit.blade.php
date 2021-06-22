
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.editar_servicios_propios')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
	        "home" 					=> trans('copies.breadcrumbs.home'),
	        "vehiculos/listar" 		=> trans('copies.breadcrumbs.list_servicios_propios'),
	        "active" 				=> trans('copies.breadcrumbs.editar_servicios_propios')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="row">
			<div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_servicios_propios.editar_servicio_propio')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                      {!! Form::model($serviciosPropios, array('method' => 'PUT', 'route'=>array('servicios_propios_update', $serviciosPropios->codigo), 'class' => 'form-horizontal', 'id' => 'update_servicios_propios')) !!}
                            @component('serviciosPropios.forms.form_servicio_propio')
                              @slot('buttonText') {{trans('copies.generales.boton_editar')}} @endslot
                              @slot('buttonCanId') btnCancelarServicioPropio  @endslot
                              @slot('buttonId') btnEditarServicioPropio  @endslot
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
  @if($serviciosPropios->codigo != null)
      <script type="text/javascript">
      var chofer_id = '<?php echo $serviciosPropios->codigo ?>';
           editar_usuario(chofer_id, 'serviciosPropios');
      </script>
  @endif
@endsection
