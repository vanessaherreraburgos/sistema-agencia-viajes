<!--A3 === CONTIENE LA PANTALLA MODAL CON FORMULARIO DE DATOS PERSONALES DE RESIDENCIA(Adrián) === -->
<div id="modalTarifasGuia" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content bordeado">
			<div class="modal-header titulo-modal">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">{{trans('copies.gestion_guias.insertar_tarifa_guia')}}</h4>
			</div>
			<div class="modal-body fondo-cuerpo-modal" id="">

				<!--Lugar de nacimiento-->
		    <div class="form-group">
		    <div class='clearfix'></div>
		    <div style="height: 10px;"></div>

				{!! Form::open(['route'=>'guias/tarifas/almacenar', 'method' => 'POST', 'id' => 'FormCrearTarGuia', 'class' => 'wizard-big', 'enctype' => 'multipart/form-data']) !!}
				{{ csrf_field() }}

				<input type="hidden" name="idTarifaGui" value="{{$guias->codigo}}">
		    <div class="col-md-3 text-right">
		        {{ Form::label('lugar_residencia', trans('copies.form_general.lugar_residencia').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
		    </div>

		    <div class="col-md-3">

		        {{ Form::select('cod_pais_res', [], 1, ['id'=>'cod_pais_tar_guia', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_pais') ]) }}
		    </div>

		    <div class="col-md-3">
		        {{ Form::select('cod_estado_res', [], 1, ['id'=>'cod_estado_tar_guia', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_estado') ]) }}
		    </div>
		    <div class="col-md-3">

		        {{ Form::select('cod_ciudad_res', [], 1, ['id'=>'cod_ciudad_tar_guia', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_ciudad') ]) }}

		    </div>
		    </div>
        <div class='clearfix'></div>
        <div style="height: 10px;"></div>
        <div class="form-group">
          <div class="col-md-3 text-right">
              {{ Form::label('fechas', trans('copies.gestion_destinos.fecha_inicio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
          </div>
          <div class="col-md-3">
            {{Form::date('fecha_inicio', \Carbon\Carbon::now(),['id'=>'fecha_inicio', 'class' => 'form-control select2', 'placeholder' => trans('copies.gestion_destinos.fecha_inicio'),  'required'=>'required' ]) }}
          </div>
          <div class="col-md-3 m-t-sm text-right">
              {{ Form::label('fechas', trans('copies.gestion_destinos.fecha_fin').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
          </div>
          <div class="col-md-3">
            {{Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin', 'class' => 'form-control select2', 'placeholder' => trans('copies.gestion_destinos.fecha_fin'),  'required'=>'required' ]) }}
          </div>

        </div>
          <div class='clearfix'></div>
          <div style="height: 10px;"></div>
          <div class="form-group">
            <div class="col-md-3 text-right">
                {{ Form::label('destino', trans('copies.gestion_destinos.destino').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('destino', [], null, ['id'=>'destino_tar_guia', 'class' => 'form-control select2', 'placeholder' => trans('copies.generales.select_destino'),  'required'=>'required' ]) }}
            </div>
            <div class="col-md-3 m-t-sm text-right">
                {{ Form::label('servicio', trans('copies.gestion_hoteles.servicios').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('servicio', [], null, ['id'=>'servicio_gui', 'class' => 'form-control select2 ', 'placeholder' => trans('copies.gestion_hoteles.servicios') , 'required'=>'required' ]) }}
            </div>

          </div>

          <div class='clearfix'></div>
          <div style="height: 10px;"></div>

          <div class="form-group">

          	
            <div class="col-md-3 m-t-sm text-right">
              {{ Form::label('precio', trans('copies.generales.precio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
            </div>
            <div class="col-md-3">
              {{Form::text('precio_usd', null,['id'=>'precio_usd', 'class' => 'form-control select2', 'placeholder' => trans('copies.generales.precio'),  'required'=>'required' ]) }}
            </div>
            
            <div class="col-md-3">
            </div>
            <div class="col-md-3 text-center ">

            </div>

          </div>

          @component('layouts.return_message')    
            @slot('id_mensaje') message_tar_guia @endslot
          @endcomponent


				<div class='clearfix'></div>
			</div>

			<div class="modal-footer">

				<div class="col-md-12" id="buttonmessagerespac">

					<center>

						<button type="button" data-dismiss="modal" class="btn btn-default btn-rounded btn-outline pull-center" data-style="zoom-in" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{trans('copies.generales.boton_cancelar')}}">{{trans('copies.generales.boton_cancelar')}}</button>
						&nbsp;&nbsp;
						<button id="createTarGuia" type="button" class="btn btn-success btn-rounded btn-outline pull-center" data-style="zoom-in" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{trans('copies.generales.boton_guardar')}}">{{trans('copies.generales.boton_guardar')}}</button>

					</center>
				</div>
			</div>
			{!!Form::close()!!}
		</div>

	</div>

  <script type="text/javascript">
    jsCrearTarGuia();
  </script>
  
</div>
