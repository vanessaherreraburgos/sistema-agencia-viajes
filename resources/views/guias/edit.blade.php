@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.editar_guia')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"          => trans('copies.breadcrumbs.home'),
            "guias/listar"  => trans('copies.breadcrumbs.list_guias'),
            "active"        => trans('copies.breadcrumbs.editar_guia')
        ])
    @endcomponent
@endsection


@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

                          {!! Form::open(['route'=>'guias_update', 'method' => 'POST', 'id' => 'update_guias', 'class' => 'wizard-big', 'enctype' => 'multipart/form-data']) !!}

                             @include('guias.formularios.datos_guias')

                          {!! Form::close() !!}

                        </div>
                        @component('layouts.return_message')    
                          @slot('id_mensaje') message_guia @endslot
                        @endcomponent
                    </div>
                </div>

            </div>
        </div>


        <!-- Mainly scripts -->
        <script src="{{asset('/theme_inspinia/js/jquery-3.1.1.min.js')}}"></script>

    @endsection

    @section('codigo_scripts')
      <script src="{{asset('/js/guias/guias.js')}}"></script>
      @if($id != null)
      <script type="text/javascript">
      var paisres = '<?php echo $guias->cod_pais_res; ?>';
      var estadores = '<?php echo $guias->cod_estado_res; ?>';
      var ciudadres = '<?php echo $guias->cod_ciudad_res; ?>';
      var tipo_documento = '<?php echo $guias->cod_tipo_documento; ?>';
      var nacionalidad = '<?php echo $guias->cod_pais_nacionalidad; ?>';
      var guia_id = '<?php echo $id ?>';
      jsEditarGuia(paisres, estadores, ciudadres, nacionalidad, tipo_documento ,guia_id);

    </script>
    @endif
    @endsection
