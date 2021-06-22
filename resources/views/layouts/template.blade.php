<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <LINK REL="Shortcut Icon" HREF="favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/logo-kuravaina.ico')}}"/>
    <title>@yield('title') </title>

    @yield('head')

    <!-- Summernote -->
    <link href="{{ asset('/theme_inspinia/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('/theme_inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/plugins/codemirror/codemirror.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/plugins/codemirror/ambiance.css') }}" rel="stylesheet">

    <link href="{{ asset('/theme_inspinia/css/style.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('/theme_inspinia/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('/theme_inspinia/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <!-- Select2 -->
    <link href="{{ asset('/theme_inspinia/css/plugins/select2/select2.min.css') }}" rel="stylesheet">

    <!-- iCheck -->
    <link href="{{ asset('/theme_inspinia/css/plugins/iCheck/custom.css') }}" rel="stylesheet">

    <!-- Chosen -->
    <link href="{{ asset('/theme_inspinia/css/plugins/chosen/bootstrap-chosen.css') }}"  rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/plugins/imageselect/imageselect.css') }}" rel="stylesheet">

    <!-- Datapicker -->
    <link href="{{ asset('/theme_inspinia/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <!-- Steps -->
    <link href="{{ asset('/theme_inspinia/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">

    <!-- Dropzone -->
    <link href="{{ asset('/theme_inspinia/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Sweet Alert 1 -->
    <link href="{{ asset('/theme_inspinia/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- Fileinput -->
    <link href="{{ asset('/theme_inspinia/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme_inspinia/css/plugins/fileinput/css/fileinput.css') }}" rel="stylesheet" />

    <!-- Ladda style -->
    <link href="{{ asset('/theme_inspinia/css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/theme_inspinia/ladda/css/prism.css') }}">

    <!--  touchspin  -->
    <link href="{{ asset('/theme_inspinia/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">

    <!--  CSS de fuentes personalizadas Midis  -->
    <link href="{{ asset('/theme_inspinia/icon/style.css') }}"  rel="stylesheet">
    <!--  CSS personalizado Kuravaina  -->
    <link href="{{ asset('/css/kuravaina.css') }}"  rel="stylesheet">

    <!--  Datatables  -->
    <link href="{{asset('/theme_inspinia/css/plugins/dataTables/datatables.min.css')}}"   rel="stylesheet">
    <link href="{{asset('/theme_inspinia/css/plugins/dataTables/buttons.dataTables.min.css')}}"   rel="stylesheet">

    <!--  themeAdminLte  -->
    <!-- <link href="{{ asset('/themeAdminLte/dist/css/AdminLTE.css') }}" rel="stylesheet"> -->

