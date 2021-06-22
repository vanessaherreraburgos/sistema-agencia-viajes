<?php

namespace App\Models\destino;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Destino; 

class FotosDestino extends Model
{
    protected $table='fotos_destino';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable = 
    		[
                'codigo', 
                'archivo', 
                'cod_destino'	//llave foranea del destino
    		];

    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Destino
     */
    public function getDestino(){
        return $this->belongsTo(Destino::class,'cod_destino');
    }
     
}
