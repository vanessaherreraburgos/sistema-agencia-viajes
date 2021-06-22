@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_proveedores')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
	        "home" 					   => trans('copies.breadcrumbs.home'),
	        "proveedores/listar"  => trans('copies.breadcrumbs.list_proveedores'),
	        "active" 				   => trans('copies.breadcrumbs.crear_proveedores')
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-content">
            <form id="formProveedor" action="{{ route('proveedores/guardar') }}" class="wizard-big form-horizontal" method="post" >
              <!--<input name="codigo" type="hidden" value="{{$proveedor->codigo}}"/>-->
              <h1>{{trans('copies.gestion_proveedores.info_proveedor')}}</h1>
            <div class="form-group">
              {{ Form::label('razon_social', trans('copies.gestion_proveedores.razon_social'), ['class' => 'col-sm-2 control-label']) }}
              <div class="col-sm-6 col-lg-10">
                {{ Form::text('razon_social', null, ['class' => 'form-control required', 'placeholder' => '', 'maxlength' => '100' ]) }}
              </div>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="tab-1" data-toggle="tab" href="#contact1">{{trans('copies.gestion_proveedores.contacto1')}}</a>
                </li>              
                <li class="nav-item">
                  <a class="nav-link" id="tab-2" data-toggle="tab"  href="#contact2">{{trans('copies.gestion_proveedores.contacto2')}}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-3" data-toggle="tab"  href="#contact3" >{{trans('copies.gestion_proveedores.contacto3')}}</a>
                </li>
              </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane show active" id="contact1" role="tabpanel" aria-labelledby="contact1">
                  <br> 
                  <div class="form-group">
                      {{ Form::label('nombre_propietario1', trans('copies.gestion_proveedores.nombre'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-6 col-lg-10">
                        {{ Form::text('nombre_propietario1',  null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                      </div>
                  </div>
                  <div class="form-group">
                      {{ Form::label('telefono_propietario1', trans('copies.gestion_proveedores.telefono'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-3 col-lg-3">
                        {{ Form::text('telefono_propietario1',  null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '30' ]) }}
                      </div>                
                  </div>
                  <div class="form-group">
                      {{ Form::label('email_propietario1', trans('copies.gestion_proveedores.email'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-3 col-lg-3">
                        {{ Form::text('email_propietario1',  null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                      </div>                
                  </div>            
              </div>
              <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2">
                  <br>
                  <div class="form-group">
                      {{ Form::label('nombre_propietario2', trans('copies.gestion_proveedores.nombre'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-6 col-lg-10">
                        {{ Form::text('nombre_propietario12',  null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                      </div>
                  </div>
                  <div class="form-group">
                      {{ Form::label('telefono_propietario2', trans('copies.gestion_proveedores.telefono'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-3 col-lg-3">
                        {{ Form::text('telefono_propietario2',  null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '30' ]) }}
                      </div>                
                  </div>
                  <div class="form-group">
                      {{ Form::label('email_propietario2', trans('copies.gestion_proveedores.email'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-3 col-lg-3">
                        {{ Form::text('email_propietario2',  null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                      </div>                
                  </div>            
              </div>
              <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact3">
                  <br> 
                  <div class="form-group">
                      {{ Form::label('nombre_propietario3', trans('copies.gestion_proveedores.nombre'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-6 col-lg-10">
                        {{ Form::text('nombre_propietario3',  null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                      </div>
                  </div>
                  <div class="form-group">
                      {{ Form::label('telefono_propietario3', trans('copies.gestion_proveedores.telefono'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-3 col-lg-3">
                        {{ Form::text('telefono_propietario3', null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '30' ]) }}
                      </div>                
                  </div>
                  <div class="form-group">
                      {{ Form::label('email_propietario3', trans('copies.gestion_proveedores.email'), ['class' => 'col-sm-2 control-label']) }}
                      <div class="col-sm-3 col-lg-3">
                        {{ Form::text('email_propietario3', null, ['class' => 'form-control', 'placeholder' => '', 'maxlength' => '50' ]) }}
                      </div>                
                  </div>            
              </div>
            </div>              
          <!--</div>-->
           <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    {{ Form::button(trans('copies.generales.boton_cancelar'), ['id' => 'btnCancelar','class' => 'btn btn-white']) }}
                    {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnGuardar', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
                </div>
            </div>          
            </form>
          </div>
        </div> <!-- ibox-->
      </div>
		</div>
	</div>
@endsection
@section('codigo_scripts')
  <script src="{{ asset('/js/proveedores/crear_proveedores.js') }}"></script>
@endsection
