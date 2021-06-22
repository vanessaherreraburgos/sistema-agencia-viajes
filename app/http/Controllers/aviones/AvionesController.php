<?php

namespace App\Http\Controllers\aviones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Response;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Storage;
use App\Models\aviones\Avion;
use App\Models\aviones\TipoAvion;
use App\Models\aviones\ProveedorAvion;

class AvionesController extends Controller
{

    /**
     * Descripción. Reglas de validación para los campos de un avión.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rules = [
        'id'                        => 'integer|nullable',
        'foto_avion'                => 'image',
        'anno_avion'                => 'integer',
        'modelo'                    => 'required|texto',
        'marca'                     => 'required|texto',
        // 'cant_max_pasajeros'        => 'integer',
        // 'cant_ventanas'             => 'integer',
        'es_propio'                 => 'required|boolean',
        'cod_prov_avion'            => 'integer|nullable',
        'activo'                    => 'boolean|nullable',
    ];

    /**
     * Descripción. Reglas de validación para el identificador de avión.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rulesId = [
        'id'                => 'integer|required',
    ];

    /**
     * Descripción. Muestra la pantalla de listar aviones.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} list_avion.
     */
    public function index()
    {
        return view('aviones.list_avion');
    }

    /**
     * Descripción. Muestra la pantalla para crear un nuevo avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} crear_avion.
     */
    public function create()
    {
        $tiposAviones     = TipoAvion::arrayTiposAvionesActivos();
        $ProveedoresAvion = ProveedorAvion::arrayProveedoresAviones();

        return view('aviones.crear_avion', ['tiposAviones' => $tiposAviones,
                                                'ProveedoresAvion' => $ProveedoresAvion]);
    }

    /**
     * Descripción. Almacena un nuevo avión en la base de datos.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $avion = new Avion();

                $fotoAvion = $request->file('foto_avion');
                if (file_exists($fotoAvion)){
                    $fotoAvion->store(Config::get('constants.RUTA_FOTO_AVION'), 'uploads');
                    $request['foto'] = $fotoAvion->hashName();
                }

                if($avion->create(array_filter($request->all(), 'strlen'))){
                    DB::commit();
                    return response()->json(array('success' => true),200);
                }
                else{
                    DB::rollback();
                    return response()->json(array('success' => false), 200);
                }
            }
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Descripción. Muestra la pantalla de editar avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador del avión.
     * @return {vista} editar_vehiculo.
     */
    public function edit($id)
    {
        $avion = Avion::findOrFail($id);
        $tiposAviones     = TipoAvion::arrayTiposAvionesActivos();
        $ProveedoresAvion = ProveedorAvion::arrayProveedoresAviones();

        return view('aviones.editar_avion', ['avion' => $avion, 
                                                'tiposAviones' => $tiposAviones,
                                                'ProveedoresAvion' => $ProveedoresAvion]);
    }

    /**
     * Descripción. Actualiza la información de un avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @param  {String}  $id        identificador del avión.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            // se adiciona $id a request para que se pueda validar.
            $request['id'] = $id;      
            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $fotoAvion = $request->file('foto_avion');
                if (file_exists($fotoAvion)){
                    $fotoAvion->store(Config::get('constants.RUTA_FOTO_AVION'), 'uploads');
                    $request['foto'] = $fotoAvion->hashName();
                }

                if(Avion::findOrFail($id)->update(array_filter($request->all(), 'strlen'))){
                    DB::commit();
                    return response()->json(array('success' => true),200);
                }
                else{
                    DB::rollback();
                    return response()->json(array('success' => false), 200);
                }
            }
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Descripción. Elimina la información de un avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request}  $request identificador del avión.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction(); 

        try {

            $validator = Validator::make( ['id' => $request->id], $this->rulesId);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $avion = Avion::findOrFail($request->id);
                $nombreFoto = $avion->foto;

                $avion->delete();

                DB::commit();

                // se elimina la foto si el registro se elimino exitosamente.
                if(!empty($nombreFoto))
                    Storage::disk('uploads')->delete(Config::get('constants.RUTA_FOTO_AVION').$nombreFoto);

                return response()->json(array('success' => true),200);
            }
        } catch(\Exception $e) {
            DB::rollback();  
            return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Descripción. Muestra el contenido de la tabla aviones.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableAviones()
    {
        // $avion = Avion::get();

        $avion = Avion::join('tipo_avion', 'aviones.cod_tipo_avion', '=', 'tipo_avion.codigo')
            ->leftJoin('proveedor_aviones', 'aviones.cod_prov_avion', '=', 'proveedor_aviones.codigo')
            ->select([
            'aviones.*'
        ]);

        return Datatables::of($avion)
        ->addColumn('foto',function($avion){
            
            $rutaFotoAvion = $avion->ruta_foto ? $avion->ruta_foto : asset(Config::get('constants.RUTA_FOTO_AVION_DEF'));
            return "<img alt='image' class='img-circle img-md center-block' src='".$rutaFotoAvion."'>";
        })
        ->addColumn('anno_avion',function($avion){
            return $avion->anno_avion;
        })
        ->addColumn('modelo',function($avion){
            return $avion->modelo;
        })
        ->addColumn('marca',function($avion){
            return $avion->marca;
        })
        ->addColumn('tipo_avion',function($avion){
            return $avion->getTipoAvion ? $avion->getTipoAvion->descripcion : '';
        })
        ->filterColumn('tipo_avion', function($query, $keyword) {
            
            $query->orWhere('tipo_avion.descripcion', 'like', '%'.$keyword.'%');
        })
        ->addColumn('cod_prov_avion',function($avion){

            if(!empty($avion->getProveedorAvion)){
                return $avion->getProveedorAvion->nombre_propietario1
                        .'<br>'.$avion->getProveedorAvion->nombre_propietario2
                        .'<br>'.$avion->getProveedorAvion->nombre_propietario3;
            }
            else
                return trans('copies.gestion_aviones.avion_propio');
        })
        ->filterColumn('cod_prov_avion', function($query, $keyword) {

            $query->orWhere('proveedor_aviones.nombre_propietario1', 'like', '%'.$keyword.'%')
                ->orWhere('proveedor_aviones.nombre_propietario2', 'like', '%'.$keyword.'%')
                ->orWhere('proveedor_aviones.nombre_propietario3', 'like', '%'.$keyword.'%');
        })
        ->addColumn('activo',function($avion){
            if($avion->activo == 1)
                return "<span class='badge badge-success'>".trans('copies.generales.activo')."</span>";
            else
                return "<span class='badge badge-danger'>".trans('copies.generales.inactivo')."</span>";
        })
        ->addColumn('action',function($avion){
            return '<a href="'.url('aviones/editar/'.$avion->codigo)
                    .'" title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default"><i class="fa fa-edit"></i></a>
                    <a href="'.$avion->codigo
                    .'"title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default eliminarAvion"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['foto', 'cod_prov_avion', 'activo', 'action'])
        ->make(true);
    }
}
