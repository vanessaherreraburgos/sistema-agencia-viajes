<?php

namespace App\Http\Controllers\hoteles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Response;
use App\Models\clientes\Clientes;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\hoteles\Hoteles;
use App\Models\hoteles\FotosHotel;
use App\Models\hoteles\TipoAlojamiento;
use App\Models\hoteles\CategoriaHotel;
use Illuminate\Support\Facades\Config;


class HotelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hoteles.list_hoteles', array('nombre' => 'Javi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $tipo_alojamiento = TipoAlojamiento::pluck( 'descripcion', 'codigo');
        $categoria_hotel = CategoriaHotel::pluck( 'descripcion', 'codigo');
        
        return view('hoteles.crear_hoteles', array('tipo_alojamiento' => $tipo_alojamiento, 'categoria_hotel' => $categoria_hotel));
    }

    public function create2()
    {
       
        $tipo_alojamiento = TipoAlojamiento::pluck( 'descripcion', 'codigo');
        $categoria_hotel = CategoriaHotel::pluck( 'descripcion', 'codigo');
        
        return view('hoteles.crear_hoteles2', array('tipo_alojamiento' => $tipo_alojamiento, 'categoria_hotel' => $categoria_hotel));
    }

    /**
     * Almacena un nuevo hotel en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request->all());
        $rules = array(             
               
               'identificacion_fiscal' => 'required|alfa_num_caracteres|max:20',
               'nombre_comercial' => 'required|alfa_num_caracteres|max:150',
               'razon_social'  => 'required|alfa_num_caracteres|max:300',
               'cod_pais'  => 'required|integer',
               'cod_estado'  => 'required|integer',
               'cod_ciudad'  => 'required|integer',
               'cod_destino_vende'  => 'required|integer',
               'direccion_fiscal'  => 'required|alfa_num_caracteres|max:150',               
               'telefono1'  => 'required|alfa_num_caracteres|min:8|max:50',
               'telefono2'  => 'nullable|alfa_num_caracteres|min:8|max:50',
               'telefono3'  => 'nullable|alfa_num_caracteres|min:8|max:50',
               'correo1'    => 'required|email|max:50',
               'correo2'    => 'nullable|email|max:50',
               'correo3'    => 'nullable|email|max:50',
               'pagina_web' => 'nullable|alfa_num_caracteres|max:50',
               'cuenta_instagram' => 'nullable|alfa_num_caracteres|max:50',
               'cuenta_facebook'  => 'nullable|alfa_num_caracteres|max:50',
               'cuenta_twiter'    => 'nullable|alfa_num_caracteres|max:50',
               // 'caracteristicas'  => 'required|alfa_num_caracteres|max:50',
               // 'cod_tipo_alojamiento'  => 'required|integer',
               // 'categoria_hotel'       => 'required|integer',
               // 'fotos.*'            => 'image|max:5000',
        );
        
        try {

            DB::beginTransaction();

            $validator = Validator::make ( $request->all(), $rules );        
            if ($validator->fails()){
                return response()->json(array('errors' => $validator->messages()),200);            
            }else{                   

                $hoteles = new Hoteles();         
                //dd ($request->all());                      
                if ($hoteles->create($request->all())) {
                    // guardando las fotos de los hoteles
                    $array_foto = $request->file('fotos'); // recupera la imagen                      
                    for($i=0; $i< count($array_foto); $i++){
                        $new_foto_hotel =   new FotosHotel; 
                        $ext = $array_foto[$i]->getClientOriginalExtension(); 
                        $nombre_foto = 'hotel_'.$hoteles->codigo.'_'.$i.'.'.$ext; // Genera un nombre del archivo
                        $ruta_foto = Config::get('constants.RUTA_FOTO_HOTELES').$nombre_foto; 
                        file_put_contents($ruta_foto,  File::get($array_foto[$i])); // Función para subir la imagen
                        $new_foto_hotel->archivo = $nombre_foto;
                        $new_foto_hotel->cod_hotel = $hoteles->codigo;
                        if (!$new_foto_hotel->save()){
                            DB::rollback();                            
                            return response()->json(array('error' => false), 500);
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
        } catch(\Exception $e) {
            //return $e;
            DB::rollback();
            return response()->json(array('success' => 'error'), 200);
        }
    
    }

    /**
     * Descripción. Muestra el contenido de la tabla de hoteles
     * @author Vanessa Herrera
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableHoteles()
    {

        $hoteles = Hoteles::get();

        return Datatables::of($hoteles)
        ->addColumn('foto',function($hoteles){
           // if(!empty($hoteles->foto_principal))
                return "<img alt='image' class='img-circle img-md center-block' src='".asset(Config::get('constants.RUTA_FOTO_HOTELES').'buscador_de_hoteles_1.jpg')."'>";
            // else
            //     return "<img alt='image' class='img-circle img-md center-block' src='".asset(Config::get('constants.RUTA_FOTO_HOTELES'))."'>";
        })
        ->addColumn('nombre_comercial',function($hoteles){
            return $hoteles->nombre_comercial;
        })
        ->addColumn('destino',function($hoteles){
            return $hoteles->getDestino->descripcion;
        })
        ->addColumn('telefonos',function($hoteles){
            return $hoteles->telefono1.' '.$hoteles->telefono2.' '.$hoteles->telefono3;
        })
        ->addColumn('correos',function($hoteles){
            return $hoteles->correo1.' '.$hoteles->correo2.' '.$hoteles->correo3;
        })
        ->addColumn('categoria_hotel',function($hoteles){
            return $hoteles->categoria_hotel;
        })
        ->addColumn('min_estadia',function($hoteles){
            return $hoteles->min_estadia;
        })
        ->addColumn('action',function($hoteles){
            return '<a href="'.url('hoteles/tarifas/'.$hoteles->codigo)
                    .'" title="'.trans('copies.generales.boton_gest_tarifas').'" class="btn btn btn-default"><i class="fa fa-money"></i></a> 
                    <a title="'.trans('copies.generales.boton_editar').'" class="btn btn btn-default"><i class="fa fa-edit"></i></a> 
                    <a title="'.trans('copies.generales.boton_eliminar').'" class="btn btn btn-default"><i class="fa fa-trash-o"></i></a>';   
        })
        ->rawColumns(['foto', 'action'])
        ->make(true);
    }

    public function indexTarifas($idHotel){
         return view('hoteles.indexTarifas');

    }

    public function TarifasHabitaciones(){
         return view('hoteles.tarifas_habitaciones');
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
    public function edit($id)
    {
        //
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
}
