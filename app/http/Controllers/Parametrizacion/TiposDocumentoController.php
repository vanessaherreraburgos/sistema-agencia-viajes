<?php

namespace App\Http\Controllers\parametrizacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\parametrizacion\TipoDocumento;
use Auth;

class TiposDocumentoController extends Controller{

  // lista de nacionalidades -- adrian 27 de mayo
  public function getListTiposDocumento(){
      return TipoDocumento::orderBy('nombre')->get();
  }

}
