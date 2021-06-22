<?php

namespace App\Models\parametrizacion;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Pais;

class TipoDocumento extends Model{
    protected $table='tipo_documento';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
                'codigo',
                'nombre',
                'abreviado',
                'cod_pais' //llave foranea del pais
    		];

    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Pais
     */
    public function getPais(){
        return $this->belongsTo(Pais::class,'cod_pais');
    }


    // lista de nacionalidades -- adrian 27 de mayo
    public function getListTiposDocumento(){
        return TipoDocumento::orderBy('nacionalidad')->select('nacionalidad')->get()->nacionalidad;
    }



}
