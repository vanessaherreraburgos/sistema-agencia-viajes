<!--A3 === CONTIENE LA PANTALLA MODAL CON FORMULARIO DE DATOS PERSONALES DE RESIDENCIA(Adrián) === -->
<div id="modalTarifasServPropios" class="modal fade" role="dialog">
	<div class="modal-dialog ">

		<!-- Modal content-->
		<div class="modal-content bordeado">
			<div class="modal-header titulo-modal">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">{{trans('copies.gestion_servicios_propios.insertar_tarifa_servPropios')}}</h4>
			</div>
			<div class="modal-body fondo-cuerpo-modal" id="">

          <div class='clearfix'></div>
          <div style="height: 10px;"></div>

					{!! Form::open(['route'=>'servicios_propios/tarifas/almacenar', 'method' => 'POST', 'id' => 'FormCrearTarSerPro', 'class' => 'wizard-big', 'enctype' => 'multipart/form-data']) !!}

					{{ csrf_field() }}
					<input type="hidden" name="cod_serv_propio" value="{{$serviciosPropios->codigo}}">
          <div class="form-group">
            <div class="col-md-2">
                {{ Form::label('fechas', trans('copies.gestion_destinos.fecha_inicio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
            </div>
            <div class="col-md-4">
              {{Form::date('fecha_inicio_tsp', \Carbon\Carbon::now(),['id'=>'fecha_inicio', 'class' => 'form-control select2', 'placeholder' => trans('copies.gestion_destinos.fecha_inicio'),  'required'=>'required' ]) }}
            </div>
            <div class="col-md-2">
                {{ Form::label('fechas', trans('copies.gestion_destinos.fecha_fin').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
            </div>
            <div class="col-md-4">
              {{Form::date('fecha_final_tsp', \Carbon\Carbon::now(),['id'=>'fecha_fin', 'class' => 'form-control select2', 'placeholder' => trans('copies.gestion_destinos.fecha_fin'),  'required'=>'required' ]) }}
            </div>

          </div>

          <div class='clearfix'></div>
          <div style="height: 10px;"></div>

          <div class="form-group">
            <div class="col-md-2">
                {{ Form::label('precio', trans('copies.generales.precio').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label'  ]) }}
            </div>
            <div class="col-md-10">
              {{Form::text('precio_usd_tsp', null,['id'=>'precio', 'class' => 'form-control select2', 'placeholder' => trans('copies.generales.precio'),  'required'=>'required' ]) }}
            </div>

          </div>



        @component('layouts.return_message')    
          @slot('id_mensaje') message_tar_servicio_propio @endslot
        @endcomponent


				<div class='clearfix'></div>
			</div>

			<div class="modal-footer">

				<div class="col-md-12" id="buttonmessagerespac">

					<center>

						<button type="button" data-dismiss="modal" class="btn btn-default btn-rounded btn-outline pull-center" data-style="zoom-in" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{trans('copies.generales.boton_cancelar')}}">{{trans('copies.generales.boton_cancelar')}}</button>
						&nbsp;&nbsp;
						<button id="createTarSrvProp" type="button" class="btn btn-success btn-rounded btn-outline pull-center" data-style="zoom-in" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{trans('copies.generales.boton_guardar')}}">{{trans('copies.generales.boton_guardar')}}</button>

					</center>
				</div>
			</div>
			{!!Form::close()!!}
		</div>

	</div>
</div>
