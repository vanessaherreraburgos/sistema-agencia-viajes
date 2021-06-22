<?php

namespace App\Http\Controllers\guias;

use App\Http\Controllers\Controller;
use App\Models\guias\guias;
use App\Models\parametrizacion\TipoDocumento;
use App\Models\tarifasGuias\tarifasGuias;
use App\Models\parametrizacion\GradoLicencia;
use App\Models\configuracion\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use DB;
class GuiasController extends Controller
{
	//12-03-2018
    public function index(){

    	return view('guias/list');
    }
    //12-03-2018
    public function create(){

        $tipos_documento = TipoDocumento::pluck('nombre', 'codigo');
        $nacionalidades = Pais::pluck('nacionalidad', 'codigo');
        $grado_licencia = GradoLicencia::pluck('nombre', 'codigo'); // falta validar que sea por país
		    return view('guias/create', compact('tipos_documento', 'nacionalidades', 'grado_licencia'));

    }
//12-03-2018 documentar
    public function store(Request $request){


      $validator = Validator::make($request->all(), 
        [
          'cod_tipo_documento'           => 'integer|required',
          'nombres'                      => 'required|alfa_espacio|max:80',
          'documento'                    => 'required|alfa_num_espacio|max:30',
          'apellido1'                    => 'required|alfa_espacio|max:50',
          'apellido2'                    => 'alfa_espacio|max:50',
          'cod_pais_nacionalidad'        => 'integer|required',
          'cod_pais_res'                 => 'integer|required',
          'cod_estado_res'               => 'integer|required',
          'cod_ciudad_res'               => 'integer|required',
          'direccion'                    => 'alfa_num_caracteres|max:100',
          'email'                        => 'required|email|max:50',
          'telefono_celular'             => 'required|max:20',
          'telefono_local'               => 'max:20',
          'fecha_vigencia_cert_medico'   => 'required',
          'credencial_turismo_num'       => 'required|alfa_num_espacio|max:50',
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
                $nombre_cre_tur = null;
                // Para tomar la imagen de foto de perfil de los choferes
                #--------------------------------------------------------------------------------------------------
                if (!is_null($request->file('foto_guia'))) { //  Si está cargando una foto haga:
                    $array_foto = $request->file('foto_guia'); // recupera la imagen
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


                // Para subir el adjunto de la credencial de turismo
                #--------------------------------------------------------------------------------------------------
                if (!is_null($request->file('adjunto_credencial'))) { //  Si está cargando una imagen haga:
                    $array_cre_tur = $request->file('adjunto_credencial'); // recupera la imagen
                    $ext = $array_cre_tur->getClientOriginalExtension(); // recupera la extensión del archivo
                    $nombre_cre_tur = $request->documento.'.'.$ext; // Genera un nombre del archivo
                    $ruta_cre_tur = Config::get('constants.RUTA_CREDEN_TURISMO').$nombre_cre_tur; // ruta donde se almacenará la imagen de firma digital.
                    file_put_contents($ruta_cre_tur,  File::get($array_cre_tur)); // Función para subir la imagen
                }
                #-------------------------------------------------------------------------------------------------

                if (guias::create($request->all())) {

                    // sentencia para editar el nombre de la foto de perfil del guía, el certificado médico y la credencial
                    guias::where('documento', '=', $request->documento)->update(array('foto_guia' => $nombre_foto, 'adjunto_certificado_medico' => $nombre_cer_med, 'adjunto_credencial' => $nombre_cre_tur));

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

    //29-03-2018 documentar
    public function dataTableGuias(Request $request){
      $guias = guias::get();

      // return  $vehiculo;

      return Datatables::of($guias)
      ->addColumn('foto',function($guias){
          return '<img src="http://localhost/kuravaina/public/perfiles_usuario/'.$guias->foto_guia.'" class="img img-sm img-circle" />';
      })
      ->addColumn('cod_tipo_documento',function($guias){
          return $guias->getTipoDocumento->abreviado.' '.$guias->documento;
      })
      ->addColumn('nombre',function($guias){
          return $guias->nombres.' '.$guias->apellido1.' '.$guias->apellido2;
      })
      ->addColumn('residencia',function($guias){
          return $guias->getPaisRes->nombre.', '.$guias->getEstadoRes->nombre.', '.$guias->getCiudadRes->nombre.' - '.$guias->direccion_res;
      })
      ->addColumn('telefonos',function($guias){
          return $guias->telefono_celular.', '.$guias->telefono_local;
      })
      ->addColumn('email',function($guias){
          return $guias->email;
      })
      ->addColumn('credencial',function($guias){
          return '<div class="infont col-md-3 col-sm-4"><i class="fa fa-address-card" aria-hidden="true"></i></div> '.$guias->credencial_turismo_num;
      })
      ->addColumn('action',function($guias){
          return '<a href="tarifas/'.$guias->codigo.'" title="'.trans('copies.generales.boton_gest_tarifas').'" class="btn btn btn-default"><i class="fa fa-money"></i></a>'.
                  "<button type='button' class='editar btn btn-default' value='".$guias->codigo."'><i class='fa fa-pencil-square-o'></i>
                  </button>	<button type='button' id='btn-delete' class='eliminar btn btn-default' value='".$guias->codigo."'><i class='fa fa-trash-o'></i></button>";
      })
      ->rawColumns(['action', 'foto', 'credencial'])
      ->make(true);
    }


    //31-03-2018
        public function eliminar(Request $request){
          DB::beginTransaction();
          try {
            $toDelete = guias::find($request->id);

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

        //documentar 5-abr-2018

        public function edit($id){

            $guias = guias::findOrFail($id);
            $tipos_documento = TipoDocumento::pluck('nombre', 'codigo');
            $nacionalidades = Pais::pluck('nacionalidad', 'codigo');
            return view('guias/edit', compact('id', 'tipos_documento', 'nacionalidades', 'guias'));
        }

        //documentar 5-abr-2018
        public function consultar(Request $request){
           return $guias = guias::find($request->id);
        }


        //documentar 9/04/2018
        public function update(Request $request){

          $validator = Validator::make($request->all(), 
        [
          // 'cod_tipo_documento'           => 'integer|required',
          'nombres'                      => 'required|alfa_num_espacio|max:80',
          // 'documento'                    => 'required|alfa_num_espacio|max:30',
          'apellido1'                    => 'required|alfa_espacio|max:50',
          'apellido2'                    => 'alfa_espacio|max:50',
          'cod_pais_nacionalidad'        => 'integer|required',
          'cod_pais_res'                 => 'integer|required',
          'cod_estado_res'               => 'integer|required',
          'cod_ciudad_res'               => 'integer|required',
          'direccion'                    => 'alfa_num_caracteres|max:100',
          'email'                        => 'required|email|max:50',
          'telefono_celular'             => 'required|max:20',
          'telefono_local'               => 'max:20',
          'fecha_vigencia_cert_medico'   => 'required',
          'credencial_turismo_num'       => 'required|alfa_num_espacio|max:50',
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
                    $guia = guias::where("documento", "=" , $request->documento)->first()->codigo;
                    $nombre_foto       = null;
                    $nombre_cer_med    = null;
                    $nombre_cre_tur = null;
                    // Para tomar la imagen de foto de perfil de los choferes
                    #--------------------------------------------------------------------------------------------------

                    if (!is_null($request->file('foto_guia'))) { //  Si está cargando una foto haga:
                        $array_foto = $request->file('foto_guia'); // recupera la imagen
                        $ext = $array_foto->getClientOriginalExtension(); // recupera la extensión del archivo
                        $nombre_foto = $request->documento.'.'.$ext; // Genera un nombre del archivo
                        $ruta_foto = Config::get('constants.RUTA_FOTOS_PERFIL').$nombre_foto; // ruta donde se almacenará la imagen de firma digital.
                        file_put_contents($ruta_foto,  File::get($array_foto)); // Función para subir la imagen
                    }
                    #---------------------------------------------------------------------------------------------------

                    // Para subir el certificado médico de los choferes
                    #--------------------------------------------------------------------------------------------------
                    if (!is_null($request->file('adjunto_certificado_medico'))) { //  Si está cargando una imagen haga:
                        $array_cer_med = $request->file('adjunto_certificado_medico'); // recupera la imagen
                        $ext = $array_cer_med->getClientOriginalExtension(); // recupera la extensión del archivo
                        $nombre_cer_med = $request->documento.'.'.$ext; // Genera un nombre del archivo
                        $ruta_cer_med = Config::get('constants.RUTA_CERTI_MEDICOS').$nombre_cer_med; // ruta donde se almacenará la imagen de firma digital.
                        file_put_contents($ruta_cer_med,  File::get($array_cer_med)); // Función para subir la imagen
                    }
                    #---------------------------------------------------------------------------------------------------

                    // Para subir el adjunto de la licenicia de conducir
                    #--------------------------------------------------------------------------------------------------
                    if (!is_null($request->file('adjunto_credencial'))) { //  Si está cargando una imagen haga:
                        $array_lic_conduc = $request->file('adjunto_credencial'); // recupera la imagen
                        $ext = $array_lic_conduc->getClientOriginalExtension(); // recupera la extensión del archivo
                        $nombre_cre_tur = $request->documento.'.'.$ext; // Genera un nombre del archivo
                        $ruta_cre_tur = Config::get('constants.RUTA_CREDEN_TURISMO').$nombre_cre_tur; // ruta donde se almacenará la imagen de firma digital.
                        file_put_contents($ruta_cre_tur,  File::get($array_lic_conduc)); // Función para subir la imagen
                    }
                    #---------------------------------------------------------------------------------------------------

                    $guias = guias::find($guia);
                    // $guias->documento = $request->documento;
                    $guias->nombres = $request->nombres;
                    $guias->apellido1 = $request->apellido1;
                    $guias->apellido2 = $request->apellido2;
                    $guias->cod_pais_res = $request->cod_pais_res;
                    $guias->cod_estado_res = $request->cod_estado_res;
                    $guias->cod_ciudad_res = $request->cod_ciudad_res;
                    $guias->direccion_res = $request->direccion_res;
                    $guias->telefono_celular = $request->telefono_celular;
                    $guias->telefono_local = $request->telefono_local;
                    $guias->email = $request->email;
                    if (!is_null($request->file('foto_guia'))) {
                      $guias->foto_guia = $nombre_foto;
                    }
                    if (!is_null($request->file('adjunto_certificado_medico'))) {
                      $guias->adjunto_certificado_medico = $nombre_cer_med;
                    }
                    if (!is_null($request->file('adjunto_credencial'))) {
                      $guias->adjunto_credencial = $nombre_cre_tur;
                    }
                    $guias->cod_pais_nacionalidad = $request->cod_pais_nacionalidad;
                    $guias->fecha_vigencia_cert_medico = $request->fecha_vigencia_cert_medico;
                    $guias->credencial_turismo_num = $request->credencial_turismo_num;

                    if ($guias->save()) {
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


}
