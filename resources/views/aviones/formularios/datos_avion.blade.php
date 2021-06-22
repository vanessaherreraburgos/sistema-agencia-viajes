    <div class="form-group">
        {{ Form::label('foto_avion', trans('copies.gestion_aviones.foto'), ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
        {{ Form::file('foto_avion', ['id' => 'foto', 'autocomplete' => 'off'])}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('anno_avion', trans('copies.gestion_aviones.anno_avion'), ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::selectYear('anno_avion', Carbon\Carbon::now()->format('Y'), 1884, null, ['class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('modelo', trans('copies.gestion_aviones.modelo').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::text('modelo', null, ['class' => 'form-control', 'maxlength' => '20' ]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('marca', trans('copies.gestion_aviones.marca').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::text('marca', null, ['class' => 'form-control', 'maxlength' => '50' ]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('cod_tipo_avion', trans('copies.gestion_aviones.tipo_avion').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::select('cod_tipo_avion', $tiposAviones, null, ['class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('es_propio_si', trans('copies.gestion_aviones.es_propio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <div class="radio radio-primary radio-inline">
                {{ Form::radio('es_propio', '1', false, ['id' => 'es_propio_si']) }}
                <label for="es_propio_si"> {{trans('copies.gestion_aviones.si')}}</label>
            </div>
            <div class="radio radio-primary radio-inline">
                {{ Form::radio('es_propio', '0', false, ['id' => 'es_propio_no']) }}
                <label for="es_propio_no"> {{trans('copies.gestion_aviones.no')}} </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('cod_prov_avion', trans('copies.gestion_aviones.proveedor_avion'), ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::select('cod_prov_avion', $ProveedoresAvion, null, ['id' => 'cod_prov_avion', 'class' => 'form-control selectBusqueda', 'placeholder' => trans('copies.generales.seleccione')]) }}
        </div>
    </div>

    {{ isset($estado) ? $estado : '' }}

    @component('layouts.return_message')    
        @slot('id_mensaje') mensajeGestionAviones @endslot
    @endcomponent