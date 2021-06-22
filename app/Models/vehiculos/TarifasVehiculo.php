<?php

namespace App\Models\vehiculos;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;
use Carbon\Carbon;
use App\Models\vehiculos\Vehiculo;

class TarifasVehiculo extends Model
{
    use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='tarifas_vehiculo';

    protected $getDateFormatTarifasVehiculo = 'd/m/Y';
    protected $setDateFormatTarifasVehiculo = 'Y-m-d\TH:i:s';

    /**
     * Los atributos que son asignados para carga masiva.
     *
     * @var array
     */
    protected $fillable = [
        'cod_vehiculo', 
        'cod_destino', 
        'precio_usd', 
        'fecha_inicial', 
        'fecha_final',
    ];

    /**
     * Accesor que obtiene el campo fecha_inicial en formato dd/mm/yyyy.
     *
     * @param  string  $value
     * @return string
     */
    public function getFechaInicialAttribute($value) 
    {
       return $value ? Carbon::parse($value)->format($this->getDateFormatTarifasVehiculo) : null;
    }

    /**
     * Accesor que obtiene el campo fecha_final en formato dd/mm/yyyy.
     *
     * @param  string  $value
     * @return string
     */
    public function getFechaFinalAttribute($value) 
    {
        return $value ? Carbon::parse($value)->format($this->getDateFormatTarifasVehiculo) : null;
    }

    /**
     * Mutator que da formato al campo fecha_inicial en formato Y-m-d\TH:i:s.
     *
     * @param  string  $value
     * @return string
     */
    public function setFechaInicialAttribute($value)
    {
      return $this->attributes['fecha_inicial'] = date($this->setDateFormatTarifasVehiculo,strtotime(Carbon::createFromFormat('d/m/Y', $value)->toDateTimeString()));
    }

    /**
     * Mutator que da formato al campo fecha_final en formato Y-m-d\TH:i:s.
     *
     * @param  string  $value
     * @return string
     */
    public function setFechaFinalAttribute($value)
    {
      return $this->attributes['fecha_final'] = date($this->setDateFormatTarifasVehiculo,strtotime(Carbon::createFromFormat('d/m/Y', $value)->toDateTimeString()));
    }

    /**
    * Obtiene el vehículo al que pertenecen las tarifas.
    *
    * @return {Vehiculo} Vehiculo.
    */
    public function getVehiculo()
    {
        return $this->belongsTo(Vehiculo::class,'cod_vehiculo'); 
    }
}
