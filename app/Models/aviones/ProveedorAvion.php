<?php

namespace App\Models\aviones;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;

class ProveedorAvion extends Model
{
    use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='proveedor_aviones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cod_destino', 
        'razon_social', 
        'nombre_propietario1', 
        'telefono_propietario1',
        'email_propietario1',
        'nombre_propietario2',
        'telefono_propietario2',
        'email_propietario2',
        'nombre_propietario3',
        'telefono_propietario3',
        'email_propietario3',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Scope que genera un array asociativo con todos los
     * proveedores de aviones. Se puede usar como opciones
     * de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayProveedoresAviones($query) 
    {
        return $query->orderBy('nombre_propietario1')
                        ->select('codigo', 'nombre_propietario1')
                        ->get()
                        ->pluck('nombre_propietario1','codigo');
   }
}
