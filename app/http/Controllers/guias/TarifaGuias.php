<?php

namespace App\Http\Controllers\guias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tarifasGuias\tarifasGuias;
use App\Models\guias\guias;
use Yajra\Datatables\Facades\Datatables;
use App\Models\destino\Destino;
use Illuminate\Support\Facades\Validator;
use DB;

class TarifaGuias extends Controller
{

  //15-04-2018
  public function tarifas(Request $request){
      $guias = guias::find($request->id);
    return view('guias/tarifas', compact('guias'));
  }

  //15-4-2018 documentar
  public function dataTableTarifasGuias($id){
    $tarifasGuias = tarifasGuias::where('cod_guia', $id)->get();

    // return  $vehiculo;

    return Datatables::of($tarifasGuias)
    ->addColumn('destino',function($tarifasGuias){
        $ciudad = $tarifasGuias->getDestino->getCiudad;
        $estado = $ciudad->getEstado;
        $pais   = $estado ->getPais;
        return $tarifasGuias->getDestino->descripcion.'<br>'.$ciudad->nombre.' - '.$estado->nombre.' - '.$pais->nombre;
    })
    ->addColumn('servicios',function($tarifasGuias){
        return $tarifasGuias->getServicios->descripcion;
    })
    ->addColumn('fechas',function($tarifasGuias){
        return 'Desde: '.$tarifasGuias->fecha_inicial_tar_gui.' <br> '.'Hasta: '.$tarifasGuias->fecha_final_tar_gui;
    })
    ->addColumn('precio',function($tarifasGuias){
        return $tarifasGuias->precio_usd_guia;
    })
    ->addColumn('action',function($tarifasGuias){
        return "
        <button type='button' id='editar_tarifa' class='editar btn btn-default' data-toggle='modal' data-target='#modalTarifasGuiaEditar' value='".$tarifasGuias->codigo."'><i class='fa fa-pencil-square-o'></i></button>
        </button>	<button type='button' id='btn-delete' class='eliminar btn btn-default' value='".$tarifasGuias->codigo."'><i class='fa fa-trash-o'></i></button>";
    })
    ->rawColumns(['destino', 'fechas', 'action'])
    ->make(true);
  }



  function almacenar(Request $request){

    $validator = Validator::make($request->all(), 
        [
          'cod_pais_res'     => 'integer|required',
          'cod_estado_res'   => 'integer|required',
          'cod_ciudad_res'   => 'integer|required',
          'destino'          => 'integer|required',
          'servicio'         => 'integer|required',
          'fecha_inicio'     => 'required',
          'fecha_fin'        => 'required',          
          'precio_usd'       => 'required|numero_o_decimal',
        ]
      );


      if ($validator->fails())
      {
          // The given data did not pass validation
        return response()->json(array('errors' => $validator->messages()),200);
      }
      else{

            DB::beginTransaction();
            try {
                //se invoca la función que valida las fechas
                $valido = validarFechasTarifasGuias($request);
                if ($valido) {
                  $tarifasGuias = new tarifasGuias;
                  $tarifasGuias->cod_guia = $request->idTarifaGui;
                  $tarifasGuias->cod_pais = $request->cod_pais_res;
                  $tarifasGuias->cod_estado = $request->cod_estado_res;
                  $tarifasGuias->cod_ciudad = $request->cod_ciudad_res;
                  $tarifasGuias->cod_destino = $request->destino;
                  $tarifasGuias->fecha_inicial_tar_gui = $request->fecha_inicio;
                  $tarifasGuias->fecha_final_tar_gui = $request->fecha_fin;
                  $tarifasGuias->precio_usd_guia = $request->precio_usd;
                  $tarifasGuias->servicio = $request->servicio;
                  if ($tarifasGuias->save()){
                      DB::commit();
                      return response()->json(array('success' => true),200);
                  }
                  else {
                      DB::rollback();
                      return response()->json(array('success' => false), 200);
                  }
                }else{
                  DB::rollback();
                  return response()->json(array('fecha_invalida' => true), 200);
                }
            }
            catch(\Exception $e) {
                return $e;
                DB::rollback();
                return response()->json(array('success' => false), 200);
            }
        }
  }

  //consulta una tarifa en especìfico adrian 15/05/2018
    function consultar(Request $request){
      return $guias = tarifasGuias::find($request->id);
    }

    //consulta una tarifa en especìfico adrian 15/05/2018
    function ciudad_destino(Request $request){
        return $request->all();
      return $ciudad = Destino::where('codigo', $request->destino)->get();
    }

    function update(Request $request){


    $validator = Validator::make($request->all(), 
        [
          'cod_pais_res'              => 'integer|required',
          'cod_estado_res'            => 'integer|required',
          'cod_ciudad_res'            => 'integer|required',
          'cod_destino'               => 'integer|required',
          'servicio'                  => 'integer|required',
          'fecha_inicial_tar_gui'     => 'required',
          'fecha_final_tar_gui'       => 'required',          
          'precio_usd_guia'                => 'required|numero_o_decimal',
        ]
      );


      if ($validator->fails())
      {
          // The given data did not pass validation
        return response()->json(array('errors' => $validator->messages()),200);
      }
      else{

                DB::beginTransaction();
                try {
                    //se invoca la función que valida las fechas
                    $valido = validarFechasTarifasGuias($request, true);
                    if ($valido) {
                      $tarifasGuias = tarifasGuias::find($request->id_tarifa_guias);
                      $tarifasGuias->cod_guia = $request->idTarifaGui;
                      $tarifasGuias->cod_pais = $request->cod_pais_res;
                      $tarifasGuias->cod_estado = $request->cod_estado_res;
                      $tarifasGuias->cod_ciudad = $request->cod_ciudad_res;
                      $tarifasGuias->cod_destino = $request->cod_destino;
                      $tarifasGuias->fecha_inicial_tar_gui = $request->fecha_inicial_tar_gui;
                      $tarifasGuias->fecha_final_tar_gui = $request->fecha_final_tar_gui;
                      $tarifasGuias->precio_usd_guia = $request->precio_usd_guia;
                      $tarifasGuias->servicio = $request->servicio;
                      if ($tarifasGuias->save()){
                          DB::commit();
                          return response()->json(array('success' => true),200);
                      }
                      else {
                          DB::rollback();
                          return response()->json(array('success' => false), 200);
                      }
                    }else{
                      DB::rollback();
                      return response()->json(array('fecha_invalida' => true), 200);
                    }
                }
                catch(\Exception $e) {
                    return $e;
                    DB::rollback();
                    return response()->json(array('success' => false), 200);
                }
        }
  }

  
//19/06/2018
   public function eliminar(Request $request){
          DB::beginTransaction();
          try {
            $toDelete = tarifasGuias::find($request->id);

            if ($toDelete->delete()) {
                DB::commit();
                return response()->json(array('success' => true),200);
            }
            else {
                DB::rollback();
                return response()->json(array('success' => false), 200);
            }
          }
          catch(\Exception $e) {
              return $e;
              DB::rollback();
              return response()->json(array('success' => false), 200);
          }
        }

    
}
