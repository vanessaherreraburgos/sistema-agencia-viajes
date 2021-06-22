<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('/themeAdminLte/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/themeAdminLte/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/themeAdminLte/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('/themeAdminLte/dist/css/skins/_all-skins.min.css') }}">

   <!-- Jquery Validate -->
  <script src="{{ asset('/themeAdminLte/js/plugins/validate/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('/themeAdminLte/js/plugins/validate/additional-methods.js') }}"></script>

  <!-- Jquery Validate spanish -->
  <script src="{{ asset('/themeAdminLte/js/plugins/validate/localization/messages_es.js') }}"></script>

  <link rel="stylesheet" href="{{ asset('/css/kuravaina.css') }}">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('/images/logo-peq.png') }}" /></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('/images/logo-min.png') }}" /></span>   
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">  
      @include('layouts.top')
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!--   MENU IZQUIERDO   -->
      @include('layouts.left')
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('headerContent')  
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Kuravaina Tours</a>.</strong> Todos los derechos reservados
  </footer>

 
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('/themeAdminLte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('/themeAdminLte/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('/themeAdminLte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/themeAdminLte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('/themeAdminLte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/themeAdminLte/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/themeAdminLte/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/themeAdminLte/dist/js/demo.js') }}"></script>
<!-- page script -->
@yield('codigo_scripts')
</body>
</html>
