<?php

namespace App\Models\vehiculos;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;

class TipoVehiculo extends Model
{
    use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='tipo_vehiculo';

    /**
     * Los atributos que son asignados para carga masiva.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 
        'cantidad_max_pasajeros', 
        'cantidad_ventanas',
        'activo',
    ];

    /**
     * Valores por defecto para los atributos mencionados en
     * en arreglo.
     *
     * @var array
     */
    protected $attributes = [
        'activo' => 1
    ];

    /**
     * Los atributos que deberían mutarse a fechas.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Scope que genera un array asociativo con todos los
     * tipos de vehículos. Se puede usar como opciones
     * de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayTiposVehiculos($query) 
    {
        return $query->orderBy('descripcion')
                        ->select('codigo', 'descripcion')
                        ->get()
                        ->pluck('descripcion','codigo');
    }

    /**
     * Scope que genera un array asociativo con los
     * tipos de vehículos activos. Se puede usar como opciones
     * de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayTiposVehiculosActivos($query) 
    {
        return $query->where('activo', 1)
                        ->orderBy('descripcion')
                        ->select('codigo', 'descripcion')
                        ->get()
                        ->pluck('descripcion','codigo');
    }

}
