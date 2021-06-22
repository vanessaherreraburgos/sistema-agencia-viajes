
  <div class="form-group">

    {{ isset($codigoTipoVehiculo) ? $codigoTipoVehiculo : '' }}

    {{Form::hidden('codigo', null, array('id' => 'codigo'))}}

    {{ Form::label('cod_pais', trans('copies.form_general.ubicacion').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label'  ]) }}
    <div class="col-sm-3 m-b">
        {{ Form::select('cod_pais', [], null, ['id'=> $idPais, 'class' => 'form-control select2', 'placeholder' => trans('copies.generales.select_pais'),  'required'=>'required' ]) }}
    </div>
    <div class="col-sm-3 m-b">
        {{ Form::select('cod_estado', [], null, ['id'=>$idEstado, 'class' => 'form-control select2 ', 'placeholder' => trans('copies.generales.select_estado') , 'required'=>'required' ]) }}
    </div>
    <div class="col-sm-3 m-b">
        {{ Form::select('cod_ciudad', [], null, ['id'=> $idCiudad, 'class' => 'form-control select2 ', 'placeholder' => trans('copies.generales.select_ciudad') , 'required'=>'required' ]) }}
    </div>
  </div>
  <div class="form-group">
      {{ Form::label('cod_destino', trans('copies.gestion_destinos.destino').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label'  ]) }}
      <div class="col-sm-10">
          {{ Form::select('cod_destino', [], null, ['id'=> $idDestino, 'class' => 'form-control select2', 'placeholder' => trans('copies.generales.select_destino'),  'required'=>'required' ]) }}
      </div>
  </div>
  <div class="form-group">
      {{ Form::label('destino', trans('copies.select2.servicio'), ['class' => 'col-sm-2 control-label'  ]) }}
      <div class="col-sm-10">
          {{ Form::select('cod_serv_tipo_veh', $serviciosTipoVehiculo, null, ['id'=>'cod_serv_tipo_veh', 'class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione'),  'required'=>'required' ]) }}
      </div>
  </div>
  <div class="form-group rangoFechas">
    {{ Form::label('fecha_inicial', trans('copies.generales.rango_fechas').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
      <div class="input-daterange input-group col-sm-10 p-l p-r">
          {{ Form::text('fecha_inicial', null, ['id' => 'fecha_inicial', 'class' => 'form-control', 'maxlength' => '15']) }}
          <span class="input-group-addon">{{trans('copies.generales.a')}}</span>
          {{ Form::text('fecha_final', null, ['id' => 'fecha_final', 'class' => 'form-control', 'maxlength' => '15' ]) }}
      </div>
  </div>
  <div class="form-group">
    {{ Form::label('precio_usd', trans('copies.generales.precio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label'  ]) }}
    <div class="col-md-3">
      {{ Form::text('precio_usd', null, ['id' => 'precio_usd', 'class' => 'form-control', 'maxlength' => '15' ]) }}
    </div>
  </div>
