<?php

namespace App\Http\Controllers\aviones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\aviones\TipoAvion;
use App\Models\aviones\TarifasTipoAvion;
use App\Models\aviones\ServiciosTarifasTipoAvion;

class TarifasTipoAvionController extends Controller
{
    
    /**
     * Descripción. Reglas de validación para los campos de la tarifa de un 
     * tipo de avión.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rules = [
        'id'                => 'numeric|nullable',
        'codigo'            => 'numeric|nullable',
        'cod_tipo_avion'    => 'required|numeric',
        'cod_pais'          => 'required|numeric',
        'cod_estado'        => 'required|numeric',
        'cod_ciudad'        => 'required|numeric',
        'cod_destino'       => 'required|numeric',
        'cod_serv_tipo_avion'=> 'required|numeric',
        'fecha_inicial'     => 'required|date_format:d/m/Y',
        'fecha_final'       => 'required|date_format:d/m/Y|after_or_equal:fecha_inicial',
        'precio_usd'        => 'required|numeric',
    ];

    /**
     * Descripción. Reglas de validación para el identificador de un 
     * tipo de avión.
     * @author Johan Alejandro Aguirre Escobar
     */
    protected $rulesId = [
        'id'                => 'numeric|required',
    ];

    /**
     * Descripción. Muestra la pantalla de listar tarifas de un tipo 
     * de avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @return {vista} tarifas_tipo_avion.
     */
    public function index($id)
    {
        $tipoAvion = TipoAvion::find($id);
        $serviciosTipoAvion = ServiciosTarifasTipoAvion::arrayServiciosTipoAvion();

        return view('tiposAviones.tarifas_tipo_avion', ['tipoAvion' => $tipoAvion,
                                                            'serviciosTipoAvion' => $serviciosTipoAvion]);
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
     * avión en la base de datos.
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
            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);

            /* Se agrega nuevo elemento a request el cual solo servira
            para usar la función personalizada de laravel llamada tarifa.*/
            $request['tarifa_validar'] =  null;
            
            // validación personalizada de una nueva tarifa para un  tipo de vehiculo.
            $this->rules['tarifa_validar'] = 'tarifa:tarifas_tipo_avion,fecha_inicial,'.$request->fecha_inicial.',fecha_final,'.$request->fecha_final.',null,null,cod_destino,'.$request->cod_destino.',cod_serv_tipo_avion,'.$request->cod_serv_tipo_avion.',cod_tipo_avion,'.$request->cod_tipo_avion;

            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $tarifasTipoAvion = new TarifasTipoAvion();

                if($tarifasTipoAvion->create(array_filter($request->all(), 'strlen'))){
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
     * tipo de avión a editar.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador de la tarifa del 
     *                              tipo de avión.
     * @return {json} tarifaAvion.
     */
    public function edit($id)
    {
        $validator = Validator::make( ['id' => $id], $this->rulesId);

        if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
        else{
            $tarifasTipoAvion = TarifasTipoAvion::findOrFail($id);
            return response()->json($tarifasTipoAvion, 200);
        }
    }

    /**
     * Descripción. Actualiza la información de la tarifa de un 
     * tipo de avión.
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
            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);

            /* Se agrega nuevo elemento a request el cual solo servira
            para usar la función personalizada de laravel llamada tarifa.*/
            $request['tarifa_validar'] =  null;
            
            // validación personalizada de una nueva tarifa para un  tipo de vehiculo.
            $this->rules['tarifa_validar'] = 'tarifa:tarifas_tipo_avion,fecha_inicial,'.$request->fecha_inicial.',fecha_final,'.$request->fecha_final.',codigo,'.$request->codigo.',cod_destino,'.$request->cod_destino.',cod_serv_tipo_avion,'.$request->cod_serv_tipo_avion.',cod_tipo_avion,'.$request->cod_tipo_avion;

            $validator = Validator::make( $request->all(), $this->rules);

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{

                $tarifaTipoAvion = TarifasTipoAvion::findOrFail($request->codigo);

                if($tarifaTipoAvion->update($request->all())){
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
     * tipo de avión.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $request->id   identificador de la tarifa 
     *                                  del tipo de avión.
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

                $tarifaTipoAvion = TarifasTipoAvion::findOrFail($request->id);

                if($tarifaTipoAvion->delete()){
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
     * de avión en especifico.
     * @author Johan Alejandro Aguirre Escobar
     *
     * @param  {String}  $id        identificador del tipo de avión.
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableTarifasTipoAvion($id)
    {
        $tarifasTipoAvion = TarifasTipoAvion::where('cod_tipo_avion', $id)->get();

        return Datatables::of($tarifasTipoAvion)
        ->addColumn('fecha_inicial',function($tarifasTipoAvion){
            return trans('copies.generales.desde').': '.$tarifasTipoAvion->fecha_inicial
            .'<br>'.trans('copies.generales.hasta').': '.$tarifasTipoAvion->fecha_final;
        })
        ->addColumn('cod_destino',function($tarifasTipoAvion){
            return $tarifasTipoAvion->getDestino->descripcion
                    .'<br>'.$tarifasTipoAvion->getCiudad->nombre
                    .' - '.$tarifasTipoAvion->getEstado->nombre
                    .' - '.$tarifasTipoAvion->getPais->nombre;
        })
        ->addColumn('cod_serv_tipo_avion',function($tarifasTipoAvion){
            return $tarifasTipoAvion->getServiciosTarifasTipoAvion->descripcion;
        })
        ->addColumn('precio_usd',function($tarifasTipoAvion){
            return $tarifasTipoAvion->precio_usd;
        })
        ->addColumn('action',function($tarifasTipoAvion){

            return '<a href="'.url('tipos_aviones/tarifas/editar/'.$tarifasTipoAvion->codigo)
                    .'" title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default editarTarifaTipoAvion" data-style="zoom-in" data-spinner-color="#000"><i class="fa fa-edit"></i></a> 
                    <a href="'.$tarifasTipoAvion->codigo
                    .'" title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default eliminarTarifaTipoAvion"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['fecha_inicial','cod_destino','action'])
        ->make(true);
    }
}
