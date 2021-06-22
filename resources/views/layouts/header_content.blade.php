<div class="row border-bottom @yield('barra-menu')">    
    <div class="row">  
        <div class="col-sm-12 col-md-4">
            <p class="text-mod"> 
                <i class="pull-left margin-icon @yield('icono_menu_activo')"></i> &nbsp;&nbsp;&nbsp;&nbsp;@yield('nombre_menu_activo')
            </p>
        </div>
        <div class="col-sm-12 col-md-6 @yield('barra-menu')">
            @yield('hist_navegacion')
        </div>   
        
    </div>  
    <!--
    <div class="progress progress-mini">
        <div style="width: 100%;" class="progress-bar @yield('barra-menu')"></div>
    </div>  
    --> 
</div>