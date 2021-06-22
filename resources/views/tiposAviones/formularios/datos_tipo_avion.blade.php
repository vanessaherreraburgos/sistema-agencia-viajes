
<div class="form-group">
    {{ Form::label('descripcion', trans('copies.gestion_tipo_aviones.descripcion').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => null, 'maxlength' => '50' ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('cantidad_max_pasajeros', trans('copies.gestion_tipo_aviones.cantidad_max_pasajeros').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('cantidad_max_pasajeros', null, ['class' => 'form-control', 'placeholder' => null, 'maxlength' => '10' ]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('cantidad_ventanas', trans('copies.gestion_tipo_aviones.cantidad_ventanas').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('cantidad_ventanas', null, ['class' => 'form-control', 'placeholder' => null, 'maxlength' => '10' ]) }}
    </div>
</div>

{{ isset($estado) ? $estado : '' }}

@component('layouts.return_message')    
    @slot('id_mensaje') mensajeGestionTipoAvion @endslot
@endcomponent