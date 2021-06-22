

@extends('layouts.template')

@section('title')
    {{trans('copies.breadcrumbs.crear_chofer')}}
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')
        @slot('breadcrumbs', [
            "home"                  => trans('copies.breadcrumbs.home'),
            "choferes/listar"       => trans('copies.breadcrumbs.list_choferes'),
            "active"                => trans('copies.breadcrumbs.crear_chofer')
        ])
    @endcomponent
@endsection


@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

                            {!! Form::open(['route'=>'choferes_store', 'method' => 'POST', 'id' => 'create_choferes', 'class' => 'wizard-big', 'enctype' => 'multipart/form-data']) !!}

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
  <script type="text/javascript">
    jsCrearChofer();
  </script>
@endsection
