<?php

namespace App\Models\vehiculos;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;
use Carbon\Carbon;
use App\Models\vehiculos\TipoVehiculo;
use App\Models\destino\Pais;
use App\Models\destino\Estado;
use App\Models\destino\Ciudad;
use App\Models\destino\Destino;
use App\Models\vehiculos\ServiciosTarifasTipoVehiculo;

class TarifasTipoVehiculo extends Model
{
    use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='tarifas_tipo_vehiculo';

    protected $getDateFormatTarifasVehiculo = 'd/m/Y';
    protected $setDateFormatTarifasVehiculo = 'Y-m-d\TH:i:s';

    /**
     * Los atributos que son asignados para carga masiva.
     *
     * @var array
     */
    protected $fillable = [
        'cod_tipo_vehiculo', 
        'cod_pais', 
        'cod_estado', 
        'cod_ciudad', 
        'cod_destino', 
        'cod_serv_tipo_veh', 
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
    * Obtiene el tipo de vehículo al que pertenecen las tarifas.
    *
    * @return {TipoVehiculo} TipoVehiculo.
    */
    public function getTipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class,'cod_vehiculo'); 
    }

    /**
    * Obtiene el pais de la tarifa.
    *
    * @return {Pais} Pais.
    */
    public function getPais()
    {
        return $this->belongsTo(Pais::class,'cod_pais'); 
    }

    /**
    * Obtiene el estado de la tarifa.
    *
    * @return {Estado} Estado.
    */
    public function getEstado()
    {
        return $this->belongsTo(Estado::class,'cod_estado'); 
    }

    /**
    * Obtiene la ciudad de la tarifa.
    *
    * @return {Ciudad} Ciudad.
    */
    public function getCiudad()
    {
        return $this->belongsTo(Ciudad::class,'cod_ciudad'); 
    }

    /**
    * Obtiene el destino de la tarifa.
    *
    * @return {Destino} Destino.
    */
    public function getDestino()
    {
        return $this->belongsTo(Destino::class,'cod_destino'); 
    }

    /**
    * Obtiene el servicio de la tarifa.
    *
    * @return {ServiciosTarifasTipoVehiculo} ServiciosTarifasTipoVehiculo.
    */
    public function getServiciosTarifasTipoVehiculo()
    {
        return $this->belongsTo(ServiciosTarifasTipoVehiculo::class,'cod_serv_tipo_veh'); 
    }
}
