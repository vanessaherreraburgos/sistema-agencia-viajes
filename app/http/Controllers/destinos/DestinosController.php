<?php

namespace App\Http\Controllers\destinos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Response;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use DB;
//modelos
use App\Models\destino\Pais;
use App\Models\destino\Estado;
use App\Models\destino\Ciudad;
use App\Models\destino\Destino;
use App\Models\destino\FotosDestino;

class DestinosController extends Controller{

    // Gestión destinos
    // Visualizacion
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('destinos.list_destino', array('nombre' => 'Javi'));
    }
    /**
     * Consulta de destinos para cargar en dataTable
     */
    public function listDataTable()
    {
        $destinos = Destino::whereHas('getCiudad');
        return Datatables::of($destinos)
            ->addColumn('ubicacion', function($destinos) {
                return $destinos->getCiudad->getUbicacion();
            })
            ->addColumn('descripcion',function($destinos){
                return $destinos->descripcion;
            })
            ->addColumn('direccion',function($destinos){
                return $destinos->direccion;
            })
            ->addColumn('km_recorrer',function($destinos){
                return $destinos->km_recorrer;
            })
            ->addColumn('cant_dias_traslado',function($destinos){
                return $destinos->cant_dias_traslado;
            })
            ->addColumn('action',function($destinos){
                return  '<div>'
                        .'<div class="inline m-l-sm" >'
                            .'<input type="radio" name="destino" value="'.$destinos->codigo.'" />'
                            .'<label></label>'
                        .'</div>'
                        .'</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    // Creación
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('destinos.crear_destino');
    }
    /*
     * funcion para guardar en la tabla correspondiente
     *
     */
    public function guardar_destino(Request $request)
    {
        // validación back-end
            $rules  =   array(  /*'pais'              =>  'required',
                                'estado'            =>  'required',
                                'ciudad'            =>  'required',

                                'nombre_destino'    =>  'required|max:50|min:3'*/
                            );
            $msg    =   array(
            /*'pais.required'             =>    trans('copies.gestion_destinos.mensajes_validaciones.pais_required'),
                                'estado.required'           =>    trans('copies.gestion_destinos.mensajes_validaciones.estado_required'),
                                'ciudad.required'           =>    trans('copies.gestion_destinos.mensajes_validaciones.ciudad_required'),
              */
                                'nombre_destino.required'   =>    trans('copies.gestion_destinos.mensajes_validaciones.nombre_destino_required'),
                                'nombre_destino.max'        =>    trans('copies.gestion_destinos.mensajes_validaciones.nombre_destino_max'),
                                'nombre_destino.min'        =>    trans('copies.gestion_destinos.mensajes_validaciones.nombre_destino_min'),
                            );

        $validator = Validator::make( $request->all(), $rules, $msg);
        if($validator->fails())
        {
            $respuesta  =   array('errors' => $validator->messages());
            $codigo     =   200;
        }
        else{
            // definición de variables
                $codigo                 =   isset($request->codigo)   ?   $request->codigo  :   null;
                $pais                   =   isset($request->pais)   ?   $request->pais  :   null;
                $estado                 =   isset($request->estado) ?   $request->estado    :   null;
                $ciudad                 =   isset($request->ciudad) ?   $request->ciudad    :   null;
                //$nombre_destino         =   isset($request->nombre_destino) ?   $request->nombre_destino    :   null;
                $descripcion_destino    =   isset($request->descripcion_destino)    ?   $request->descripcion_destino   :   null;
                $direccion_destino      =   isset($request->direccion_destino)  ?   $request->direccion_destino :   null;
                $cant_km_recorrer       =   isset($request->cant_km_recorrer)   ?   $request->cant_km_recorrer  :   null;
                $cant_dias_recorrer     =   isset($request->cant_dias_traslado) ?   $request->cant_dias_traslado    :   null;
                $fotos_destino          =   isset($request->fotos)  ?   $request->fotos     :   null;

                if ($codigo == null) {
                    $destino  =   new Destino;
                    $flag_editar  =  false;
                }
                else {
                    $destino = Destino::find($codigo);
                    $foto_destino = FotosDestino::where('cod_destino',$codigo)->get();
                    $flag_editar = true;
                    //dd($foto_destino);
                    //return 1;
                }

            DB::beginTransaction();
            //cargar valores a modelo
            $destino->cod_ciudad            =   $ciudad;
            // $destino->nombre             =   $nombre_destino;
            $destino->descripcion           =   $descripcion_destino;
            $destino->direccion             =   $direccion_destino;
            $destino->km_recorrer           =   $cant_km_recorrer;
            $destino->cant_dias_traslado    =   $cant_dias_recorrer;

            if ($destino->save()) {
                //guardar datos fotos
                if (!is_null($request->file('fotos'))) { //  Si está cargando una foto haga:
                    $array_foto = $request->file('fotos'); // recupera la imagen

                    if ($flag_editar){
                        foreach ($foto_destino as $key => $value) {
                            eliminarArchivo(Config::get('constants.RUTA_FOTOS_DESTINO').$value->archivo);
                            $obj = FotosDestino::find($value->codigo);
                            $obj->delete();
                        }
                    }

                    for($i=0; $i< count($array_foto); $i++){

                        $new_foto_destino =   new FotosDestino;
                        $ext = $array_foto[$i]->getClientOriginalExtension(); // recupera la extensión del archivo
                        $nombre_foto = 'foto_d'.$destino->codigo.'_'.$i.'.'.$ext; // Genera un nombre del archivo
                        $ruta_foto = Config::get('constants.RUTA_FOTOS_DESTINO').$nombre_foto; // ruta donde se almacenará la imagen de firma digital.
                        file_put_contents($ruta_foto,  File::get($array_foto[$i])); // Función para subir la imagen
                        $new_foto_destino->archivo = $nombre_foto;
                        $new_foto_destino->cod_destino = $destino->codigo;
                        if (!$new_foto_destino->save()){
                            DB::rollback();
                            $respuesta  =   array('error' => false);
                            $codigo     =   500;
                            return response()->json($respuesta, $codigo);
                        }
                    }
                }

                DB::commit();
                $respuesta  =   array('success' => true);
                $codigo     =   200;
            }else{
                DB::rollback();
                $respuesta  =   array('error' => false);
                $codigo     =   500;
            }
        }
        return response()->json($respuesta, $codigo);
    }
    // Edición
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $destino = Destino::find($request->id);
        //dd ($destino);
        return view('destinos.editar_destino', array('destino'=>$destino));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }
// Eliminación
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        //
        $obj = Destino::find($request->id);

        if ($obj){
            DB::beginTransaction();
            //validar tablas referenciadas por este destino
            // tarifas_aviones
            // tarifas_chofer
            // tarifas_guia
            // tarifas_vehiculos

            // fotos destinos
            $fotos_destino = $obj->getFotosDestino;
            if (count ($fotos_destino) > 0 ){
                foreach ($fotos_destino as $key => $value) {
                    eliminarArchivo(Config::get('constants.RUTA_FOTOS_DESTINO').$value->archivo);
                    $objFoto = FotosDestino::find($value->codigo);
                    $objFoto->delete();
                }
            }
            if ($obj->delete()){
                $respuesta  =   array('success' => true);
                $codigo     =   200;
                DB::commit();
            }
            else {
                DB::rollback();
                $respuesta  =   array('error' => false);
                $codigo     =   500;
            }
        }
        return response()->json($respuesta, $codigo);
    }

    public function consultar(Request $request){
       return $destino = Destino::find($request->codigo);
    }
