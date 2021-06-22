<?php

namespace App\Http\Controllers\parametrizacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\parametrizacion\TipoCliente;
use Yajra\Datatables\Facades\Datatables;
use Auth;

class TipoClienteController extends Controller{  
 

  public function index(){    
  	return view('parametrizacion.tipo_cliente.list_tipo_cliente');  
  }

  public function dataTableTipoCliente(){

  	    $tipo_cliente = TipoCliente::get();

        return Datatables::of($tipo_cliente)
        
        ->addColumn('codigo',function($tipo_cliente){
            return $tipo_cliente->codigo;
        })
        ->addColumn('descripcion',function($tipo_cliente){
            return $tipo_cliente->descripcion;
        })
        ->addColumn('porcentaje_dscto',function($tipo_cliente){
            return $tipo_cliente->porcentaje_dscto;
        })       
        ->addColumn('action',function($tipo_cliente){
            return '<a href="'.url('hoteles/tarifas/'.$tipo_cliente->codigo)
                    .'" title="'.trans('copies.generales.boton_gest_tarifas').'" class="btn btn btn-default"><i class="fa fa-money"></i></a> 
                    <a title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default"><i class="fa fa-edit"></i></a> 
                    <a title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default"><i class="fa fa-trash-o"></i></a>';   
        })
        ->rawColumns(['action'])
        ->make(true);

  }

}
