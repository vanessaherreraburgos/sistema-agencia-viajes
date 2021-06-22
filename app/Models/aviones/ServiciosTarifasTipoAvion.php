<?php

namespace App\Models\aviones;

use Illuminate\Database\Eloquent\Model;

class ServiciosTarifasTipoAvion extends Model
{
    protected $primaryKey = 'codigo';
    protected $table='serv_tarifas_tipo_avion';

    /**
     * Los atributos que son asignados para carga masiva.
     *
     * @var array
     */
    protected $fillable = ['descripcion'];

    /**
     * Scope que genera un array asociativo con todos los
     * serviciós que puede realizar un tipo de avión. 
     * Se puede usar como opciones de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayServiciosTipoAvion($query) 
    {
        return $query->orderBy('descripcion')
                        ->select('codigo', 'descripcion')
                        ->get()
                        ->pluck('descripcion','codigo');
   }
}