// Consultas generales
//pais
    // lista paises
    public function getListPais(){
        return Pais::orderBy('nombre')->get();
    }
    // datos de un pais específico para nacionalidad y moneda
    public function getPais($pais){
        return Pais::where('codigo', $pais)->first;
    }
// lista estados
    public function getListEstados(){
        return Estado::orderBy('nombre')->get();
    }
// lista estados por país
    public function getListEstadosPais($pais){
        return Estado::where('cod_pais', $pais)->orderBy('nombre')->get();
    }
// list ciudades por estado
    public function getListCiudadesEstado($estado){
        return Ciudad::where('cod_estado', $estado)->orderBy('nombre')->get();
    }
// list ciudades
    public function getListCiudades($estado){
        return Ciudad::orderBy('nombre')->get();
    }
// list destinos
    public function getListDestinosCiudad($ciudad){
        return Destino::where('cod_ciudad', $ciudad)->orderBy('descripcion')->get();
    }
// consulta de indicativos y codigos postales
    public function getIndicativoCodPostal($pais, $ciudad){
        $pais   = Pais::where('id_pk', '=', $pais)->first();
        $ciudad = Ciudad::where('id_pk', '=', $ciudad)->first();
        return array('pais_indicativo'          =>      $pais->indicativo,
                     'ciudad_indicativo'        =>      $ciudad->indicativo,
                     'fijo_mascara'             =>      $pais->mask_fijo,
                     'celular_mascara'          =>      $pais->mask_celular,
                     'codigo_postal'            =>      $ciudad->cod_estado,
                    );

    }
    /**
     * Descripción. Muestra el contenido de la tabla Destinos.
     * @author Franklin
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableDestinos()
    {
        $destino = Destino::get();

        return Datatables::of($destino)
        ->addColumn('descripcion',function($destino){
            return $destino->descripcion;
        })
        ->addColumn('direccion',function($destino){
            return $destino->direccion;
        })
        ->addColumn('km_recorrer',function($destino){
            return $destino->km_recorrer;
        })
        ->addColumn('cant_dias_traslado',function($destino){
            return $destino->cant_dias_traslado;
        })
        ->addColumn('action',function($destino){
            return '<a title="'.trans('copies.generales.boton_editar').'" class="btn btn-link" href="editar/'.$destino->codigo.'"><i class="fa fa-edit"></i></a>
                    <a title="'.trans('copies.generales.boton_eliminar').'" class="btn btn-link" href="#" onClick="eliminar_registro(\'destinos/eliminar\','.$destino->codigo.',\'#tablaListarDestinos\')"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    // lista de nacionalidades -- adrian 27 de mayo
    public function getListNacionalidades(){
        return Pais::orderBy('nacionalidad')->select('codigo', 'nacionalidad')->get();
    }
}
