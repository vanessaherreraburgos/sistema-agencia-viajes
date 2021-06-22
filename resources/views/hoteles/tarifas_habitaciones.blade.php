
@extends('layouts.template')

@section('title')
    Tarifas de Habitaciones
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
          "home"      => trans('copies.breadcrumbs.home'),
          "active"    => 'Tarifas de Habitaciones del Hotel Roraima Suit'
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
                        <h5>Ingrese Tarifas de las Habitaciones por Temporada<small></small></h5>
                        <div class="ibox-tools-link">
                            <a class="btn btn-default" id="btnNuevaTarifa">
                                <i class="fa fa-plus"></i> {{trans('copies.generales.boton_nuevo')}}
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                      <table  class="table table-striped table-bordered table-hover" >
                          <thead>
                              <tr>                                                
                                  <th class="fuente_azul">Clase de Habitación </th>   
                                  <th class="fuente_azul">Fecha Inicio </th>  
                                  <th class="fuente_azul">Fecha Fin </th>  
                                  <th class="fuente_azul">Precio $ </th>  
                                  <th class="fuente_azul">Acción </th>   
                              </tr>
                          </thead>
                          <tbody>
                              <tr>                                                
                                  <td >Simple</td>   
                                  <td > 01/07/2018</td> 
                                  <td > 01/10/2018</td> 
                                  <td > 345</td> 
                                  <td ><i class="fa fa-trash-o"></i></td>   
                              </tr>
                              <tr>                                                
                                  <td >Doble</td>   
                                  <td > 01/07/2018</td> 
                                  <td > 01/10/2018</td> 
                                  <td > 425</td> 
                                  <td ><i class="fa fa-trash-o"></i></td>   
                              </tr>
                              <tr>                                                
                                  <td >Triple</td>   
                                  <td > 01/07/2018</td> 
                                  <td > 01/10/2018</td> 
                                  <td > 544</td> 
                                  <td ><i class="fa fa-trash-o"></i></td>   
                              </tr>
                          </tbody>
                         
                      </table>
                    </div>
                </div>
            </div>
    </div>
  </div>

  @component('components.modal')
    @slot('id')
      modalCrearTarifaVehiculo
    @endslot
    @slot('title')
      Insertar Tarifa de Habitación
    @endslot
    @slot('body')

      <div class="form-group col-xs-12"> 
          {{ Form::label('Tipo de Habitación', trans('copies.generales.rango_fechas'), ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-10">
             <select data-placeholder="Seleccionar..." class="select2"  name="tipo_hab" id="tipo_hab" style="width: 50%">
              <option value=""> </option>
             
                  <option value="1">Simple</option>
                  <option value="2">Doble</option>
                  <option value="3">Triple</option>
             
              </select>
          </div>
      </div>
 
    <div class="form-group col-xs-12 rangoFechas">
      {{ Form::label('fecha_inicial', trans('copies.generales.rango_fechas'), ['class' => 'col-sm-2 control-label']) }}
        <div class="input-daterange input-group col-sm-10 p-l p-r">
            {{ Form::text('fecha_inicial', null, ['id' => 'fecha_inicial', 'class' => 'form-control', 'maxlength' => '15']) }}
            <span class="input-group-addon">{{trans('copies.generales.a')}}</span>
            {{ Form::text('fecha_final', null, ['id' => 'fecha_final', 'class' => 'form-control', 'maxlength' => '15' ]) }}
        </div>
    </div>
    <div class="form-group col-xs-12">
      {{ Form::label('precio_usd', trans('copies.generales.precio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label'  ]) }}
      <div class="col-md-3">
        {{ Form::text('precio_usd', null, ['id' => 'precio_usd', 'class' => 'form-control', 'maxlength' => '15' ]) }}
      </div>
    </div>
     <!-- <div class='clearfix'></div> -->
    @endslot
    @slot('footer')
      <div class="col-md-12 text-center">
        {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white', 'data-dismiss'=>'modal']) }}
        {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearTarifaVehiculo', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
      </div>
    @endslot
  @endcomponent

 

@endsection

@section('codigo_scripts')
  <script>
     $('#tipo_hab').select2();
     $('#btnNuevaTarifa').on( 'click', function () {
    
    $("#modalCrearTarifaVehiculo").modal();
  });
  </script>
 
@endsection
