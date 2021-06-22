<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Response;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Storage;
use App\Models\vehiculos\Vehiculo;
use App\Models\vehiculos\ProveedorVehiculo;
use App\Models\vehiculos\TipoVehiculo;

class VehiculosController extends Controller
{

    /**
     * Descripción. Reglas de validación para los campos de un vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rules = [
        'id'                        => 'integer|nullable',
        'foto_vehiculo'             => 'image',
        // 'placa'                     => 'alfa_num_espacio|unique:vehiculo,placa',
        // 'numero'                    => 'integer|unique:vehiculo,numero',
        'anno_vehiculo'             => 'integer',
        'modelo'                    => 'required|texto',
        'marca'                     => 'required|texto',
        'color'                     => 'texto',
        'cod_tipo_vehiculo'         => 'integer|nullable',
        'es_propio'                 => 'required|boolean',
        'cod_proveedor_vehiculo'    => 'integer|nullable',
        'activo'                    => 'boolean|nullable',
    ];

    /**
     * Descripción. Reglas de validación para el identificador de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rulesId = [
        'id'                => 'integer|required',
    ];

    /**
     * Descripción. Mensajes personalizados de validación.
     * @author Johan Alejandro Aguirre Escobar
     */
    public function __construct()
    {
        $this->mensajesErrorPersonalizados = [
            'placa.unique'   => trans('copies.validacion.placa_unique'),
            'numero.unique'  => trans('copies.validacion.numero_unique'),
        ];
    }

    /**
     * Descripción. Muestra la pantalla de listar vehículos.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} list_vehiculo.
     */
    public function index()
    {
        return view('vehiculos.list_vehiculo');
    }

    /**
     * Descripción. Muestra la pantalla para crear un nuevo vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} crear_vehiculo.
     */
    public function create()
    {
        $tiposVehiculo       = TipoVehiculo::arrayTiposVehiculosActivos();
        $proveedoresVehiculo = ProveedorVehiculo::arrayProveedoresVehiculos();

        return view('vehiculos.crear_vehiculo', ['tiposVehiculo' => $tiposVehiculo,
                                                    'proveedoresVehiculo' => $proveedoresVehiculo]);
    }

    /**
     * Descripción. Almacena un nuevo vehículo en la base de datos.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            /* se adicionan a las reglas de validación de placa y numero de vehículo a las 
            reglas de validación para el caso de la creación. */
            $reglasCrearVehiculo = [
                'placa'                     => 'alfa_num_espacio|unique:vehiculo,placa',
                'numero'                    => 'integer|unique:vehiculo,numero',
            ];

            $reglasValidacion = array_merge($this->rules, $reglasCrearVehiculo);

            $validator = Validator::make( $request->all(), $reglasValidacion, $this->mensajesErrorPersonalizados);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $vehiculo = new Vehiculo();

                $fotoVehiculo = $request->file('foto_vehiculo');
                if (file_exists($fotoVehiculo)){
                    $fotoVehiculo->store(Config::get('constants.RUTA_FOTO_VEHICULO'), 'uploads');
                    $request['foto'] = $fotoVehiculo->hashName();
                }

                if($vehiculo->create(array_filter($request->all(), 'strlen'))){
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
     * Descripción. Muestra la pantalla de editar vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador del vehiculo.
     * @return {vista} editar_vehiculo.
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $tiposVehiculo       = TipoVehiculo::arrayTiposVehiculosActivos();
        $proveedoresVehiculo = ProveedorVehiculo::arrayProveedoresVehiculos();

        return view('vehiculos.editar_vehiculo', ['vehiculo' => $vehiculo,
                                                    'tiposVehiculo' => $tiposVehiculo,
                                                    'proveedoresVehiculo' => $proveedoresVehiculo]);
    }

    /**
     * Descripción. Actualiza la información de un vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @param  {String}  $id        identificador del vehículo.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            /* Se valida si el id del vehículo cumple con las reglas de validación 
            para poder validar posteriormente los campos unique de forma adecuada.*/
            $validatorId = Validator::make( ['id' => $id], $this->rulesId);

            if($validatorId->fails())
                return response()->json(array('errors' => $validatorId->messages()),200);

            $vehiculo = Vehiculo::findOrFail($id);

            /* se adicionan a las reglas de validación de placa y numero de vehículo a las 
            reglas de validación para el caso de la edición. */
            $reglasEditarVehiculo = [
                'placa'                     => 'alfa_num_espacio|unique:vehiculo,placa,'.$vehiculo->placa.',placa',
                'numero'                    => 'integer|unique:vehiculo,numero,'.$vehiculo->numero.',numero',
            ];

            $reglasValidacion = array_merge($this->rules, $reglasEditarVehiculo);

            $validator = Validator::make( $request->all(), $reglasValidacion, $this->mensajesErrorPersonalizados);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $fotoVehiculo = $request->file('foto_vehiculo');
                if (file_exists($fotoVehiculo)){
                    $fotoVehiculo->store(Config::get('constants.RUTA_FOTO_VEHICULO'), 'uploads');
                    $request['foto'] = $fotoVehiculo->hashName();
                }

