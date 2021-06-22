<?php

namespace App\Models\tarifasGuias;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Destino;
use App\Models\servicios\servicios;

class tarifasGuias extends Model
{
    protected $table='tarifas_guia';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
          'cod_guia',
          'cod_destino',
          'precio_usd',
          'fecha_inicial',
          'fecha_final',
    		];

        /*
         * Adriàn
         * 15/4/2018
         *
         * Identificar el destino
         */
        public function getDestino(){
            return $this->belongsTo(Destino::class, 'cod_destino');
        }

        public function getServicios(){
            return $this->belongsTo(servicios::class, 'servicio');
        }


}
