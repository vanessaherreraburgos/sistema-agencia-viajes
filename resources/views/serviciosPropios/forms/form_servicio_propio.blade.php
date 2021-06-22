<div class="form-group">
      {{ Form::label('nombre', trans('copies.gestion_servicios_propios.nombre'), ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
      {{ Form::text('nombre', '', ['id' => 'nombre', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba')]) }}
    </div>
</div>
<div class="form-group">
   {{ Form::label('descripcion', trans('copies.gestion_servicios_propios.descripcion'), ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10">
    {{ Form::textarea('descripcion', '', ['id' => 'descripcion', 'class' => 'form-control', 'size' => '30x4', 'placeholder' => trans('copies.form_general.escriba')]) }}
  </div>
</div>

<div class="form-group">
   {{ Form::label('foto_servicio_propio', trans('copies.form_general.foto'), ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10">
    {{ Form::file('foto_servicio_propio', ['id'=>'foto_servicio_propio', 'class' => 'form-control-file', 'multiple'=>'true', 'aria-describedby'=>'fileHelp']) }}
      <small id="fileHelp" class="form-text text-muted">
          {{trans('copies.form_general.text-foto')}}
      </small>
  </div>
</div>


@component('layouts.return_message')    
  @slot('id_mensaje') message_servicio_propio @endslot
@endcomponent

<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        {{ Form::button(trans('copies.generales.boton_cancelar'), ['id' => $buttonCanId, 'class' => 'btn btn-white']) }}
        {{ Form::button($buttonText, ['id' => $buttonId, 'class' => 'btn btn-primary', 'data-style' => 'zoom-in']) }}
    </div>
</div>
