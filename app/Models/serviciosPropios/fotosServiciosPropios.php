<?php

namespace App\Models\serviciosPropios;

use Illuminate\Database\Eloquent\Model;

class fotosServiciosPropios extends Model
{
    protected $table='fotos_serv_propios';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable = 
    		[
                'codigo', 
                'archivo', 
                'cod_serv_propio'	//llave foranea del servicio propio
    		];
     
}