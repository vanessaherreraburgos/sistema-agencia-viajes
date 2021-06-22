
@extends('layouts.template')

@section('title')
   Tarifas del Hotel
@endsection

@section('hist_navegacion')
    @component('components.historial_navegacion')    
        @slot('breadcrumbs', [
	        "home" 			=> trans('copies.breadcrumbs.home'),
	        "active" 		=> 'Tarifas del Hotel Roraima Suit'
	    ])
    @endcomponent
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-md-2">   
			</div>
			<div class="col-md-8">          
           
	            <a class="link" href="#">
	                <div class="ibox shadow radius"> 
	                    <div class="ibox-content radius" > 
	                           <!--  <div class="pull-left fondo_secciones_tarifas_hoteles"></div> -->
	                            <div class="cont-texto-menu" align="center">
	                                <span class="texto-menu fuente_azul" style="font-size: 24px">Servicios Adicionales   </span>   
	                            </div>
	                                 
	                    </div> 
	                </div>
	            </a> 	            
	        </div>
	        <div class="col-md-2">   
			</div>	       
		</div>

		<div class="row">
			<div class="col-md-2">   
			</div>
			<div class="col-md-8">          
           
	            <a class="link" href="{{ route('hoteles/tarifasHabitaciones') }}">
	                <div class="ibox shadow radius"> 
	                    <div class="ibox-content radius"> 
	                           <!--  <div class="pull-left fondo_secciones_tarifas_hoteles"></div> -->
	                            <div class="cont-texto-menu" align="center">
	                                <span class="texto-menu fuente_azul" style="font-size: 24px">Habitaciones    </span>   
	                            </div>
	                                 
	                    </div> 
	                </div>
	            </a> 	            
	        </div>	  
	        <div class="col-md-2">   
			</div>     
		</div>

		<div class="row">
			<div class="col-md-2">   
			</div>
			<div class="col-md-8">          
           
	            <a class="link" href="#">
	                <div class="ibox shadow radius"> 
	                    <div class="ibox-content radius"> 
	                           <!--  <div class="pull-left fondo_secciones_tarifas_hoteles"></div> -->
	                            <div class="cont-texto-menu" align="center">
	                                <span class="texto-menu fuente_azul" style="font-size: 24px">Comidas    </span>   
	                            </div>
	                                 
	                    </div> 
	                </div>
	            </a> 	            
	        </div>	   
	        <div class="col-md-2">   
			</div>    
		</div>
	</div>
@endsection

@section('codigo_scripts')
	<script src="{{ asset('/js/hoteles/list_hoteles.js') }}"></script>
@endsection