<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\vehiculos\TipoVehiculo;
use App\Models\vehiculos\TarifasTipoVehiculo;
use App\Models\vehiculos\ServiciosTarifasTipoVehiculo;

class TarifasTipoVehiculoController extends Controller
{
    /**
     * Descripción. Reglas de validación para los campos de la tarifa de un 
     * tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rules = [
        'id'                => 'numeric|nullable',
        'codigo'            => 'numeric|nullable',
        'cod_tipo_vehiculo' => 'required|numeric',
        'cod_pais'          => 'required|numeric',
        'cod_estado'        => 'required|numeric',
        'cod_ciudad'        => 'required|numeric',
        'cod_destino'       => 'required|numeric',
        'cod_serv_tipo_veh' => 'required|numeric',
        'fecha_inicial'     => 'required|date_format:d/m/Y',
        'fecha_final'       => 'required|date_format:d/m/Y|after_or_equal:fecha_inicial',
        'precio_usd'        => 'required|numeric',
    ];

    /**
     * Descripción. Mensajes personalizados de validación.
     * @author Johan Alejandro Aguirre Escobar
     */
    public function __construct()
    {
        $this->mensajesErrorPersonalizados = [
            'cod_pais.required'          => trans('copies.validacion.pais_required'),
            'cod_estado.required'        => trans('copies.validacion.estado_required'),
            'cod_ciudad.required'        => trans('copies.validacion.ciudad_required'),
            'cod_destino.required'       => trans('copies.validacion.destino_required'),
            'cod_serv_tipo_veh.required' => trans('copies.validacion.servicio_required'),
            'tarifa_validar.tarifa'      => trans('copies.validacion.tarifa_tipo_veh_existe'),
        ];
    }

    /**
     * Descripción. Reglas de validación para el identificador de un 
     * tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rulesId = [
        'id'                => 'numeric|required',
    ];

    /**
     * Descripción. Muestra la pantalla de listar tarifas de un tipo 
     * de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} tarifas_tipo_vehiculo.
     */
    public function index($id)
    {
        $tipoVehiculo = TipoVehiculo::find($id);
        $serviciosTipoVehiculo = ServiciosTarifasTipoVehiculo::arrayServiciosTipoVehiculo();

        return view('tiposVehiculos.tarifas_tipo_vehiculo', ['tipoVehiculo' => $tipoVehiculo, 
                                                                'serviciosTipoVehiculo' => $serviciosTipoVehiculo]);
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
     * Descripción. Almacena una nueva tarifa de un tipo de 
     * vehículo en la base de datos.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            /* Se valida que los valores enviados a la validación personalizada
            de tarifa sean correctos*/
            $validator = Validator::make( $request->all(), $this->rules, $this->mensajesErrorPersonalizados);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);

            /* Se agrega nuevo elemento a request el cual solo servira
            para usar la función personalizada de laravel llamada tarifa.*/
            $request['tarifa_validar'] =  null;
            
            // validación personalizada de una nueva tarifa para un  tipo de vehiculo.
            $this->rules['tarifa_validar'] = 'tarifa:tarifas_tipo_vehiculo,fecha_inicial,'.$request->fecha_inicial.',fecha_final,'.$request->fecha_final.',null,null,cod_destino,'.$request->cod_destino.',cod_serv_tipo_veh,'.$request->cod_serv_tipo_veh.',cod_tipo_vehiculo,'.$request->cod_tipo_vehiculo;

            $validator = Validator::make( $request->all(), $this->rules, $this->mensajesErrorPersonalizados);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $tarifasTipoVehiculo = new TarifasTipoVehiculo();

                if($tarifasTipoVehiculo->create(array_filter($request->all(), 'strlen'))){
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
     * Descripción. Muestra la información de la tarifa de un 
     * tipo vehículo a editar.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador de la tarifa del 
     *                              tipo de vehiculo.
     * @return {json} tarifaVehiculo.
     */
    public function edit($id)
    {
        $validator = Validator::make( ['id' => $id], $this->rulesId);

        if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
        else{
            $tarifasTipoVehiculo = TarifasTipoVehiculo::findOrFail($id);
            return response()->json($tarifasTipoVehiculo, 200);
        }
    }

    /**
     * Descripción. Actualiza la información de la tarifa de un 
     * tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {Request} $request   valores del formulario.
     * @return {Json} indicando si la operación fue exitosa o no.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            /* Se valida que los valores enviados a la validación personalizada
            de tarifa sean correctos*/
            $validator = Validator::make( $request->all(), $this->rules, $this->mensajesErrorPersonalizados);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);

            /* Se agrega nuevo elemento a request el cual solo servira
            para usar la función personalizada de laravel llamada tarifa.*/
            $request['tarifa_validar'] =  null;
            
            // validación personalizada de una nueva tarifa para un  tipo de vehiculo.
            $this->rules['tarifa_validar'] = 'tarifa:tarifas_tipo_vehiculo,fecha_inicial,'.$request->fecha_inicial.',fecha_final,'.$request->fecha_final.',codigo,'.$request->codigo.',cod_destino,'.$request->cod_destino.',cod_serv_tipo_veh,'.$request->cod_serv_tipo_veh.',cod_tipo_vehiculo,'.$request->cod_tipo_vehiculo;

            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $tarifasTipoVehiculo = TarifasTipoVehiculo::findOrFail($request->codigo);

                if($tarifasTipoVehiculo->update($request->all())){
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
     * Descripción. Elimina la información de la tarifa de un 
     * tipo de vehículo.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $request->id   identificador de la tarifa 
     *                                  del tipo de vehiculo.
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

                $tarifasTipoVehiculo = TarifasTipoVehiculo::findOrFail($request->id);

                if($tarifasTipoVehiculo->delete()){
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
     * Descripción. Muestra el contenido de la tabla tarifas de un tipo 
     * de vehículo en especifico.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador del tipo de vehículo.
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableTarifasTipoVehiculo($id)
    {
        $tarifasTipoVehiculo = TarifasTipoVehiculo::where('cod_tipo_vehiculo', $id)->get();

        return Datatables::of($tarifasTipoVehiculo)
        ->addColumn('fechas',function($tarifasTipoVehiculo){
            return trans('copies.generales.desde').': '.$tarifasTipoVehiculo->fecha_inicial
            .'<br>'.trans('copies.generales.hasta').': '.$tarifasTipoVehiculo->fecha_final;
        })
        ->addColumn('cod_destino',function($tarifasTipoVehiculo){
            return $tarifasTipoVehiculo->getDestino->descripcion
                    .'<br>'.$tarifasTipoVehiculo->getCiudad->nombre
                    .' - '.$tarifasTipoVehiculo->getEstado->nombre
                    .' - '.$tarifasTipoVehiculo->getPais->nombre;
        })
        ->addColumn('cod_serv_tipo_veh',function($tarifasTipoVehiculo){
            return $tarifasTipoVehiculo->getServiciosTarifasTipoVehiculo->descripcion;
        })
        ->addColumn('precio_usd',function($tarifasTipoVehiculo){
            return $tarifasTipoVehiculo->precio_usd;
        })
        ->addColumn('action',function($tarifasTipoVehiculo){

            return '<a href="'.url('tipos_vehiculos/tarifas/editar/'.$tarifasTipoVehiculo->codigo)
                    .'" title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default editarTarifaTipoVehiculo" data-style="zoom-in" data-spinner-color="#000"><i class="fa fa-edit"></i></a> 
                    <a href="'.$tarifasTipoVehiculo->codigo
                    .'" title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default eliminarTarifaTipoVehiculo"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['fechas','cod_destino','action'])
        ->make(true);
    }
}
