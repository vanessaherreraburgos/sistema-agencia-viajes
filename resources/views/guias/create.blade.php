@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_guia')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"          => trans('copies.breadcrumbs.home'),
            "guias/listar"  => trans('copies.breadcrumbs.list_guias'),
            "active"        => trans('copies.breadcrumbs.crear_guia')
        ])
    @endcomponent
@endsection


@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

                          {!! Form::open(['route'=>'guias_store', 'method' => 'POST', 'id' => 'create_guias', 'class' => 'wizard-big', 'enctype' => 'multipart/form-data']) !!}

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
  <script type="text/javascript">
    jsCrearGuia();
  </script>
@endsection
