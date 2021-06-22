<?php

namespace App\Models\aviones;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;
use Illuminate\Support\Facades\Config;
use App\Models\aviones\TipoAvion;
use App\Models\aviones\ProveedorAvion;

class Avion extends Model
{
	use FormatsDates;
    
    protected $primaryKey = 'codigo';
    protected $table='aviones';

    /**
     * Los atributos que son asignados para carga masiva.
     *
     * @var array
     */
    protected $fillable = [
        'cod_prov_avion', 'anno_avion', 'modelo', 'marca', 'foto', 'es_propio', 'activo', 'cod_destino', 'cod_tipo_avion'
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
     * Accesor que genera la ruta completa de la foto del avión.
     *
     * @param  string  $value
     * @return string
     */
    public function getRutaFotoAttribute() 
    {
        return $this->foto ? asset(Config::get('constants.RUTA_FOTO_AVION').$this->foto) : null;
    }

    /**
    * Obtiene el tipo de avión al que pertenece
    * un avión.
    *
    * @return objeto TipoAvion.
    */
    public function getTipoAvion()
    {
         return $this->belongsTo(TipoAvion::class,'cod_tipo_avion');
    }

    /**
    * Obtiene el proveddor de un avión al que pertenece
    * un avión.
    *
    * @return objeto ProveedorAvion.
    */
    public function getProveedorAvion()
    {
         return $this->belongsTo(ProveedorAvion::class,'cod_prov_avion');
    }
}
