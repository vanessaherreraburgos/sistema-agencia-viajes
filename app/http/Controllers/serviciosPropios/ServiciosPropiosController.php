<?php

namespace App\Http\Controllers\serviciosPropios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\serviciosPropios\serviciosPropios;
use App\Models\serviciosPropios\fotosServiciosPropios;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use DB;
class ServiciosPropiosController extends Controller
{
  //24-03-2018 documentar
    public function index(){
      return view('serviciosPropios/list');
    }

    //24-03-2018 documentar
    public function create(){
		    return view('serviciosPropios/create');
    }

    //24-03-2018 documentar
    public function store(Request $request){

      $validator = Validator::make($request->all(), 
        [
          'nombre' => 'required|alfa_num_espacio|max:50',
          'descripcion' => 'required|alfa_num_espacio|max:300',
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
            

                    $serviciosPropios = new serviciosPropios;
                    $serviciosPropios->nombre = $request->nombre;
                    $serviciosPropios->descripcion = $request->descripcion;
                    if ($serviciosPropios->save()) {

              // Para tomar la imagen de foto de perfil de los choferes
              #--------------------------------------------------------------------------------------------------
              if (!is_null($request->file('foto_servicio_propio'))) { //  Si está cargando una foto haga:
                  $array_foto = $request->file('foto_servicio_propio'); // recupera la imagen
                  $ext = $array_foto->getClientOriginalExtension(); // recupera la extensión del archivo
                  $nombre_foto = $serviciosPropios->codigo.'.'.$ext; // Genera un nombre del archivo
                  $ruta_foto = Config::get('constants.RUTA_SERVICIOS_PROPIOS').$nombre_foto; // ruta donde se almacenará la imagen de firma digital.
                  file_put_contents($ruta_foto,  File::get($array_foto)); // Función para subir la imagen
              }
              #-------------------------------------------------------------------------------------------------
                $fotosServiciosPropios = new fotosServiciosPropios;
                $fotosServiciosPropios->archivo = $nombre_foto;
                $fotosServiciosPropios->cod_serv_propio = $serviciosPropios->codigo;
                if ($fotosServiciosPropios->save()) {
                  DB::commit();
                  return response()->json(array('success' => true),200);
                }
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

    //24-03-2018 documentar
    public function edit($id){
      $serviciosPropios = serviciosPropios::findOrFail($id);
      return view('serviciosPropios/edit', compact('serviciosPropios'));
    }

    //25-03-2018 documentar
    public function update(Request $request, $id){

      $validator = Validator::make($request->all(), 
        [
          'nombre' => 'required|alfa_num_espacio|max:50',
          'descripcion' => 'required|alfa_num_espacio|max:300',
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
            if (serviciosPropios::findOrFail($id)->update($request->all())) {
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
    //25-03-2018 documentar
    public function consultar(Request $request){
       return $serviciosPropios = serviciosPropios::find($request->id);
    }
    //29-03-2018 documentar
    public function dataTableServiciosPropios(Request $request){
      $serviciosPropios = serviciosPropios::get();

      // return  $vehiculo;

      return Datatables::of($serviciosPropios)
      ->addColumn('nombre',function($serviciosPropios){
          return $serviciosPropios->nombre;
      })
      ->addColumn('descripcion',function($serviciosPropios){
          return $serviciosPropios->descripcion;
      })
      ->addColumn('action',function($serviciosPropios){
          return '<a href="tarifas/'.$serviciosPropios->codigo.'" title="'.trans('copies.generales.boton_gest_tarifas').'" class="btn btn btn-default"><i class="fa fa-money"></i></a>'.
          "<button type='button' class='editar btn btn-default' value='".$serviciosPropios->codigo."'><i class='fa fa-pencil-square-o'></i>
          </button>	<button type='button' id='btn-delete' class='eliminar btn btn-default' value='".$serviciosPropios->codigo."'><i class='fa fa-trash-o'></i></button>";
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    public function eliminar(Request $request){
      DB::beginTransaction();
      try {
        $toDelete = serviciosPropios::find($request->id);

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

    public function show(){
    }



}
