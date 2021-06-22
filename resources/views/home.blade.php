@extends('layouts.template')

@section('title')
    Kuravaina Tours
@endsection

@section('headerContent')
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
@endsection


@section('content')       
<div class="wrapper wrapper-content animated fadeInRight">   
    <!-- <div class="col-xs-12 col-sm-4 col-md-4 p-b-sm-important">
        <div class="fondo-redondo-verde padding-home">
            <a href="#" class="fond_white">
                <div class="p-t-xs">                                
                    <div class="col-xs-3"><i class="fa fa-map-marker fa-3x"></i></div>
                    <div class="col-xs-9 font-18 sin_negrita">
                        Destinos
                    </div>    
                                        
                </div>                               
            </a>
        </div>
    </div>  -->

    <!--  Destinos -->
    <div class="col-md-4 p-t-lg">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-map-marker fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                	<span> Administre sus </span>
                	<a href="destinos/listar" class="fond_white">
                    <h2 class="font-bold"> {{trans('copies.menu.gestion.destinos')}} </h2> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>

    <!--  Hoteles -->
    <div class="col-md-4 p-t-lg">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-building-o fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                	<span> Administre sus </span>
                	<a href="hoteles/listar" class="fond_white">
                    <h2 class="font-bold"> {{trans('copies.menu.hoteles')}} </h2>   
                    </a>                
                </div>
            </div>
        </div>
    </div>

    <!--  Cliente -->
    <div class="col-md-4  p-t-lg">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user-circle-o fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">   
                	<span> Administre sus </span>    
                	<a href="clientes/listar" class="fond_white">             
                    <h2 class="font-bold">{{trans('copies.menu.clientes')}}</h2>
                	</a>
                </div>
            </div>
        </div>
    </div>

    <!--  Vehiculos -->
    <div class="col-md-6  p-t-lg">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-car fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span> Administre sus </span>  
                    <a href="tipos_vehiculos/listar" class="fond_white">   
                    <p class="font-bold" style="font-size: 26px" >{{ trans('copies.menu.gestion.tipos_vehiculos') }}</p>
                	</a>
                	<a href="vehiculos/listar" class="fond_white"> 
                    <p class="font-bold" style="font-size: 26px" >{{ trans('copies.menu.gestion.vehiculos') }}</p>
                	</a>
                </div>
            </div>
        </div>
    </div>

    <!--  Aviones -->
    <div class="col-md-6 p-t-lg">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-plane fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span> Administre sus </span>  
                    <a href="tipos_aviones/listar" class="fond_white"> 
                    <p class="font-bold" style="font-size: 26px" >{{ trans('copies.menu.gestion.tipos_aviones') }}</p>
                	</a>
                	<a href="aviones/listar" class="fond_white"> 
                    <p class="font-bold" style="font-size: 26px" >{{ trans('copies.menu.gestion.aviones') }}</p>
                	</a>
                </div>
            </div>
        </div>
    </div>

    <!--  Líneas Aereas -->
   <!--  <div class="col-md-4  p-t-lg">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-ticket fa-5x"></i>
                </div>
                <div class="col-xs-9 text-left">
                    <span> Administre sus </span>    
                    <a href="lineas_aereas/listar" class="fond_white">              
                    <h2 class="font-bold">{{trans('copies.menu.gestion.lineas_aereas')}}</h2>
                	</a>
                    <h3 class="font-bold">   </h3>
                </div>
            </div>
        </div>
    </div>
 -->
    <!--  Choferes -->
    <div class="col-md-4 p-t-lg">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-bus fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span> Administre sus</span>
                    <a href="choferes/listar" class="fond_white">  
                    <h2 class="font-bold">{{ trans('copies.menu.gestion.choferes') }}</h2>
                	</a>
                </div>
            </div>
        </div>
    </div>

    <!--  Guías -->
    <div class="col-md-4 p-t-lg">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-street-view fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span> Administre sus</span>
                    <a href="guias/listar" class="fond_white">  
                    <h2 class="font-bold">{{ trans('copies.menu.gestion.guias') }}</h2>
                	</a>
                </div>
            </div>
        </div>
    </div>

    <!--  Servicios Propios -->
    <div class="col-md-4 p-t-lg">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-cart-plus fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span> Administre sus</span>
                    <a href="serviciosPropios/listar" class="fond_white"> 
                    <p class="font-bold" style="font-size: 26px" >{{ trans('copies.menu.gestion.serv_propios') }}</p>
                	</a>
                </div>
            </div>
        </div>
    </div>
            
</div>
@endsection



