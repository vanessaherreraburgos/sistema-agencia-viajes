<?php

namespace App\Models\proveedores;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;

class Proveedores extends Model
{
    use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='proveedores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
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
        'vehiculo',
        'avion',
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
     * proveedores de vehículos. Se puede usar como opciones
     * de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayProveedoresVehiculos($query) 
    {
         return $query->orderBy('razon_social')
                         ->select('codigo', 'razon_social')
                         ->where('vehiculo',1)
                         ->get()
                         ->pluck('razon_social','codigo');
   }

   /**
     * Scope que genera un array asociativo con todos los
     * proveedores de Aviones. Se puede usar como opciones
     * de un select HTML.
     *
     * @param query, query al que se le concatenera el scope.
     */
    public function  scopeArrayProveedoresAviones($query) 
    {
         return $query->orderBy('razon_social')
                         ->select('codigo', 'razon_social')
                         ->where('avion',1)
                         ->get()
                         ->pluck('razon_social','codigo');
   }
}
