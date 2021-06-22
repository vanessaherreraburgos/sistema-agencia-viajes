<?php

namespace App\Http\Controllers\aviones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Response;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\aviones\TipoAvion;

class TipoAvionController extends Controller
{

    /**
     * Descripción. Reglas de validación para los campos de un tipo de avión.
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
     * Descripción. Reglas de validación para el identificador del tipo de avión.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rulesId = [
        'id'                => 'integer|required',
    ];

    /**
     * Descripción. Muestra la pantalla de listar tipos 
     * de aviones.
     *
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} list_tipo_avion.
     */
    public function index()
    {
        return view('tiposAviones.list_tipo_avion');
    }

    /**
     * Descripción. Muestra la pantalla para crear un nuevo tipo de avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} crear_tipo_avion.
     */
    public function create()
    {
        return view('tiposAviones.crear_tipo_avion');
    }

    /**
     * Descripción. Almacena un nuevo tipo de avión en la base de datos.
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

                $tipoAvion = new TipoAvion();

                if($tipoAvion->create(array_filter($request->all(), 'strlen'))){
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
     * Descripción. Muestra la pantalla para editar un tipo de avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador del tipo de avión.
     * @return {vista} editar_tipo_avion.
     */
    public function edit($id)
    {
        $tipoAvion = TipoAvion::findOrFail($id);

        return view('tiposAviones.editar_tipo_avion', ['tipoAvion' => $tipoAvion]);
    }

    /**
     * Descripción. Actualiza la información de un tipo de avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @param  {String}  $id        identificador del tipo de avión.
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

                if(TipoAvion::findOrFail($id)->update(array_filter($request->all(), 'strlen'))){
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
     * Descripción. Elimina la información de un tipo de avión
     * con sus tarifas.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request}  $request identificador del tipo de avión.
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

                $tipoAvion = TipoAvion::findOrFail($request->id);
                // $tipoAvion->getTarifasTipoVehiculo()->delete();
                $tipoAvion->delete();

                DB::commit();
                return response()->json(array('success' => true),200);
            }
        } catch(\Exception $e) {
            DB::rollback();  
            return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Descripción. Muestra el contenido de la tabla tipos de aviones.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableTiposAviones()
    {
        $tipoAvion = TipoAvion::get();

        return Datatables::of($tipoAvion)
        ->addColumn('descripcion',function($tipoAvion){
            return $tipoAvion->descripcion;
        })
        ->addColumn('cantidad_max_pasajeros',function($tipoAvion){
            return $tipoAvion->cantidad_max_pasajeros;
        })
        ->addColumn('cantidad_ventanas',function($tipoAvion){
            return $tipoAvion->cantidad_ventanas;
        })
        ->addColumn('activo',function($tipoAvion){
            if($tipoAvion->activo == 1)
                return "<span class='badge badge-success'>".trans('copies.generales.activo')."</span>";
            else
                return "<span class='badge badge-danger'>".trans('copies.generales.inactivo')."</span>";
        })
        ->addColumn('action',function($tipoAvion){
            return '<a href="'.url('tipos_aviones/tarifas/'.$tipoAvion->codigo)
                    .'" title="'.trans('copies.generales.boton_gest_tarifas').'" class="btn btn btn-default"><i class="fa fa-money"></i></a>
                    <a href="'.url('tipos_aviones/editar/'.$tipoAvion->codigo)
                    .'" title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default"><i class="fa fa-edit"></i></a>
                    <a href="'.$tipoAvion->codigo
                    .'"title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default eliminarTipoAvion"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['activo', 'action'])
        ->make(true);
    }
}
