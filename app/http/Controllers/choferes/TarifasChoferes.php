<?php

namespace App\Http\Controllers\choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Models\choferes\choferes;
use App\Models\tarifasChofer\tarifasChofer;
use DB;

class TarifasChoferes extends Controller
{
  //9-04-2018
  public function tarifas(Request $request){
      $chofer = Choferes::find($request->id);
    return view('choferes/tarifas', compact('chofer'));
  }


  //31-03-2018 documentar
  public function dataTableTarifasChoferes($id){
    $tarifasChofer = tarifasChofer::where('cod_chofer', $id)->get();
    // return  $vehiculo;

    return Datatables::of($tarifasChofer)
    ->addColumn('destino',function($tarifasChofer){
        $ciudad = $tarifasChofer->getDestino->getCiudad;
        $estado = $ciudad->getEstado;
        $pais   = $estado ->getPais;
        return $tarifasChofer->getDestino->descripcion.'<br>'.$ciudad->nombre.' - '.$estado->nombre.' - '.$pais->nombre;
    })
    ->addColumn('servicios',function($tarifasChofer){
        return $tarifasChofer->getServicios->descripcion;
    })
    ->addColumn('fechas',function($tarifasChofer){
        return 'Desde: '.$tarifasChofer->fecha_inicial_tar_cho.' <br> '.'Hasta: '.$tarifasChofer->fecha_final_tar_cho;
    })
    ->addColumn('tipo_vehiculo',function($tarifasChofer){
        return $tarifasChofer->getTipoVehiculo->descripcion;
    })
    ->addColumn('precio',function($tarifasChofer){
        return $tarifasChofer->precio_usd_chofer;
    })
    ->addColumn('action',function($tarifasChofer){
        return "
        <button type='button' class='editar btn btn-default' data-toggle='modal' data-target='#modalTarifasChoferEditar' value='".$tarifasChofer->codigo."'><i class='fa fa-pencil-square-o'></i></button>
        <button type='button' id='btn-delete' class='eliminar btn btn-default' value='".$tarifasChofer->codigo."'><i class='fa fa-trash-o'></i></button>";
    })
    ->rawColumns(['destino', 'fechas', 'action'])
    ->make(true);
  }

      function almacenar(Request $request){
        DB::beginTransaction();
        try {
            //se invoca la función que valida las fechas
            $valido = validarFechasTarifasChoferes($request);

            if ($valido) {
                $tarifasChofer = new tarifasChofer;
                $tarifasChofer->cod_chofer = $request->idTarifaCho;
                $tarifasChofer->cod_tipo_vehiculo = $request->tipo_vehiculo;
                $tarifasChofer->cod_pais = $request->cod_pais_res;
                $tarifasChofer->cod_estado = $request->cod_estado_res;
                $tarifasChofer->cod_ciudad = $request->cod_ciudad_res;
                $tarifasChofer->cod_destino = $request->destino;
                $tarifasChofer->fecha_inicial_tar_cho = $request->fecha_inicio;
                $tarifasChofer->fecha_final_tar_cho = $request->fecha_fin;
                $tarifasChofer->precio_usd_chofer = $request->precio;
                $tarifasChofer->servicio = $request->servicio;
                if ($tarifasChofer->save()){
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

//documentar - adrián - 21/06/2018
function update(Request $request){
    DB::beginTransaction();
    try {

        //se invoca la función que valida las fechas
        $valido = validarFechasTarifasChoferes($request, true);

        if ($valido) {
            $tarifasChoferes = tarifasChofer::find($request->id_tarifa_choferes);
            $tarifasChoferes->cod_chofer = $request->idTarifaCho;
            $tarifasChoferes->cod_pais = $request->cod_pais_res_tar_chofer;
            $tarifasChoferes->cod_estado = $request->cod_estado_res_tar_chofer;
            $tarifasChoferes->cod_ciudad = $request->cod_ciudad_res_tar_chofer;
            $tarifasChoferes->cod_destino = $request->destino_tar_chofer;
            $tarifasChoferes->fecha_inicial_tar_cho = $request->fecha_inicio;
            $tarifasChoferes->fecha_final_tar_cho = $request->fecha_fin;
            $tarifasChoferes->precio_usd_chofer = $request->precio;
            $tarifasChoferes->servicio = $request->servicio_tar_chofer;
            $tarifasChoferes->cod_tipo_vehiculo = $request->tipo_vehiculo;
            if ($tarifasChoferes->save()){
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

      //consulta una tarifa en especìfico adrian 15/05/2018
        function consultar(Request $request){
          return $choferes = tarifasChofer::find($request->id);
        }

        //21/06/2018
   public function eliminar(Request $request){
          DB::beginTransaction();
          try {
            $toDelete = tarifasChofer::find($request->id);

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
