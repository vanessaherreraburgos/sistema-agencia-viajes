
<div class="form-group">
    {{ Form::label('foto_vehiculo', trans('copies.gestion_vehiculos.foto'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
    {{ Form::file('foto_vehiculo', ['id' => 'foto', 'autocomplete' => 'off'])}}
    </div>
</div>
<div class="form-group">
    {{ Form::label('placa', trans('copies.gestion_vehiculos.placa'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('placa', null, ['class' => 'form-control', 'placeholder' => null, 'maxlength' => '10' ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('numero', trans('copies.gestion_vehiculos.numero'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('numero', null, ['class' => 'form-control', 'placeholder' => null, 'maxlength' => '15' ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('anno_vehiculo', trans('copies.gestion_vehiculos.anno_vehiculo'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::selectYear('anno_vehiculo', Carbon\Carbon::now()->format('Y'), 1884, null, ['class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('modelo', trans('copies.gestion_vehiculos.modelo').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('modelo', null, ['class' => 'form-control', 'maxlength' => '30' ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('marca', trans('copies.gestion_vehiculos.marca').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('marca', null, ['class' => 'form-control', 'maxlength' => '30' ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('color', trans('copies.gestion_vehiculos.color'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('color', null, ['class' => 'form-control', 'maxlength' => '15' ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('cod_tipo_vehiculo', trans('copies.gestion_vehiculos.tipo_vehiculo').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('cod_tipo_vehiculo', $tiposVehiculo, null, ['class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('es_propio_si', trans('copies.gestion_vehiculos.es_propio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="radio radio-primary radio-inline">
            {{ Form::radio('es_propio', '1', false, ['id' => 'es_propio_si']) }}
            <label for="es_propio_si"> {{trans('copies.gestion_vehiculos.si')}}</label>
        </div>
        <div class="radio radio-primary radio-inline">
            {{ Form::radio('es_propio', '0', false, ['id' => 'es_propio_no']) }}
            <label for="es_propio_no"> {{trans('copies.gestion_vehiculos.no')}} </label>
        </div>
    </div>
</div>
<div class="form-group">
    {{ Form::label('cod_proveedor_vehiculo', trans('copies.gestion_vehiculos.proveedor_vehiculo'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('cod_proveedor_vehiculo', $proveedoresVehiculo, null, ['id' => 'cod_proveedor_vehiculo', 'class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
    </div>
</div>

{{ isset($estado) ? $estado : '' }}

@component('layouts.return_message')    
    @slot('id_mensaje') mensajeGestionVehiculo @endslot
@endcomponent