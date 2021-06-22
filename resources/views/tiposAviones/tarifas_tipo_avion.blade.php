
@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.tarifas_tipo_tipo_avion')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
          "home"                      => trans('copies.breadcrumbs.home'),
          "tipos_aviones/listar"      => trans('copies.breadcrumbs.list_tipo_avion'),
          "active"                    => trans('copies.breadcrumbs.tarifas_tipo_tipo_avion')
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
                        <h5>{{trans('copies.gestion_tipo_aviones.tarifas_tipo_avion')}} - <strong>{{$tipoAvion->descripcion}}</strong></h5>
                        <div class="ibox-tools-link">
                            <a class="btn btn-default" id="btnNuevaTarifa">
                                <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                      @component('components.tabla_elementos')
                          @slot('id')
                            tablaTarifasTipoAvion
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
        modalCrearTarifaTipoAvion
    @endslot
    @slot('title')
        {{trans('copies.gestion_tipo_aviones.insert_tarifa_tipo_avion')}}
    @endslot
    @slot('body')
        {{ Form::open(array('url' => url('tipos_aviones/tarifas/guardar'), 'method' => 'PATCH', 'id' => 'formCrearTarifaTipoAvion', 'class' => 'form-horizontal')) }}
            @component('tiposAviones.formularios.datos_tarifa_tipo_avion')
                @slot('codigoTipoAvion')  
                    {{ Form::hidden('cod_tipo_avion', $tipoAvion->codigo, array('id' => 'cod_tipo_avion')) }}
                @endslot
                @slot('idPais', 'pais_crear')
                @slot('idEstado', 'estado_crear')
                @slot('idCiudad', 'ciudad_crear')
                @slot('idDestino', 'destino_crear')
                @slot('serviciosTipoAvion', $serviciosTipoAvion)
            @endcomponent
        {{ Form::close() }}


        @component('layouts.return_message')    
          @slot('id_mensaje') mensajeCrearTarifaTipoAvion @endslot
        @endcomponent

        <div class='clearfix'></div>
    @endslot
    @slot('footer')
        <div class="col-md-12 text-center">
            {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white', 'data-dismiss'=>'modal']) }}
            {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearTarifaTipoAvion', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
        </div>
    @endslot
  @endcomponent

  @component('components.modal')
      @slot('id')
          modalEditarTarifaTipoAvion
      @endslot
      @slot('title')
          {{trans('copies.gestion_tipo_aviones.editar_tarifa_tipo_avion')}}
      @endslot
      @slot('body')
          {{ Form::open(array('url' => url('tipos_aviones/tarifas/actualizar'), 'method' => 'PATCH', 'id' => 'formEditarTarifaTipoAvion', 'class' => 'form-horizontal')) }}
              @component('tiposAviones.formularios.datos_tarifa_tipo_avion')
                @slot('codigoTipoAvion')  
                    {{ Form::hidden('cod_tipo_avion', $tipoAvion->codigo, array('id' => 'cod_tipo_avion')) }}
                @endslot
                @slot('idPais', 'pais_editar')
                @slot('idEstado', 'estado_editar')
                @slot('idCiudad', 'ciudad_editar')
                @slot('idDestino', 'destino_editar')
                @slot('serviciosTipoAvion', $serviciosTipoAvion)
              @endcomponent
          {{ Form::close() }}

          @component('layouts.return_message')    
            @slot('id_mensaje') mensajeEditarTarifaTipoAvion @endslot
          @endcomponent

          <div class='clearfix'></div>
      @endslot
      @slot('footer')
          <div class="col-md-12 text-center">
              {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white', 'data-dismiss'=>'modal']) }}
              {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnEditarTarifaTipoAvion', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
          </div>
      @endslot
  @endcomponent

@endsection

@section('codigo_scripts')
  <script>
    var tarifasTipoAvionDatatable = "{{url('tipos_aviones/tarifas/datatable',$tipoAvion->codigo)}}";
  </script>
  <script src="{{ asset('/js/gestion/tiposAviones/tarifas_tipo_avion.js') }}"></script>
@endsection
