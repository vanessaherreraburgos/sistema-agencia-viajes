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

                    <form id="formHotel" action="{{route('hoteles/guardar')}}" class="wizard-big" method="post" enctype="multipart/form-data">

                        <h1>{{trans('copies.gestion_hoteles.informacion_basica')}}</h1>
                                          
                            <div class="scroll">
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
                                

                            </div>

                        

                        <h1>{{trans('copies.gestion_hoteles.caracteristicas')}}</h1>
                                              
                            <div class="scroll">
                                <!-- Fotos -->
                                <div class="form-group col-xs-12">                                 
                                    {{ Form::label('foto', trans('copies.gestion_hoteles.fotos'), ['class' => 'col-sm-3 control-label']) }}
                                    <div class="col-sm-9">
                                       
                                        {{ Form::file('fotos', ['id' => 'fotos', 'name' => 'fotos[]', 'class' => '', 'multiple'=>'false' ])}}
                                    </div>
                                </div>
                                <!-- Caracteristicas -->
                                <div class="form-group col-xs-12"> 
                                    {{ Form::label('caracteristicas', trans('copies.gestion_hoteles.caracteristicas').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                    <div class="col-xs-6 col-md-9" align="left">
                                         <textarea name="caracteristicas" id="caracteristicas" rows="2" class="form-control" cols="25" required></textarea>
                                    </div>   
                                       
                                </div>
                                <!-- tipo de alojamiento, categoria del hotel -->                           
                                <div class="form-group col-xs-12"> 
                                       
                                        {{ Form::label('cod_tipo_alojamiento', trans('copies.gestion_hoteles.tipo_alojamiento'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-3" align="left">
                                        
                                            {{ Form::select('cod_tipo_alojamiento', $tipo_alojamiento, null, ['id'=>'cod_tipo_alojamiento', 'class' => 'form-control select2 required', 'placeholder' => 'Seleccione el tipo de Alojamiento' ]) }}
                                        </div>
                                        
                                         
                                        {{ Form::label('categoria_hotel', trans('copies.gestion_hoteles.categoria_hotel'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-3" align="left">

                                            {{ Form::select('categoria_hotel', $categoria_hotel, null, ['id'=>'categoria_hotel', 'class' => 'form-control select2 required', 'placeholder' => 'Seleccione la categoria del hotel' ]) }}
                                        </div>  
                                </div>
                               
                                    
                            </div>

                                     

                        <h1>{{trans('copies.gestion_hoteles.contactos_cuentas')}}</h1>
                        
                            <div class="scroll">
                                <h3 class="fuente_azul">Contactos</h3>                       
                                <div class="form-group col-xs-12"> 
                                       
                                        {{ Form::label('nombres_contacto', trans('copies.gestion_hoteles.nombres').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-2 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-4" align="left">
                                        
                                            {{ Form::text('nombres_contacto', '', ['id'=>'nombres_contacto', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                        </div>
                                        
                                         
                                        {{ Form::label('apellido_contacto', trans('copies.gestion_hoteles.apellidos').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-2 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-4" align="left">

                                            {{ Form::text('apellido_contacto', '', ['id'=>'apellido_contacto', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                        </div>  
                                </div>
                                <div class="form-group col-xs-12"> 
                                       
                                        {{ Form::label('telefonos', trans('copies.gestion_hoteles.telefonos').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-2 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-4" align="left">
                                        
                                            {{ Form::text('telefonos_contacto', '', ['id'=>'telefonos_contacto', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                        </div>
                                        
                                         
                                        {{ Form::label('correo_contacto', trans('copies.gestion_hoteles.correo'), ['class' => 'col-xs-6 col-md-2 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-4" align="left">

                                            {{ Form::text('correo_contacto', '', ['id'=>'correo_contacto', 'class' => 'form-control ', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                        </div>  
                                </div>
                                <div class="form-group col-xs-12">
                                        {{ Form::label('cargo', trans('copies.gestion_hoteles.cargo'), ['class' => 'col-xs-6 col-md-2 control-label text-orientacion']) }}  
                                        <div class="col-xs-6 col-md-10" align="left">                                    
                                            {{ Form::text('cargo', '', ['id'=>'cargo', 'class' => 'form-control', 'placeholder' => 'Escriba la dirección Fiscal' ]) }}
                                        </div>
                                </div>

                                <h3 class="fuente_azul">Cuentas Bancarias</h3>                       
                                <div class="form-group col-xs-12"> 
                                       
                                        {{ Form::label('nombres_contacto', 'Banco'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-3" align="left">
                                        
                                             <select data-placeholder="Seleccionar..." class="select2"  name="banco" id="banco" style="width: 50%">
                                            <option value=""> </option>
                                           
                                                <option value="1">Banesco</option>
                                                <option value="2">mercantil</option>
                                                <option value="3">Provincial</option>
                                           
                                            </select>
                                        </div>
                                        
                                         
                                        {{ Form::label('apellido_contacto', 'Tipo de Cuenta'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-3" align="left">

                                           <select data-placeholder="Seleccionar..." class="select2"  name="tipo_cuenta" id="tipo_cuenta" style="width: 50%">
                                            <option value=""> </option>
                                           
                                                <option value="1">Corriente</option>
                                                <option value="2">Ahorro</option>
                                                
                                           
                                            </select>
                                        </div>  
                                </div>
                                <div class="form-group col-xs-12">
                                        {{ Form::label('cargo', 'Titular de la Cuenta', ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}  
                                        <div class="col-xs-6 col-md-9" align="left">                                    
                                            {{ Form::text('cargo', '', ['id'=>'cargo', 'class' => 'form-control', 'placeholder' => 'Escriba el nombre del titular de la cuenta' ]) }}
                                        </div>
                                </div>
                                <div class="form-group col-xs-12">
                                        {{ Form::label('cargo', 'Número de la Cuenta', ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}  
                                        <div class="col-xs-6 col-md-9" align="left">                                    
                                            {{ Form::text('cargo', '', ['id'=>'cargo', 'class' => 'form-control', 'placeholder' => 'Escriba el número de la cuenta' ]) }}
                                        </div>
                                </div>
                                <div class="form-group col-xs-12"> 
                                           
                                        {{ Form::label('informacion_fiscal', trans('copies.gestion_hoteles.informacion_fiscal').trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-3" align="left">
                                        
                                            {{ Form::text('informacion_fiscal', '', ['id'=>'informacion_fiscal', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                        </div>
                                        
                                         
                                        {{ Form::label('nombre_comercial', 'Correo'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-3" align="left">

                                            {{ Form::text('nombre_comercial', '', ['id'=>'nombre_comercial', 'class' => 'form-control required', 'placeholder' => 'Ingrese el correo' ]) }}
                                        </div>  
                                </div>
                            </div>

                        

                        <h1>{{trans('copies.gestion_hoteles.servicios')}}</h1>
                                         
                            <div class="scroll">
                                <h3 class="fuente_azul">Incluidos</h3>  

                                <div class="form-group col-xs-12">
                                        {{ Form::label('cargo', 'Descripción', ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}  
                                        <div class="col-xs-6 col-md-7" align="left">                                    
                                            {{ Form::text('cargo', '', ['id'=>'cargo', 'class' => 'form-control', 'placeholder' => 'Escriba la descripción del servicio' ]) }}
                                        </div>
                                        <div class="col-xs-6 col-md-2" align="left"> 
                                            <a class="btn btn-white ">
                                                <i class="fa fa-plus"></i> Agregar
                                            </a>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <table  class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>                                                
                                                    <th class="fuente_azul">Descripción</th>   
                                                    <th class="fuente_azul">Acción</th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>                                                
                                                    <td >Desayuno</td>   
                                                    <td ><i class="fa fa-trash-o"></i></td>   
                                                </tr>
                                                <tr>                                                
                                                    <td >Gimnacio</td>   
                                                    <td ><i class="fa fa-trash-o"></i></td>   
                                                </tr>
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>

                                <h3 class="fuente_azul">Adicionales</h3>  
                                <div class="form-group col-xs-12">
                                        {{ Form::label('cargo', 'Descripción', ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}  
                                        <div class="col-xs-6 col-md-7" align="left">                                    
                                            {{ Form::text('cargo', '', ['id'=>'cargo', 'class' => 'form-control', 'placeholder' => 'Escriba la descripción del servicio' ]) }}
                                        </div>
                                        <div class="col-xs-6 col-md-2" align="left"> 
                                            <a class="btn btn-white ">
                                                <i class="fa fa-plus"></i> Agregar
                                            </a>
                                        </div>
                                </div>
                                <div class="form-group col-xs-12"> 
                                           
                                        {{ Form::label('informacion_fiscal', 'Mínimo Personas' .trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-3" align="left">
                                        
                                            {{ Form::text('informacion_fiscal', '', ['id'=>'informacion_fiscal', 'class' => 'form-control' ]) }}
                                        </div>
                                        
                                         
                                        {{ Form::label('nombre_comercial', 'Máximo Personas'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-3" align="left">

                                            {{ Form::text('nombre_comercial', '', ['id'=>'nombre_comercial', 'class' => 'form-control ']) }}
                                        </div>  
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <table  class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>                                                
                                                    <th class="fuente_azul">Descripción </th>   
                                                    <th class="fuente_azul">Min Personas </th>  
                                                    <th class="fuente_azul">Max Personas </th>  
                                                    <th class="fuente_azul">Acción </th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>                                                
                                                    <td >Paseo a los delfines</td>   
                                                    <td > 2</td> 
                                                    <td > 4</td> 
                                                    <td ><i class="fa fa-trash-o"></i></td>   
                                                </tr>
                                                <tr>                                                
                                                    <td >Almuerzo</td>   
                                                    <td > 1</td> 
                                                    <td > 7</td>
                                                    <td ><i class="fa fa-trash-o"></i></td>   
                                                </tr>
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>

                            </div>
                        

                        <h1>{{trans('copies.gestion_hoteles.habitaciones')}}</h1>
                          
                            <div class="scroll">                    
                           
                                <div class="form-group col-xs-12"> 
                                           
                                        {{ Form::label('nombres_contacto', 'Tipo de Habitación'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-3" align="left">
                                        
                                            <select data-placeholder="Seleccionar..." class="select2"  name="clase_hab" id="clase_hab" style="width: 50%">
                                            <option value=""> </option>
                                           
                                                <option value="1">Standar</option>
                                           
                                            </select>
                                        </div>
                                        
                                         
                                        {{ Form::label('apellido_contacto', 'Clase de habitación'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-3" align="left">

                                            <select data-placeholder="Seleccionar..." class="select2"  name="tipo_hab" id="tipo_hab" style="width: 50%">
                                            <option value=""> </option>
                                           
                                                <option value="1">Simple</option>
                                                <option value="2">Doble</option>
                                                <option value="3">Triple</option>
                                           
                                            </select>
                                        </div>  
                                </div>
                                <div class="form-group col-xs-12"> 
                                           
                                        {{ Form::label('informacion_fiscal', 'Número de Adultos' .trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-3" align="left">
                                        
                                            {{ Form::text('informacion_fiscal', '', ['id'=>'informacion_fiscal', 'class' => 'form-control' ]) }}
                                        </div>
                                        
                                         
                                        {{ Form::label('nombre_comercial', 'Número de Niños'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-3" align="left">

                                            {{ Form::text('nombre_comercial', '', ['id'=>'nombre_comercial', 'class' => 'form-control ']) }}
                                        </div>  
                                </div>
                                <div class="form-group col-xs-12"> 
                                           
                                        {{ Form::label('informacion_fiscal', 'Tiene Balcón?' .trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}                                   

                                        <div class="col-xs-6 col-md-3" align="left">
                                        
                                           <div class="radio radio-info col-xs-12">
                                                <input type="radio" value="Presuntivo" name="tipo_d" id="diag_p" required="">
                                                <label for="diag_p" style="padding-right: 30px"> Si</label>
                                                <input type="radio" value="Definitivo" name="tipo_d" id="diag_d" required="">
                                                <label for="diag_d"> No </label>
                                            </div>  
                                        </div>
                                        
                                         
                                        {{ Form::label('nombre_comercial', 'Incremento Procentaje'.trans('copies.generales.obligatorio'), ['class' => 'col-xs-6 col-md-3 control-label text-orientacion']) }}
                                        
                                        <div class="col-xs-6 col-md-3" align="left">

                                            {{ Form::text('nombre_comercial', '', ['id'=>'nombre_comercial', 'class' => 'form-control ']) }}
                                        </div>  
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <table  class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>                                                
                                                    <th class="fuente_azul">Clase de Hab. </th>   
                                                    <th class="fuente_azul">Nro. Adultos </th>  
                                                    <th class="fuente_azul">Nro Niños </th>  
                                                    <th class="fuente_azul">Tiene Balcón ? </th>  
                                                    <th class="fuente_azul">Acción </th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>                                                
                                                    <td >Simple</td>   
                                                    <td > 2</td> 
                                                    <td > 0</td> 
                                                    <td > No</td> 
                                                    <td ><i class="fa fa-trash-o"></i></td>   
                                                </tr>
                                                <tr>                                                
                                                    <td >Doble</td>   
                                                    <td > 2</td> 
                                                    <td > 1</td> 
                                                    <td > No</td> 
                                                    <td ><i class="fa fa-trash-o"></i></td>   
                                                </tr>
                                                <tr>                                                
                                                    <td >Triple</td>   
                                                    <td > 3</td> 
                                                    <td > 1</td> 
                                                    <td > Si</td> 
                                                    <td ><i class="fa fa-trash-o"></i></td>   
                                                </tr>
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>

                            </div>
                                  
                        
                    </form>
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