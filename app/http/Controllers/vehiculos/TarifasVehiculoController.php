<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\vehiculos\Vehiculo;
use App\Models\vehiculos\TarifasVehiculo;

class TarifasVehiculoController extends Controller
{

    /**
     * Descripción. Reglas de validación para los campos de la tarifa de un vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rules = [
        'id'                => 'numeric|nullable',
        'codigo'            => 'numeric|nullable',
        'destino'           => 'numeric',
        'fecha_inicial'     => 'required|date_format:d/m/Y',
        'fecha_final'       => 'required|date_format:d/m/Y|after_or_equal:fecha_inicial',
        'precio_usd'        => 'required|numeric',
    ];

    /**
     * Descripción. Reglas de validación para el identificador de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rulesId = [
        'id'                => 'numeric|required',
    ];

    /**
     * Descripción. Muestra la pantalla de listar tarifas de un vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} tarifas.
     */
    public function index($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('vehiculos.tarifas', ['vehiculo' => $vehiculo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Descripción. Almacena una nueva tarifa de vehículo en la base de datos.
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

                $tarifaVehiculo = new TarifasVehiculo();

                if($tarifaVehiculo->create(array_merge($request->all(), ['cod_vehiculo' => $request->id]))){
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
     * Descripción. Muestra la información de la tarifa del vehículo a editar.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador de la tarifa del vehiculo.
     * @return {json} tarifaVehiculo.
     */
    public function edit($id)
    {

        $validator = Validator::make( ['id' => $id], $this->rulesId);

        if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
        else{
            $tarifaVehiculo = TarifasVehiculo::findOrFail($id);
            return response()->json($tarifaVehiculo, 200);
        }
    }

    /**
     * Descripción. Actualiza la información de la tarifa de un vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $tarifaVehiculo = TarifasVehiculo::findOrFail($request->codigo);

                if($tarifaVehiculo->update($request->all())){
                    DB::commit();
                    return response()->json(array('success' => true),200);
                }
                else{
                    DB::rollback();
                    return response()->json(array('success' => false), 200);
                }
            }
        } catch(\Exception $e) {

            DB::rollback();              return response()->json(array('success' => 'error'), 200);
        }
    }

    /**
     * Descripción. Elimina la información de la tarifa de un vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador de la tarifa del vehiculo.
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

                $tarifaVehiculo = TarifasVehiculo::findOrFail($request->id);

                if($tarifaVehiculo->delete()){
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
     * Descripción. Muestra el contenido de la tabla tarifas de un vehículo en especifico.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador del vehículo.
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableTarifasVehiculo($id)
    {
        $tarifasVehiculo = TarifasVehiculo::where('cod_vehiculo', $id)->get();

        return Datatables::of($tarifasVehiculo)
        ->addColumn('fecha_inicial',function($tarifasVehiculo){
            return $tarifasVehiculo->fecha_inicial;
        })
        ->addColumn('fecha_final',function($tarifasVehiculo){
            return $tarifasVehiculo->fecha_final;
        })
        ->addColumn('cod_destino',function($tarifasVehiculo){
            return $tarifasVehiculo->cod_destino;
        })
        ->addColumn('precio_usd',function($tarifasVehiculo){
            return $tarifasVehiculo->precio_usd;
        })
        ->addColumn('action',function($tarifasVehiculo){

            return '<a href="'.url('vehiculos/tarifas/editar/'.$tarifasVehiculo->codigo)
                    .'" title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default editarTarifaVehiculo" data-style="zoom-in" data-spinner-color="#000"><i class="fa fa-edit"></i></a> 
                    <a href="'.$tarifasVehiculo->codigo
                    .'" title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default eliminarTarifaVehiculo"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
