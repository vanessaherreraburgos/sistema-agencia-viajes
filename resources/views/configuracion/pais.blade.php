@extends('layouts.default')

@section('title')
    Kuravaina Tours
@endsection

@section('headerContent')
      <h1>
        Paises
       <!-- <small>Nuevo País</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Configuración</a></li>
        <li class="active">Paises</li>
      </ol>
@endsection


@section('content')
  
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-xs-6 col-sm-6">
                <h3 class="box-title">Lista de Paises</h3>
              </div>
              <div class="col-xs-6 col-sm-6" style="text-align: right;">
                <button  type="button" onclick="nuevo_pais();" class="btn btn-primary btn-rounded btn-sm" ><i class="fa fa-save" ></i> Nuevo Pais</button>
              </div>  
            </div>            
            <div class="box-body">

              <table id="tabla_paises" style="width: 100%" class="table-bordered table-striped table-condensed">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Acción</th>             
                </tr>
                </thead>
                <tbody></tbody>                
              </table>
            </div>            
          </div>
        </div>       
      </div>
       
    <div class="modal inmodal midis-modal" id="modal_guardar_pais" tabindex="-1" role="dialog" aria-hidden="true">
        <div  class="modal-dialog ">  
            <div class="modal-content animated bounceInRight midis-modal-content">           
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"></span>
                    </button>                            
                </div>
                
                <div class="modal-body" >
                    <div class="panel panel-default">
                        <div class="panel-body">                               
                              <div class="col-xs-12 col-md-8 box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Paises</h3>
                                </div>
                                <div class="box-body">     
                                         
                                    <div class="col-xs-12 form-group">
                                          <label for="inputDescripcion" class="col-sm-3 control-label">Descripción *</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputDescripcion" id="inputDescripcion" placeholder="Ingrese el nombre del País ...">
                                          </div>
                                    </div>
                                    
                                    <div id="errores" class="col-xs-12 form-group capa_errores hidden"></div>

                                    
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                   <button type="button" class="btn btn-default">Cancelar</button>
                                   <button type="button" id="boton_modal" class="btn btn-info pull-right">Guardar</button>
                                </div>
                                <!-- /.box-footer-->
                              </div>
                        </div> 
                    </div>
                </div>                               
            </div>
        </div>
    </div>

  
@endsection

@section('codigo_scripts') 

<script>
  
    var ruta_language_datatable = "{{asset('/themeAdminLte/plugins/datatables/dataTable-kuravaina.json')}}";

    

    function nuevo_pais(){
      $("#modal_guardar_pais").modal();      
    }  

    $("#tabla_paises").DataTable({
      "language": {
            "url": ruta_language_datatable 
      },
      "processing":true,
      "serverSide": true,
      "ajax": "paises/list",
      "columns":[
        {data:'codigo', name:'codigo' },
        {data:'nombre', name:'nombre' },       
        {data:'action',name:'action',orderable: false, searchable: false},
      ]
    });

    function editar_pais() {

       $("#modal_guardar_pais").modal();
    }

    $("#boton_modal").click(function() {   

      $('#errores').removeClass("hidden");
      //$('#errores').empty().html("Prueba de errores");
       
       /*if ( $('#inputDescripcion').is(':empty') ) {           
        $('#errores').html("Debe Ingresar la descripción del País.");
       }
       */

    }); 

    
    /*$('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    */    
    

 
</script>

@endsection


