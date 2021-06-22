<?php

namespace App\Http\Controllers\serviciosPropios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\serviciosPropios\serviciosPropios;
use App\Models\tarifasServPropios\tarifasServPropios;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use DB;

class TarifasServiciosPropios extends Controller
{

  public function show(Request $request){
      //
  }
  //17-04-2018
  public function tarifas(Request $request){
      $serviciosPropios = serviciosPropios::find($request->id);
    return view('serviciosPropios/tarifas', compact('serviciosPropios'));
  }

  //15-4-2018 documentar
  public function dataTableTarifasServPropios($id){
    $tarifasServPropios = tarifasServPropios::where('cod_serv_propio', $id)->get();

    // return  $vehiculo;
    return Datatables::of($tarifasServPropios)
    ->addColumn('fechas',function($tarifasServPropios){
        return 'Desde: '.$tarifasServPropios->fecha_inicio_tsp.' <br> '.'Hasta: '.$tarifasServPropios->fecha_final_tsp;
    })
    ->addColumn('precio',function($tarifasServPropios){
        return $tarifasServPropios->precio_usd_tsp;
    })
    ->addColumn('action',function($tarifasServPropios){
        return "
        <button type='button' class='editar btn btn-default' data-toggle='modal' data-target='#modalTarifasServPropiosEditar' value='".$tarifasServPropios->codigo."'><i class='fa fa-pencil-square-o'></i></button>
        <button type='button' id='btn-delete' class='eliminar btn btn-default' value='".$tarifasServPropios->codigo."'><i class='fa fa-trash-o'></i></button>";
    })
    ->rawColumns(['destino', 'fechas', 'action'])
    ->make(true);
  }

  function almacenar(Request $request){

    $validator = Validator::make($request->all(), 
        [
          'fecha_inicio_tsp' => 'required',
          'fecha_final_tsp' => 'required',          
          'precio_usd_tsp' => 'required|numero_o_decimal',
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
            $valido = validarFechasTarifasSP($request);
            if ($valido) {
              if (tarifasServPropios::create($request->all())){
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
    return $serviciosPropios = tarifasServPropios::find($request->id);
  }


  //11-05-2018 documentar

  public function eliminar(Request $request){
    DB::beginTransaction();
    try {
      $toDelete = tarifasServPropios::find($request->id);

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

  //11-05-2018 documentar
  public function update(Request $request){

    $validator = Validator::make($request->all(), 
        [
          'fecha_inicio_tsp' => 'required',
          'fecha_final_tsp' => 'required',
          'precio_usd_tsp' => 'required|numero_o_decimal',
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
            $valido = validarFechasTarifasSP($request, true);
            if ($valido) {
              if (tarifasServPropios::findOrFail($request->id_tarifa)->update($request->all())) {
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

}
