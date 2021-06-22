<?php

namespace App\Http\Controllers\proveedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\proveedores\Proveedores;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Facades\Datatables;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proveedores.list_proveedores', array('nombre' => 'Javi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$tipo_cliente = TipoCliente::pluck( 'descripcion', 'codigo');
        //$tipo_documento = TipoDocumento::pluck('nombre', 'codigo');
        //$destinos = Destino::pluck('descripcion', 'codigo'); 

        $obj = null;

        if (isset($request->id)){
            $obj = Proveedores::find($request->id);
        }
        else {

            $obj = new Proveedores();
        }
        //return view('proveedores.crear_proveedores', array('tipo_cliente' => $tipo_cliente, 'tipo_documento'=>$tipo_documento, 'cliente'=>$obj , 'destinos'=>$destinos));

        return view('proveedores.crear_proveedores', array('proveedor'=>$obj));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        DB::beginTransaction();

        try {

            $validator = Validator::make( $request->all(),
                [
                    'telefono'                  => 'integer',
                    'email'                     => 'char',                    
                ]
            );

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{
                if (isset($request->codigo)){
                    $prov = Proveedores::find($request->codigo);
                    //$foto_cliente = FotosCliente::where('cod_cliente',$request->codigo)->get();
                    $flag_editar = true;

                    if($prov->update($request->all()))
                    {                                              
                        DB::commit();
                        return response()->json(array('success' => true),200);
                    }
                    else{
                        DB::rollback();
                        return response()->json(array('success' => false), 200);
                    }
                }
                else {
                    $prov = new Proveedores();
                    if($prov = Proveedores::create($request->all()))
                    {                     
                        DB::commit();
                        return response()->json(array('success' => true),200);
                    }
                    else{
                        DB::rollback();
                        return response()->json(array('success' => false), 200);
                    }
                }                   
            }
        } catch(\Exception $e) {
            return $e;
            DB::rollback();
            return response()->json(array('success' => false, 'exception' => $e), 200);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $obj = Proveedores::find($request->id);        
        //dd($cliente);
        //$tipo_cliente = TipoCliente::pluck( 'descripcion', 'codigo');
        //$tipo_documento = TipoDocumento::pluck('nombre', 'codigo');        
        //$destinos = Destino::pluck('descripcion', 'codigo');         

        return view('proveedores.editar_proveedores', array('proveedor'=>$obj));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $obj = Proveedores::find($request->id);

        if ($obj){
            DB::beginTransaction();
            //validar tablas referenciadas por este destino
            // tarifas_aviones
            // tarifas_chofer
            // tarifas_guia
            // tarifas_vehiculos

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

    /**
     * Descripción. Muestra el contenido de la tabla ProveedorVehiculos.
     * @author Franklin
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableProveedor()
    {
        $proveedor = Proveedores::get();

        return Datatables::of($proveedor)
        
        ->addColumn('codigo',function($proveedor){            
            return $proveedor->codigo;
        })
        ->addColumn('razon_social',function($proveedor){            
            return $proveedor->razon_social;
        })
        ->addColumn('nombre',function($proveedor){
            return $proveedor->nombre_propietario1;
        })
        ->addColumn('telefono',function($proveedor){
            return $proveedor->telefono_propietario1;
        })
        ->addColumn('email',function($proveedor){
            return $proveedor->email_propietario1;
        })
        ->addColumn('action',function($proveedor){
            return 
            '<a title="'.trans('copies.generales.boton_editar').'" class="btn btn-link" href="editar/'.$proveedor->codigo.'"><i class="fa fa-edit"></i></a>        
            <a title="'.trans('copies.generales.boton_eliminar').'" class="btn btn-link" href="#" onClick="eliminar_registro(\'proveedores/eliminar\','.$proveedor->codigo.',\'#tablaListaProveedores\')"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
