@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.editar_chofer')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"                  => trans('copies.breadcrumbs.home'),
            "choferes/listar"       => trans('copies.breadcrumbs.list_choferes'),
            "active"                => trans('copies.breadcrumbs.editar_chofer')
        ])
    @endcomponent
@endsection


@section('content')



        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

                          {!! Form::open(['route'=>'choferes_update', 'method' => 'POST', 'id' => 'update_choferes', 'class' => 'wizard-big', 'enctype' => 'multipart/form-data']) !!}

                             @include('choferes.formularios.datos_choferes')

                          {!! Form::close() !!}

                        </div>
                        @component('layouts.return_message')    
                          @slot('id_mensaje') message_chofer @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>


    <!-- Mainly scripts -->
    <script src="{{asset('/theme_inspinia/js/jquery-3.1.1.min.js')}}"></script>



@endsection

@section('codigo_scripts')
  <script src="{{asset('/js/choferes/choferes.js')}}"></script>
  @if($id != null)
  <script type="text/javascript">
  var paisres = '<?php echo $choferes->cod_pais_res; ?>';
  var estadores = '<?php echo $choferes->cod_estado_res; ?>';
  var ciudadres = '<?php echo $choferes->cod_ciudad_res; ?>';
  var tipo_documento = '<?php echo $choferes->cod_tipo_documento; ?>';
  var nacionalidad = '<?php echo $choferes->cod_pais_nacionalidad; ?>';
  var licencia = '<?php echo $choferes->cod_grado_licencia; ?>';
  var chofer_id = '<?php echo $id ?>';
  jsEditarChofer(paisres, estadores, ciudadres, nacionalidad, tipo_documento, licencia, chofer_id);

</script>
@endif
@endsection
