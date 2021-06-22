<?php

namespace App\Models\destino;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Pais; 
use App\Models\destino\Ciudad; 

class Estado extends Model
{
    protected $table='estado';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable = 
    		[
                'codigo', 
                'nombre', 
                'cod_pais'  //llave foranea relacion con pais
    		];


    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Pais
     */
    public function getPais(){      
       return $this->belongsTo(Pais::class, 'cod_pais');
    }

    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Ciudad
     */
    public function getCiudades(){       
        return $this->hasMany(Ciudad::class,'cod_estado');
    }

}