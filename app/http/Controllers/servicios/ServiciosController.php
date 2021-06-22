<?php

namespace App\Http\Controllers\servicios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\servicios\servicios;
use DB;
class ServiciosController extends Controller
{
    public function index(){
      
    }

    public function create(){
		    
    }

    public function store(Request $request){
      
    }

    public function edit($id){
      
    }

    public function update(Request $request, $id){
      
    }
    
   // list servicios documentar -- 11/06/2018 -- adrián
    public function getListServiciosDestino($destino, $tipo){
        if ($destino && $tipo) {
            return servicios::where('cod_destino', $destino)->where('tipo_servidor', $tipo)->orderBy('descripcion')->get();
        }
    }




}
