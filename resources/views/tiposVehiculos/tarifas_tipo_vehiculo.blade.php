
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.tarifas_tipo_vehiculo')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
          "home"                      => trans('copies.breadcrumbs.home'),
          "tipos_vehiculos/listar"    => trans('copies.breadcrumbs.list_tipo_vehiculo'),
          "active"                    => trans('copies.breadcrumbs.tarifas_tipo_vehiculo')
      ])
    @endcomponent
@endsection

@section('content')
  <!-- <div class="wrapper wrapper-content animated fadeInRight"> -->
  <div class="wrapper wrapper-content">
    <div class="row">
      <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title border-bottom">
                        <h5>{{trans('copies.gestion_tipo_vehiculos.tarifas_tipo_vehiculo')}} - <strong>{{$tipoVehiculo->descripcion}}</strong></h5>
                        <div class="ibox-tools-link">
                            <a class="btn btn-default" id="btnNuevaTarifa">
                                <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                      @component('components.tabla_elementos')
                          @slot('id')
                            tablaTarifasTipoVehiculo
                          @endslot
                          @slot('headers', [
                              trans('copies.generales.fechas'),
                              trans('copies.generales.destino'),
                              trans('copies.generales.servicio'),
                              trans('copies.generales.precio'),
                              trans('copies.generales.acciones')
                          ])
                      @endcomponent
                    </div>
                </div>
            </div>
    </div>
  </div>

  @component('components.modal')
    @slot('id')
        modalCrearTarifaTipoVehiculo
    @endslot
    @slot('title')
        {{trans('copies.gestion_tipo_vehiculos.insert_tarifa_tipo_vehiculo')}}
    @endslot
    @slot('body')
        {{ Form::open(array('url' => url('tipos_vehiculos/tarifas/guardar'), 'method' => 'PATCH', 'id' => 'formCrearTarifaTipoVehiculo', 'class' => 'form-horizontal')) }}
            @component('tiposVehiculos.formularios.datos_tarifa_tipo_vehiculo')
                @slot('codigoTipoVehiculo')  
                    {{ Form::hidden('cod_tipo_vehiculo', $tipoVehiculo->codigo, array('id' => 'cod_tipo_vehiculo')) }}
                @endslot
                @slot('idPais', 'pais_crear')
                @slot('idEstado', 'estado_crear')
                @slot('idCiudad', 'ciudad_crear')
                @slot('idDestino', 'destino_crear')
                @slot('serviciosTipoVehiculo', $serviciosTipoVehiculo)
            @endcomponent
        {{ Form::close() }}

        @component('layouts.return_message')    
          @slot('id_mensaje') mensajeCrearTarifaTipoVeh @endslot
        @endcomponent

        <div class='clearfix'></div>
    @endslot
    @slot('footer')
        <div class="col-md-12 text-center">
            {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white', 'data-dismiss'=>'modal']) }}
            {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearTarifaTipoVehiculo', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
        </div>
    @endslot
  @endcomponent

  @component('components.modal')
      @slot('id')
          modalEditarTarifaTipoVehiculo
      @endslot
      @slot('title')
          {{trans('copies.gestion_tipo_vehiculos.editar_tarifa_tipo_vehiculo')}}
      @endslot
      @slot('body')
          {{ Form::open(array('url' => url('tipos_vehiculos/tarifas/actualizar'), 'method' => 'PATCH', 'id' => 'formEditarTarifaTipoVehiculo', 'class' => 'form-horizontal')) }}
              @component('tiposVehiculos.formularios.datos_tarifa_tipo_vehiculo')
                @slot('codigoTipoVehiculo')  
                    {{ Form::hidden('cod_tipo_vehiculo', $tipoVehiculo->codigo, array('id' => 'cod_tipo_vehiculo')) }}
                @endslot
                @slot('idPais', 'pais_editar')
                @slot('idEstado', 'estado_editar')
                @slot('idCiudad', 'ciudad_editar')
                @slot('idDestino', 'destino_editar')
                @slot('serviciosTipoVehiculo', $serviciosTipoVehiculo)
              @endcomponent
          {{ Form::close() }}

          @component('layouts.return_message')    
            @slot('id_mensaje') mensajeEditarTarifaTipoVeh @endslot
          @endcomponent
          <div class='clearfix'></div>
      @endslot
      @slot('footer')
          <div class="col-md-12 text-center">
              {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white', 'data-dismiss'=>'modal']) }}
              {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnEditarTarifaTipoVehiculo', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
          </div>
      @endslot
  @endcomponent

@endsection

@section('codigo_scripts')
  <script>
    var tarifasTipoVehiculoDatatable = "{{url('tipos_vehiculos/tarifas/datatable',$tipoVehiculo->codigo)}}";
  </script>
  <script src="{{ asset('/js/gestion/tiposVehiculos/tarifas_tipo_vehiculo.js') }}"></script>
@endsection
