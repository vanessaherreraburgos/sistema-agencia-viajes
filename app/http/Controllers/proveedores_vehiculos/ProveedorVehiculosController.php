<?php

namespace App\Http\Controllers\proveedores_vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clientes\proveedores_vehiculos;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Facades\Datatables;

class ProveedorVehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proveedores_vehiculos.list_proveedores_vehiculos', array('nombre' => 'Javi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tipo_cliente = TipoCliente::pluck( 'descripcion', 'codigo');
        $tipo_documento = TipoDocumento::pluck('nombre', 'codigo');
        $destinos = Destino::pluck('descripcion', 'codigo'); 

        $obj = null;

        if (isset($request->id)){
            $obj = Cliente::find($request->id);
        }
        return view('clientes.crear_clientes', array('tipo_cliente' => $tipo_cliente, 'tipo_documento'=>$tipo_documento, 'cliente'=>$obj , 'destinos'=>$destinos));
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
                    'descuento'                 => 'integer',
                    'cod_pais'                  => 'integer',
                    'cod_estado'                  => 'integer',
                    'cod_ciudad'                  => 'integer',
                ]
            );

            if($validator->fails())
                return response()->json(array('errors' => $validator->messages()),200);
            else{
                if (isset($request->codigo)){
                    $cliente = Cliente::find($request->codigo);
                    $foto_cliente = FotosCliente::where('cod_cliente',$request->codigo)->get();
                    $flag_editar = true;

                    if($cliente->update($request->all())){

                        //guardar datos fotos
                        if (!is_null($request->file('foto'))) { //  Si está cargando una foto haga:
                            $array_foto = $request->file('foto'); // recupera la imagen                            
                            
                            foreach ($foto_cliente as $key => $value) {
                                eliminarArchivo(Config::get('constants.RUTA_FOTOS_CLIENTE').$value->archivo);
                                $obj = FotosCliente::find($value->codigo);
                                $obj->delete();
                            }                            
                            
                            for($i=0; $i< count($array_foto); $i++){  

                                $new_foto_cliente =   new FotosCliente; 
                                $ext = $array_foto[$i]->getClientOriginalExtension(); // recupera la extensión del archivo                    
                                $nombre_foto = 'cliente_d'.$cliente->codigo.'_'.$i.'.'.$ext; // Genera un nombre del archivo
                                $ruta_foto = Config::get('constants.RUTA_FOTOS_CLIENTE').$nombre_foto; // ruta donde se almacenará la imagen de firma digital.
                                file_put_contents($ruta_foto,  File::get($array_foto[$i])); // Función para subir la imagen
                                $new_foto_cliente->archivo = $nombre_foto;
                                $new_foto_cliente->cod_cliente = $cliente->codigo;
                                if (!$new_foto_cliente->save()){
                                    DB::rollback();
                                    $respuesta  =   array('error' => false);
                                    $codigo     =   500;
                                    return response()->json($respuesta, $codigo);
                                }
                            }                                   
                        }
                        // guardar destinos seleccionados
                        if (!is_null($request->cod_destino)) { //  Si está cargando una foto haga:
                            $array_destinos = $request->cod_destino;
                            //return $array_destinos;

                            $obj = DestinoCliente::where('cod_cliente', $cliente->codigo)->delete();
                            
                            foreach ($array_destinos as $key => $value) {
                                if ($value != ""){                                
                                    $nuevo = new DestinoCliente;
                                    $nuevo->cod_destino = intval($value);                                    
                                    $nuevo->cod_cliente = $cliente->codigo;
                                    $nuevo->save();   
                                }                             
                            }
                        }

                        DB::commit();
                        return response()->json(array('success' => true),200);
                    }
                    else{
                        DB::rollback();
                        return response()->json(array('success' => false), 200);
                    }
                }
                else {
                    $cliente = new Cliente();
                    if($cliente = Cliente::create($request->all())){
                        
                        //$cliente = Cliente::orderby('created_at','DESC')->first();
                        //return dd( $cliente->codigo);

                        //guardar datos fotos
                        if (!is_null($request->file('foto'))) { //  Si está cargando una foto haga:
                            $array_foto = $request->file('foto'); // recupera la imagen                                                       
                            
                            for($i=0; $i< count($array_foto); $i++){
                                $new_foto_cliente =   new FotosCliente; 
                                $ext = $array_foto[$i]->getClientOriginalExtension(); // recupera la extensión del archivo                    
                                $nombre_foto = 'cliente_d'.$cliente->codigo.'_'.$i.'.'.$ext; // Genera un nombre del archivo
                                $ruta_foto = Config::get('constants.RUTA_FOTOS_CLIENTE').$nombre_foto; // ruta donde se almacenará la imagen de firma digital.
                                file_put_contents($ruta_foto,  File::get($array_foto[$i])); // Función para subir la imagen
                                $new_foto_cliente->archivo = $nombre_foto;
                                $new_foto_cliente->cod_cliente = $cliente->codigo;
                                if (!$new_foto_cliente->save()){
                                    DB::rollback();
                                    $respuesta  =   array('error' => false);
                                    $codigo     =   500;
                                    return response()->json($respuesta, $codigo);
                                }
                            }                                   
                        }
                        // guardar destinos seleccionados
                        if (!is_null($request->cod_destino)) { //  Si está cargando una foto haga:
                            $array_destinos = $request->cod_destino;
                            //return $array_destinos;
                            //return $cliente->codigo;

                            foreach ($array_destinos as $key => $value) {
                                if ($value != ""){                                
                                    $nuevo = new DestinoCliente;
                                    $nuevo->cod_destino = intval($value);                                    
                                    $nuevo->cod_cliente = $cliente->codigo;
                                    $nuevo->save();   
                                }                             
                            }
                        }
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
        $cliente = Cliente::find($request->id);        
        //dd($cliente);
        $tipo_cliente = TipoCliente::pluck( 'descripcion', 'codigo');
        $tipo_documento = TipoDocumento::pluck('nombre', 'codigo');        
        $destinos = Destino::pluck('descripcion', 'codigo');         

        return view('clientes.editar_clientes', array('cliente'=>$cliente,'tipo_cliente'=>$tipo_cliente,'tipo_documento'=>
            $tipo_documento, 'destinos'=>$destinos));        
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
    }

    /**
     * Descripción. Muestra el contenido de la tabla ProveedorVehiculos.
     * @author Franklin
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableProveedor()
    {
        $proveedor = ProveedorVehiculo::get();

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
            <a title="'.trans('copies.generales.boton_eliminar').'" class="btn btn-link"><i class="fa fa-trash-o"></i></a>';
        })
        ->rawColumns(['foto_cliente', 'action'])
        ->make(true);
    }
}
