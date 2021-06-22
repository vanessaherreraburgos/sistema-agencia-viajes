<?php

namespace App\Http\Controllers\configuracion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\destino\Pais;
use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;
use Validator;
use Response;
use Auth;
use DB;

class PaisController extends Controller
{

	public function index(){

		return Datatables::eloquent(Pais::query())
		->addColumn('action',function($diagnostico){
            return '<div class="col-xs-1"><a id="link_editar_pais" onclick="editar_pais()" title="Editar Pais" ><i class="fa fa-edit"></i></a></div><div class="col-xs-1"><a id="link_eliminar_pais" title="Eliminar Pais" ><i class="fa fa-trash-o"></i></a></div>';
        })
        ->make(true);
	}



}