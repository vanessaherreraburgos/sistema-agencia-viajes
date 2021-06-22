<?php

namespace App\Models\vehiculos;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;
use Illuminate\Support\Facades\Config;
// use App\Models\vehiculos\TarifasVehiculo;
use App\Models\vehiculos\TipoVehiculo;
use App\Models\vehiculos\ProveedorVehiculo;

class Vehiculo extends Model
{
    use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='vehiculo';

    /**
     * Los atributos que son asignados para carga masiva.
     *
     * @var array
     */
    protected $fillable = [
        'placa', 'numero', 'anno_vehiculo', 'modelo', 'marca', 'color', 'cod_tipo_vehiculo', 'foto', 'es_propio', 'activo', 'cod_proveedor_vehiculo' ,
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
     * Accesor que genera la ruta completa de la foto del vehículo.
     *
     * @param  string  $value
     * @return string
     */
    public function getRutaFotoAttribute() 
    {
        return $this->foto ? asset(Config::get('constants.RUTA_FOTO_VEHICULO').$this->foto) : null;
    }

    /**
    * Obtiene el tipo de vehículo.
    *
    * @return {TipoVehiculo} TipoVehiculo.
    */
    public function getTipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class,'cod_tipo_vehiculo'); 
    }

    /**
    * Obtiene el proveedor del vehículo.
    *
    * @return {ProveedorVehiculo} ProveedorVehiculo.
    */
    public function getProveedorVehiculo()
    {
        return $this->belongsTo(ProveedorVehiculo::class,'cod_proveedor_vehiculo'); 
    }

}
