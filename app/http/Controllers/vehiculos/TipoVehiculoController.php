<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Response;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Models\vehiculos\TipoVehiculo;

class TipoVehiculoController extends Controller
{

    /**
     * Descripción. Reglas de validación para los campos de un tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rules = [
        'id'                        => 'integer|nullable',
        'descripcion'               => 'alfa_num_espacio',
        'cantidad_max_pasajeros'    => 'integer',
        'cantidad_ventanas'         => 'integer',
        'activo'                    => 'boolean|nullable',
    ];

    /**
     * Descripción. Reglas de validación para el identificador del tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rulesId = [
        'id'                => 'integer|required',
    ];

    /**
     * Descripción. Muestra la pantalla de listar tipos 
     * de vehículos.
     *
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} list_vehiculo.
     */
    public function index()
    {
        return view('tiposVehiculos.list_tipo_vehiculo');
    }

    /**
     * Descripción. Muestra la pantalla para crear un nuevo tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} crear_tipo_vehiculo.
     */
    public function create()
    {
        return view('tiposVehiculos.crear_tipo_vehiculo');
    }

    /**
     * Descripción. Almacena un nuevo tipo de vehículo en la base de datos.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $tipoVehiculo = new TipoVehiculo();

                if($tipoVehiculo->create(array_filter($request->all(), 'strlen'))){
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
     * Descripción. Muestra la pantalla para editar un tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador del tipo de vehiculo.
     * @return {vista} editar_tipo_vehiculo.
     */
    public function edit($id)
    {
        $tipoVehiculo = TipoVehiculo::findOrFail($id);

        return view('tiposVehiculos.editar_tipo_vehiculo', ['tipoVehiculo' => $tipoVehiculo]);
    }

    /**
     * Descripción. Actualiza la información de un tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @param  {String}  $id        identificador del tipo vehículo.
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

                if(TipoVehiculo::findOrFail($id)->update(array_filter($request->all(), 'strlen'))){
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
     * Descripción. Elimina la información de un tipo de vehículo
     * con sus tarifas.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request}  $request identificador del tipo de vehículo.
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

                $tipoVehiculo = TipoVehiculo::findOrFail($request->id);
                // $tipoVehiculo->getTarifasTipoVehiculo()->delete();
                $tipoVehiculo->delete();

                DB::commit();
                return response()->json(array('success' => true),200);
            }
        } catch(\Exception $e) {
            DB::rollback();  
            return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Descripción. Muestra el contenido de la tabla tipos de vehículos.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableTiposVehiculos()
    {
        $tipoVehiculo = TipoVehiculo::get();

        return Datatables::of($tipoVehiculo)
        ->addColumn('descripcion',function($tipoVehiculo){
            return $tipoVehiculo->descripcion;
        })
        ->addColumn('cantidad_max_pasajeros',function($tipoVehiculo){
            return $tipoVehiculo->cantidad_max_pasajeros;
        })
        ->addColumn('cantidad_ventanas',function($tipoVehiculo){
            return $tipoVehiculo->cantidad_ventanas;
        })
        ->addColumn('activo',function($tipoVehiculo){
            if($tipoVehiculo->activo == 1)
                return "<span class='badge badge-success'>".trans('copies.generales.activo')."</span>";
            else
                return "<span class='badge badge-danger'>".trans('copies.generales.inactivo')."</span>";
        })
        ->addColumn('action',function($tipoVehiculo){
            return '<a href="'.url('tipos_vehiculos/tarifas/'.$tipoVehiculo->codigo)
                    .'" title="'.trans('copies.generales.boton_gest_tarifas').'" class="btn btn btn-default"><i class="fa fa-money"></i></a>
                    <a href="'.url('tipos_vehiculos/editar/'.$tipoVehiculo->codigo)
                    .'" title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default"><i class="fa fa-edit"></i></a>
                    <a href="'.$tipoVehiculo->codigo
                    .'"title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default eliminarTipoVehiculo"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['activo', 'action'])
        ->make(true);
    }

}
