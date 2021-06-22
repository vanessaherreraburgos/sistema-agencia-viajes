<?php

namespace App\Models\aviones;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;

class TipoAvion extends Model
{
    use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='tipo_avion';

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
     * tipos de aviones. Se puede usar como opciones
     * de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayTiposAviones($query) 
    {
        return $query->orderBy('descripcion')
                        ->select('codigo', 'descripcion')
                        ->get()
                        ->pluck('descripcion','codigo');
    }

    /**
     * Scope que genera un array asociativo con los
     * tipos de aviones activos. Se puede usar como opciones
     * de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayTiposAvionesActivos($query) 
    {
        return $query->where('activo', 1)
                        ->orderBy('descripcion')
                        ->select('codigo', 'descripcion')
                        ->get()
                        ->pluck('descripcion','codigo');
    }
}
