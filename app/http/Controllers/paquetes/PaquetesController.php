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
use Illuminate\Support\Facades\Config;


class PaquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paquetes.list_paquetes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('paquetes.create');
        
    }

    /**
     * Almacena un nuevo paquete en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
    
    }

    /**
     * Descripción. Muestra el contenido de la tabla de paquetes
     * @author Vanessa Herrera
     *
     * @return {Datatables} elementos del dataTable.
     */
    public function dataTableHoteles()
    {

       
    }

   
}
