<?php

namespace App\Models\tarifasServPropios;

use Illuminate\Database\Eloquent\Model;
class tarifasServPropios extends Model
{
    protected $table='tarifas_serv_propios';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
          'cod_serv_propio',
          'precio_usd_tsp',
          'fecha_inicio_tsp',
          'fecha_final_tsp',
    		];
}
