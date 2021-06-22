<?php

namespace App\Http\Controllers\choferes;

use App\Http\Controllers\Controller;
use App\Models\choferes\choferes;
use App\Models\choferes\num_licencias;
use App\Models\parametrizacion\TipoDocumento;
use App\Models\parametrizacion\GradoLicencia;
use App\Models\configuracion\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
class ChoferesController extends Controller
{
    //documentar
    public function index(){
    	return view('choferes/list');
    }
    //documentar
    public function create(){

        $tipos_documento = TipoDocumento::pluck('nombre', 'codigo');
        $nacionalidades = Pais::pluck('nacionalidad', 'codigo');
        $grado_licencia = GradoLicencia::pluck('nombre', 'codigo'); // falta validar que sea por país
		    return view('choferes/create', compact('tipos_documento', 'nacionalidades', 'grado_licencia'));

    }
    //documentar
    public function store(Request $request){

      $validator = Validator::make($request->all(), 
        [
          'cod_tipo_documento'           => 'integer|required',
          'nombre'                       => 'required|alfa_espacio|max:80',
          'documento'                    => 'required|alfa_num_espacio|max:30',
          'apellido1'                    => 'required|alfa_espacio|max:50',
          'apellido2'                    => 'alfa_espacio|max:50',
          'cod_pais_nacionalidad'        => 'integer|required',
          'cod_pais_res'                 => 'integer|required',
          'cod_estado_res'               => 'integer|required',
          'cod_ciudad_res'               => 'integer|required',
          'direccion_res'                => 'alfa_num_caracteres|max:100',
          'email'                        => 'required|email|max:50',
          'telefono_celular'             => 'required|max:20',
          'telefono_local'               => 'max:20',
          'fecha_vigencia_cert_medico'   => 'required',
          'fecha_vigencia_licencia'      => 'required',
          'cod_grado_licencia'           => 'required',
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

              $nombre_foto       = null;
              $nombre_cer_med    = null;
              $nombre_lic_conduc = null;
              // Para tomar la imagen de foto de perfil de los choferes
              #--------------------------------------------------------------------------------------------------
              if (!is_null($request->file('foto_chofer'))) { //  Si está cargando una foto haga:
                  $array_foto = $request->file('foto_chofer'); // recupera la imagen
                  $ext = $array_foto->getClientOriginalExtension(); // recupera la extensión del archivo
                  $nombre_foto = $request->documento.'.'.$ext; // Genera un nombre del archivo
                  $ruta_foto = Config::get('constants.RUTA_FOTOS_PERFIL').$nombre_foto; // ruta donde se almacenará la imagen de firma digital.
                  file_put_contents($ruta_foto,  File::get($array_foto)); // Función para subir la imagen
              }

              #-------------------------------------------------------------------------------------------------

              // Para subir el certificado médico de los choferes
              #--------------------------------------------------------------------------------------------------
              if (!is_null($request->file('adjunto_certificado_medico'))) { //  Si está cargando una imagen haga:
                  $array_cer_med = $request->file('adjunto_certificado_medico'); // recupera la imagen
                  $ext = $array_cer_med->getClientOriginalExtension(); // recupera la extensión del archivo
                  $nombre_cer_med = $request->documento.'.'.$ext; // Genera un nombre del archivo
                  $ruta_cer_med = Config::get('constants.RUTA_CERTI_MEDICOS').$nombre_cer_med; // ruta donde se almacenará la imagen de firma digital.
                  file_put_contents($ruta_cer_med,  File::get($array_cer_med)); // Función para subir la imagen
              }
              #------------------------------------------------------------------------------------------------

              // Para subir el adjunto de la licenicia de conducir
              #--------------------------------------------------------------------------------------------------
              if (!is_null($request->file('archivo_licencia'))) { //  Si está cargando una imagen haga:
                  $array_lic_conduc = $request->file('archivo_licencia'); // recupera la imagen
                  $ext = $array_lic_conduc->getClientOriginalExtension(); // recupera la extensión del archivo
                  $nombre_lic_conduc = $request->documento.'.'.$ext; // Genera un nombre del archivo
                  $ruta_lic_conduc = Config::get('constants.RUTA_LICEN_CONDUCCION').$nombre_lic_conduc; // ruta donde se almacenará la imagen de firma digital.
                  file_put_contents($ruta_lic_conduc,  File::get($array_lic_conduc)); // Función para subir la imagen
              }
              #-------------------------------------------------------------------------------------------------

            if (choferes::create($request->all())) {
                // sentencia para editar el nombre de la foto de perfil del chofer, el certificado médico y la licencia
                choferes::where('documento', '=', $request->documento)->update(array('foto_chofer' => $nombre_foto, 'adjunto_certificado_medico' => $nombre_cer_med, 'archivo_licencia' => $nombre_lic_conduc));

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
    //documentar
    public function edit($id){

        $choferes = Choferes::findOrFail($id);
        $tipos_documento = TipoDocumento::pluck('nombre', 'codigo');
        $nacionalidades = Pais::pluck('nacionalidad', 'codigo');
        $grado_licencia = GradoLicencia::pluck('nombre', 'codigo'); // falta validar que sea por país
        return view('choferes/edit', compact('id', 'tipos_documento', 'nacionalidades', 'grado_licencia', 'choferes'));
    }
    //documentar
    public function update(Request $request){


      $validator = Validator::make($request->all(), 
        [
          // 'cod_tipo_documento'           => 'integer|required',
          'nombre'                       => 'required|alfa_espacio|max:80',
          // 'documento'                    => 'required|alfa_num_espacio|max:30',
          'apellido1'                    => 'required|alfa_espacio|max:50',
          'apellido2'                    => 'alfa_espacio|max:50',
          'cod_pais_nacionalidad'        => 'integer|required',
          'cod_pais_res'                 => 'integer|required',
          'cod_estado_res'               => 'integer|required',
          'cod_ciudad_res'               => 'integer|required',
          'direccion_res'                => 'alfa_num_caracteres|max:100',
          'email'                        => 'required|email|max:50',
          'telefono_celular'             => 'required|max:20',
          'telefono_local'               => 'max:20',
          'fecha_vigencia_cert_medico'   => 'required',
          'fecha_vigencia_licencia'      => 'required',
          'cod_grado_licencia'           => 'required',
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
                $choferes = Choferes::where("documento", "=" , $request->documento)->first()->codigo;
                $nombre_foto       = null;
                $nombre_cer_med    = null;
                $nombre_lic_conduc = null;
                // Para tomar la imagen de foto de perfil de los choferes
                #--------------------------------------------------------------------------------------------------

                if (!is_null($request->file('foto_cho'))) { //  Si está cargando una foto haga:
                    $array_foto = $request->file('foto_cho'); // recupera la imagen
                    $ext = $array_foto->getClientOriginalExtension(); // recupera la extensión del archivo
                    $nombre_foto = $request->documento.'.'.$ext; // Genera un nombre del archivo
                    $ruta_foto = Config::get('constants.RUTA_FOTOS_PERFIL').$nombre_foto; // ruta donde se almacenará la imagen de firma digital.
                    file_put_contents($ruta_foto,  File::get($array_foto)); // Función para subir la imagen
                }
                #---------------------------------------------------------------------------------------------------

                // Para subir el certificado médico de los choferes
                #--------------------------------------------------------------------------------------------------
                if (!is_null($request->file('cert_med_cho'))) { //  Si está cargando una imagen haga:
                    $array_cer_med = $request->file('cert_med_cho'); // recupera la imagen
                    $ext = $array_cer_med->getClientOriginalExtension(); // recupera la extensión del archivo
                    $nombre_cer_med = $request->documento.'.'.$ext; // Genera un nombre del archivo
                    $ruta_cer_med = Config::get('constants.RUTA_CERTI_MEDICOS').$nombre_cer_med; // ruta donde se almacenará la imagen de firma digital.
                    file_put_contents($ruta_cer_med,  File::get($array_cer_med)); // Función para subir la imagen
                }
                #---------------------------------------------------------------------------------------------------

                // Para subir el adjunto de la licenicia de conducir
                #--------------------------------------------------------------------------------------------------
                if (!is_null($request->file('lic_adj_cho'))) { //  Si está cargando una imagen haga:
                    $array_lic_conduc = $request->file('lic_adj_cho'); // recupera la imagen
                    $ext = $array_lic_conduc->getClientOriginalExtension(); // recupera la extensión del archivo
                    $nombre_lic_conduc = $request->documento.'.'.$ext; // Genera un nombre del archivo
                    $ruta_lic_conduc = Config::get('constants.RUTA_LICEN_CONDUCCION').$nombre_lic_conduc; // ruta donde se almacenará la imagen de firma digital.
                    file_put_contents($ruta_lic_conduc,  File::get($array_lic_conduc)); // Función para subir la imagen
                }
                #---------------------------------------------------------------------------------------------------

                $choferes = choferes::find($choferes);
                // $choferes->documento = $request->documento;
                $choferes->nombre = $request->nombre;
                $choferes->apellido1 = $request->apellido1;
                $choferes->apellido2 = $request->apellido2;
                $choferes->cod_pais_res = $request->cod_pais_res;
                $choferes->cod_estado_res = $request->cod_estado_res;
                $choferes->cod_ciudad_res = $request->cod_ciudad_res;
                $choferes->direccion_res = $request->direccion_res;
                $choferes->telefono_celular = $request->telefono_celular;
                $choferes->telefono_local = $request->telefono_local;
                $choferes->email = $request->email;
                if (!is_null($request->file('foto_cho'))) {
                  $choferes->foto_chofer = $nombre_foto;
                }
                if (!is_null($request->file('cert_med_cho'))) {
                  $choferes->adjunto_certificado_medico = $nombre_cer_med;
                }
                if (!is_null($request->file('lic_adj_cho'))) {
                  $choferes->archivo_licencia = $nombre_lic_conduc;
                }
                $choferes->cod_pais_nacionalidad = $request->cod_pais_nacionalidad;
                $choferes->cod_grado_licencia = $request->cod_grado_licencia;
                $choferes->fecha_vigencia_cert_medico = $request->fecha_vigencia_cert_medico;
                $choferes->fecha_vigencia_licencia = $request->fecha_vigencia_licencia;

                if ($choferes->save()) {
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
    //documentar
    public function delete($id){
		// eliminar el chofer que viene por id

    }
    //documentar
    public function consultar(Request $request){
       return $choferes = Choferes::find($request->id);
    }

    //31-03-2018 documentar
    public function dataTableChoferes(Request $request){
      $choferes = Choferes::get();

      // return  $vehiculo;

      return Datatables::of($choferes)
      ->addColumn('foto',function($choferes){
          return '<img src="http://localhost/kuravaina/public/perfiles_usuario/'.$choferes->foto_chofer.'" class="img img-sm img-circle" />';
      })
      ->addColumn('cod_tipo_documento',function($choferes){
          return $choferes->getTipoDocumento->abreviado.' '.$choferes->documento;
      })
      ->addColumn('nombre',function($choferes){
          return $choferes->nombre.' '.$choferes->apellido1.' '.$choferes->apellido2;
      })
      ->addColumn('residencia',function($choferes){
          return $choferes->getPaisRes['nombre'].', '.$choferes->getEstadoRes['nombre'].', '.$choferes->getCiudadRes['nombre'].' - '.$choferes->direccion_res;
      })
      ->addColumn('telefonos',function($choferes){
          return $choferes->telefono_celular.', '.$choferes->telefono_local;
      })
      ->addColumn('email',function($choferes){
          return $choferes->email;
      })
      ->addColumn('cod_grado_licencia',function($choferes){
          return $choferes->cod_grado_licencia;
      })
      ->addColumn('vigencia_licencia',function($choferes){
        $hoy = Carbon::now();
        if ($choferes->fecha_vigencia_licencia >= $hoy) {
          return '<p><span class="badge badge-primary">Vigente</span></p>';

        }else {
          return '<p><span class="badge">No vigente</span></p>';
        }

      })
      ->addColumn('action',function($choferes){

          return '<a href="tarifas/'.$choferes->codigo.'" title="'.trans('copies.generales.boton_gest_tarifas').'" class="btn btn btn-default"><i class="fa fa-money"></i></a>'.
          "<button type='button' class='editar btn btn-default' value='".$choferes->codigo."'><i class='fa fa-pencil-square-o'></i></button>
          <button type='button' id='btn-delete' class='eliminar btn btn-default' value='".$choferes->codigo."'><i class='fa fa-trash-o'></i></button>";
      })
      ->rawColumns(['action', 'foto', 'vigencia_licencia', 'tarifas'])
      ->make(true);
    }


//31-03-2018
    public function eliminar(Request $request){
      DB::beginTransaction();
      try {
        $toDelete = Choferes::find($request->id);

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



// lista de numeros de licencia -- adrian 11 de junio -
  public function getListNumLicencia(){
      return num_licencias::orderBy('nombre')->get();
  }



}
