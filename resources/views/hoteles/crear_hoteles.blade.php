 @extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_hotel')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
            "home"                  => trans('copies.breadcrumbs.home'),
            "hoteles/listar"        => trans('copies.breadcrumbs.list_hotel'),
            "active"                => trans('copies.breadcrumbs.crear_hotel')
        ])
    @endcomponent
@endsection

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">                       
                <div class="ibox-content">
                    <ul class="nav nav-tabs" id="myTab">
                      <li class="active"><a data-target="#inf_basica" data-toggle="tab">Información Básica</a></li>
                      <li><a data-target="#caracteristicas" data-toggle="tab">Caracteristicas</a></li>
                      <li><a data-target="#contactos_cuentas" data-toggle="tab">Contactos y Cuentas</a></li>
                      <li><a data-target="#servicios" data-toggle="tab">Servicios</a></li>
                      <li><a data-target="#habitaciones" data-toggle="tab">Habitaciones</a></li>                     
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="inf_basica">
                            <form id="formHotelInfBasica" action="{{route('hoteles/guardar')}}" method="post" enctype="multipart/form-data">                                                   
                                    <div class="scroll">
                                        <div style="height: 20px"></div>
                                        <!-- Informacion Fiscal y nombre comercial -->
                                        <div class="form-group col-xs-12"> 
                                               
                                                {{ Form::label('identificacion_fiscal', trans('copies.gestion_hoteles.informacion_fiscal').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                                <div class="col-xs-6 col-md-3" align="left">
                                                
                                                    {{ Form::text('identificacion_fiscal', '', ['id'=>'identificacion_fiscal', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>
                                                
                                                 
                                                {{ Form::label('nombre_comercial', trans('copies.gestion_hoteles.nombre_comercial').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                                
                                                <div class="col-xs-6 col-md-3" align="left">

                                                    {{ Form::text('nombre_comercial', '', ['id'=>'nombre_comercial', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>  
                                        </div>
                                        <!-- Razón social -->
                                        <div class="form-group col-xs-12"> 
                                               
                                                {{ Form::label('razon_social', trans('copies.gestion_hoteles.razon_social').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                                <div class="col-xs-6 col-md-9" align="left">
                                                
                                                    {{ Form::text('razon_social', '', ['id'=>'razon_social', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>   
                                               
                                        </div>
                                        <!-- Ubicación: Pais, Estado y Ciudad -->
                                        <div class="form-group col-xs-12"> 
                                               
                                                {{ Form::label('ubicacion', trans('copies.gestion_hoteles.ubicacion').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                                <div class="col-xs-6 col-md-3" align="left">
                                                    {{ Form::select('cod_pais', [], null, ['id'=>'cod_pais', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_pais') ]) }}
                                                </div>
                                                
                                                <div class="col-xs-6 col-md-3" align="left">
                                                    {{ Form::select('cod_estado', [], null, ['id'=>'cod_estado', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_estado') ]) }}
                                                </div>

                                                <div class="col-xs-6 col-md-3" align="left">
                                                    {{ Form::select('cod_ciudad', [], null, ['id'=>'cod_ciudad', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_ciudad') ]) }}
                                                </div>
                                        </div>
                                         <!-- Destino -->
                                        <div class="form-group col-xs-12">
                                                {{ Form::label('destino', trans('copies.gestion_hoteles.destino').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}  
                                                <div class="col-xs-6 col-md-9" align="left">                                    
                                                    {{ Form::select('cod_destino_vende', [], null, ['id'=>'cod_destino_vende', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_destino') ]) }}
                                                </div>
                                        </div>
                                        <!-- Dirección -->
                                        <div class="form-group col-xs-12">
                                                {{ Form::label('direccion', trans('copies.gestion_hoteles.direccion').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}  
                                                <div class="col-xs-6 col-md-9" align="left">                                    
                                                    {{ Form::text('direccion_fiscal', '', ['id'=>'direccion_fiscal', 'class' => 'form-control required', 'placeholder' => 'Escriba la dirección Fiscal' ]) }}
                                                </div>
                                        </div>                            
                                        <!-- Teléfonos -->
                                        <div class="form-group col-xs-12"> 
                                                {{ Form::label('telefonos', trans('copies.gestion_hoteles.telefonos').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                                <div class="col-xs-6 col-md-3" align="left">
                                                    {{ Form::text('telefono1', '', ['id'=>'telefono1', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>
                                                
                                                <div class="col-xs-6 col-md-3" align="left">
                                                    {{ Form::text('telefono2', '', ['id'=>'telefono2', 'class' => 'form-control' ]) }}
                                                </div>

                                                <div class="col-xs-6 col-md-3" align="left">
                                                   {{ Form::text('telefono3', '', ['id'=>'telefono3', 'class' => 'form-control' ]) }}
                                                </div>
                                        </div>
                                        <!-- Correos -->
                                        <div class="form-group col-xs-12">
                                                {{ Form::label('correos', trans('copies.gestion_hoteles.correos').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                                <div class="col-xs-6 col-md-3" align="left">
                                                    {{ Form::email('correo1', '', ['id'=>'correo1', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}

                                                </div>
                                                
                                                <div class="col-xs-6 col-md-3" align="left">
                                                    {{ Form::email('correo2', '', ['id'=>'correo2', 'class' => 'form-control' ]) }}
                                                </div>

                                                <div class="col-xs-6 col-md-3" align="left">
                                                   {{ Form::email('correo3', '', ['id'=>'correo3', 'class' => 'form-control' ]) }}
                                                </div>
                                        </div>
                                        <!-- página web, cuenta instagran -->                           
                                        <div class="form-group col-xs-12"> 
                                               
                                                {{ Form::label('pagina_web', trans('copies.gestion_hoteles.pagina_web'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                                <div class="col-xs-6 col-md-3" align="left">
                                                
                                                    {{ Form::text('pagina_web', '', ['id'=>'pagina_web', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>
                                                
                                                 
                                                {{ Form::label('cuenta_instagram', trans('copies.gestion_hoteles.cuenta_instagram'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                                
                                                <div class="col-xs-6 col-md-3" align="left">

                                                    {{ Form::text('cuenta_instagram', '', ['id'=>'cuenta_instagram', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>  
                                        </div>
                                        <!-- cuenta facebook, cuenta twiter -->                           
                                        <div class="form-group col-xs-12"> 
                                               
                                                {{ Form::label('cuenta_facebook', trans('copies.gestion_hoteles.cuenta_facebook'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                                <div class="col-xs-6 col-md-3" align="left">
                                                
                                                    {{ Form::text('cuenta_facebook', '', ['id'=>'cuenta_facebook', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>
                                                
                                                 
                                                {{ Form::label('cuenta_twiter', trans('copies.gestion_hoteles.cuenta_twiter'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                                
                                                <div class="col-xs-6 col-md-3" align="left">

                                                    {{ Form::text('cuenta_twiter', '', ['id'=>'cuenta_twiter', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                                </div>  
                                        </div> 
                                        <div class="hr-line-dashed col-xs-12"></div>
                                        <div class="form-group col-xs-12 text-center">
                                            <!-- <div class="col-md-4 col-md-offset-2"> -->
                                                {{ Form::button(trans('copies.generales.boton_cancelar'), ['class' => 'btn btn-white']) }}
                                                {{ Form::button(trans('copies.generales.boton_guardar'), ['id' => 'btnCrearInfBasicaHotel', 'class' => 'btn btn-success', 'data-style' => 'zoom-in']) }}
                                            <!-- </div> -->
                                        </div>                                      

                                    </div>                                                  
                            </form>
                        </div>

                        <div class="tab-pane" id="caracteristicas">

                        </div>
                        <div class="tab-pane" id="contactos_cuentas">

                        </div>
                        <div class="tab-pane" id="servicios">

                        </div>
                        <div class="tab-pane" id="habitaciones">

                        </div>
                        
                    </div>
                </div>

                @component('layouts.return_message')    
                  @slot('id_mensaje') message_hoteles @endslot
                @endcomponent
            </div>
        </div>
    </div>
</div>
@endsection

@section('codigo_scripts')
    
    <script src="{{ asset('/js/hoteles/crear_hoteles.js') }}"></script>

@endsection