</head>
<body class="kuravaina-skin fixed-nav no-skin-config">

  <!-- Wrapper-->
    <div id="wrapper">

        @include('layouts.menu_left')
        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.menu_top')
            {{--@include('layouts.header_content') --}}

            <!-- Main view  -->
            @yield('hist_navegacion')
            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->
    </div>
    <!-- End wrapper-->


    @include('layouts.copies')

    <!-- Mainly scripts -->
    <script src="{{ asset('/theme_inspinia/js/jquery-3.1.1.min.js') }}"></script>

    <script src="{{ asset('/theme_inspinia/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('/theme_inspinia/js/inspinia.js') }}"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/pace/pace.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('/theme_inspinia/js/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/select2/lenguaje/es.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('/theme_inspinia/js/plugins/iCheck/icheck.min.js') }}"></script>

    <script src="{{ asset('/theme_inspinia/js/plugins/chosen/chosen.jquery.js') }}" ></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/imageselect/imageselect.jquery.js') }}" ></script>

    <!-- Datepicker -->
    <script src="{{ asset('/theme_inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}" ></script>

    <script src="{{ asset('/theme_inspinia/js/plugins/datapicker/locales/bootstrap-datepicker.es.js') }}" ></script>    
    
    <script src="{{ asset('/theme_inspinia/js/plugins/steps/jquery.steps.min.js') }}"></script>

    <!-- Jquery Validate -->
    <script src="{{ asset('/theme_inspinia/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/validate/additional-methods.js') }}"></script>
    <!-- Jquery Validate personalizado -->
    <script src="{{ asset('/js/validacion/metodos_personalizados.js') }}"></script>

     <!-- Jquery Validate spanish -->
    <script src="{{ asset('/theme_inspinia/js/plugins/validate/localization/messages_es.js') }}"></script>

    <!-- SUMMERNOTE -->
    <script src="{{ asset('/theme_inspinia/js/plugins/summernote/summernote.min.js') }}"></script>

    <!-- Jasny -->
    <script src="{{ asset('/theme_inspinia/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

    <!-- DROPZONE -->
    <script src="{{ asset('/theme_inspinia/js/plugins/dropzone/dropzone.js') }}"></script>

    <!-- Sweet alert -->
    <script src="{{ asset('/theme_inspinia/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!--Toastr-->
    <script src="{{ asset('/theme_inspinia/js/plugins/toastr/toastr.min.js') }}"></script>

      <!-- Ladda -->
    <script src="{{ asset('/theme_inspinia/js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/ladda/ladda.jquery.min.js') }}"></script>


     <!-- Tinycon -->
    <script src="{{ asset('/theme_inspinia/js/plugins/tinycon/tinycon.min.js') }}"></script>

    <!-- DataTables  -->
    <script src="{{asset('/theme_inspinia/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('/theme_inspinia/js/plugins/dataTables/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('/theme_inspinia/js/plugins/dataTables/dataTables.buttons.min.js')}}"></script>

    <!-- Animate  -->
    <script src="{{asset('/theme_inspinia/js/animate.css.js')}}"></script>
    <script src="{{asset('/theme_inspinia/js/jquery.animate.css.js')}}"></script>


    <!--JQUERY MOBIL-->
    <!--<script src="{{ asset('/js/jquery.mobile-1.4.5.js') }}"></script> -->

    <!--funciones.js-->
    <script src="{{ asset('/js/funciones.js') }}"></script>
    <!-- fileinput para cargar documentos e imagenes -->
    <!-- LOS PLUGINS DE FILEINPUT DEBEN ESTAR SIEMPRE AL FINAL, POR FAVOR NO MOVER DE ESTA UBICACION-->
    <script src="{{ asset('/theme_inspinia/js/plugins/fileinput/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/fileinput/js/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/theme_inspinia/js/plugins/fileinput/themes/explorer/theme.js') }}" type="text/javascript"></script>

    <!-- Laroute -->
    <script src="{{ asset('/js/laroute.js') }}"></script>  

    @yield('codigo_scripts')


    <script>

        $(document).ready(function () {

            // ====================================
            $('.dropdown-menu').click(function(event){
                event.stopPropagation();
            });

            // ====================================
             $('.scroll').slimScroll({
                size: '10px',
                height: '700px',
                alwaysVisible: true,
                touchScrollStep: 20
             });

            $('.scroll-consultas').slimScroll({
                size: '10px',
                height: '420px',
                alwaysVisible: true,
                touchScrollStep: 20
            });

            $('.scroll-prev-consultas').slimScroll({
                size: '10px',
                height: '500px',
                alwaysVisible: true,
                touchScrollStep: 20
            });

            $('.chosen-select').chosen({
                width: "100%",
                no_results_text: "Sin Resultados!",
                allow_single_deselect: true
                //height: 50px
            });

            // ====================================
            $('.summernote').summernote({
              toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                //['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'paragraph']],
                ['height', ['height']]
              ],
                  //placeholder: 'Escribir aqui el informe de la Consulta...',
                  fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                  height: 55,                  // set editor height
                  minHeight: null,             // set minimum height of editor
                  maxHeight: null,             // set maximum height of editor
                  focus: true
            });
        });
    </script>


</body>
</html>
