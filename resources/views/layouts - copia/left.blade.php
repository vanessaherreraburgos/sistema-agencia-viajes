
 <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('/themeAdminLte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
          @if (!Auth::guest())
              {{ Auth::user()->name }}
          @endif</p>
          <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU DE NAVEGACION</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-th-large"></i> <span>Inicio</span>
          </a>
        </li>
        @if (Auth::user()->id_rol == 1)  <!--  ES ADMINISTRADOR  -->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Configuración</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="paises"><i class="fa fa-circle-o"></i> Paises</a></li>   
              <li><a href="#"><i class="fa fa-circle-o"></i> Estados</a></li>   
              <li><a href="#"><i class="fa fa-circle-o"></i> Ciudades</a></li>    
              <li><a href="#"><i class="fa fa-circle-o"></i> Destinos</a></li>    
            </ul>
          </li>
        @endif
        
        
    </ul>
