<?php

namespace App\Models\tarifasChofer;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Destino;
use App\Models\vehiculos\TipoVehiculo;
use App\Models\servicios\servicios;
class tarifasChofer extends Model
{
    protected $table='tarifas_chofer';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
          'cod_chofer',
          'cod_tipo_vehiculo',
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

        /*
         * Adriàn
         * 15/4/2018
         *
         * Identificar el tipo de vehículo
         */
        public function getTipoVehiculo(){
            return $this->belongsTo(TipoVehiculo::class, 'cod_tipo_vehiculo');
        }

        /*
         * Adriàn
         * 15/4/2018
         *
         * Identificar el tipo de vehículo
         */
        public function getServicios(){
            return $this->belongsTo(servicios::class, 'servicio');
        }

}
