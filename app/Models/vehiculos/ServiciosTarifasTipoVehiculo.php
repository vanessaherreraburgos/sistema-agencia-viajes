<?php

namespace App\Models\vehiculos;

use Illuminate\Database\Eloquent\Model;

class ServiciosTarifasTipoVehiculo extends Model
{
    protected $primaryKey = 'codigo';
    protected $table='serv_tarifas_tipo_veh';

    /**
     * Los atributos que son asignados para carga masiva.
     *
     * @var array
     */
    protected $fillable = ['descripcion'];

    /**
     * Scope que genera un array asociativo con todos los
     * serviciós que puede realizar un tipo de vehículo. 
     * Se puede usar como opciones de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayServiciosTipoVehiculo($query) 
    {
        return $query->orderBy('descripcion')
                        ->select('codigo', 'descripcion')
                        ->get()
                        ->pluck('descripcion','codigo');
   }
}