                if($vehiculo->update(array_filter($request->all(), 'strlen'))){
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
            return $e;
            return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Descripción. Elimina la información de un vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request}  $request identificador del vehículo.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction(); 

        try {

            $validator = Validator::make( ['id' => $request->id], $this->rulesId);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $vehiculo = Vehiculo::findOrFail($request->id);
                $nombreFoto = $vehiculo->foto;

                $vehiculo->delete();

                DB::commit();

                // se elimina la foto si el registro se elimino exitosamente.
                if(!empty($nombreFoto))
                    Storage::disk('uploads')->delete(Config::get('constants.RUTA_FOTO_VEHICULO').$nombreFoto);

                return response()->json(array('success' => true),200);
            }
        } catch(\Exception $e) {
            DB::rollback();  
            return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Descripción. Muestra el contenido de la tabla vehículos.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableVehiculos()
    {
        // $vehiculo = Vehiculo::get();
        $vehiculo = Vehiculo::join('tipo_vehiculo', 'vehiculo.cod_tipo_vehiculo', '=', 'tipo_vehiculo.codigo')
            ->leftJoin('proveedor_vehiculo', 'vehiculo.cod_proveedor_vehiculo', '=', 'proveedor_vehiculo.codigo')
            ->select([
            'vehiculo.*',
            DB::raw("CONCAT(vehiculo.modelo,'<br>',vehiculo.marca,'<br>',vehiculo.anno_vehiculo,'<br>',vehiculo.color) as especificaciones"),
        ]);

        return Datatables::of($vehiculo)
        ->editColumn('foto',function($vehiculo){

            $rutaFotoVehiculo = $vehiculo->ruta_foto ? $vehiculo->ruta_foto : asset(Config::get('constants.RUTA_FOTO_VEHICULO_DEF'));
            return "<img alt='image' class='img-circle img-md center-block' src='".$rutaFotoVehiculo."'>";
        })
        ->editColumn('especificaciones',function($vehiculo){
            return trans('copies.gestion_vehiculos.placa').': '.strtoupper($vehiculo->placa)
                    .'<br>'.trans('copies.gestion_vehiculos.modelo').': '.ucfirst($vehiculo->modelo)
                    .'<br>'.trans('copies.gestion_vehiculos.marca').': '.ucfirst($vehiculo->marca)
                    .'<br>'.trans('copies.gestion_vehiculos.anno_vehiculo').': '.$vehiculo->anno_vehiculo
                    .'<br>'.trans('copies.gestion_vehiculos.color').': '.ucfirst($vehiculo->color);
        })
        ->filterColumn('especificaciones', function($query, $keyword) {
            $query->orWhere('placa', 'like', '%'.$keyword.'%')
                    ->orWhere('modelo', 'like', '%'.$keyword.'%')
                    ->orWhere('marca', 'like', '%'.$keyword.'%')
                    ->orWhere('anno_vehiculo', 'like', '%'.$keyword.'%')
                    ->orWhere('color', 'like', '%'.$keyword.'%');
        })
        ->editColumn('cod_tipo_vehiculo',function($vehiculo){
            return $vehiculo->getTipoVehiculo->descripcion;
        })
        ->filterColumn('cod_tipo_vehiculo', function($query, $keyword) {

            $query->orWhere('tipo_vehiculo.descripcion', 'like', '%'.$keyword.'%');
        })
        ->editColumn('cod_proveedor_vehiculo',function($vehiculo){

            if(!empty($vehiculo->getProveedorVehiculo)){
                return $vehiculo->getProveedorVehiculo->nombre_propietario1
                        .'<br>'.$vehiculo->getProveedorVehiculo->nombre_propietario2
                        .'<br>'.$vehiculo->getProveedorVehiculo->nombre_propietario3;
            }
            else
                return trans('copies.gestion_vehiculos.vehiculo_propio');
        })
        ->filterColumn('cod_proveedor_vehiculo', function($query, $keyword) {

            $query->orWhere('proveedor_vehiculo.nombre_propietario1', 'like', '%'.$keyword.'%')
                ->orWhere('proveedor_vehiculo.nombre_propietario2', 'like', '%'.$keyword.'%')
                ->orWhere('proveedor_vehiculo.nombre_propietario3', 'like', '%'.$keyword.'%');
        })
        ->editColumn('activo',function($vehiculo){
            if($vehiculo->activo == 1)
                return "<span class='badge badge-success'>".trans('copies.generales.activo')."</span>";
            else
                return "<span class='badge badge-danger'>".trans('copies.generales.inactivo')."</span>";
        })
        ->addColumn('action',function($vehiculo){
            return '<a href="'.url('vehiculos/editar/'.$vehiculo->codigo)
                    .'" title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default"><i class="fa fa-edit"></i></a>
                    <a href="'.$vehiculo->codigo
                    .'"title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default eliminarVehiculo"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['foto', 'especificaciones', 'cod_proveedor_vehiculo', 'activo', 'action'])
        ->make(true);
    }

    public function listTipoVehiculos(){
      return TipoVehiculo::orderBy('descripcion')->get();
    }

}
