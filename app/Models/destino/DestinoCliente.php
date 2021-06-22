<?php

namespace App\Models\destino;

use Illuminate\Database\Eloquent\Model;

class DestinoCliente extends Model
{
    protected $table='destino_vende_cliente';
    public $timestamps=false;
    protected $primaryKey='cod_cliente,cod_destino';
    protected $fillable = 
    		[
                'cod_cliente', // llave foranea del cliene                 
                'cod_destino'	//llave foranea del destino
    		];

    /*
     * @author  Franklin
     * @data    22/04/2018
     * @param   Ninguno
     * @return  App\Models\destino\Destino
     */     

}