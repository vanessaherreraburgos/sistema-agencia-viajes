<?php

namespace App\Models\hoteles;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;
use App\Models\destino\Destino;
// use Carbon\Carbon;

class Hoteles extends Model
{

    //use FormatsDates;

    protected $primaryKey = 'codigo';
    protected $table='hoteles';
    public $timestamps=false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo','identificacion_fiscal', 'nombre_comercial', 'razon_social', 'cod_pais', 'cod_estado', 'cod_ciudad', 'direccion_fiscal', 'telefono1', 'telefono2', 'telefono3', 'correo1','correo2','correo3', 'pagina_web', 'cuenta_instagram', 'cuenta_facebook', 'cuenta_twiter', 'caracteristicas', 'cod_tipo_alojamiento', 'categoria_hotel'
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
     * Descripción. Muestra los datos del destino 
     * @author Vanessa Herrera    
     */
    public function getDestino(){
        return $this->belongsTo(Destino::class,'cod_destino_vende');
    }

}
