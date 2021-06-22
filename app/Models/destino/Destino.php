<?php
namespace App\Models\destino;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;
use App\Models\destino\Ciudad; 
use App\Models\destino\Estado; 
use App\Models\destino\FotosDestino;
use App\Models\clientes\Cliente; 

class Destino extends Model
{
    use FormatsDates;
    
    protected $table='destino';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable = 
    		[
                'codigo', 
                'descripcion', 
                'cod_ciudad',           //llave foranea de la ciudad
                'km_recorrer', 
                'cant_dias_traslado', 
                'direccion'
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
            

    public function getClientes(){
        return $this->belongsToMany(Cliente::class, 'destino_vende_cliente',  'cod_destino', 'cod_cliente');
    }

    /*     
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Ciudad
     */
    public function getCiudad(){
        return $this->belongsTo(Ciudad::class,'cod_ciudad');
    }

  /*  public function get_cod_estado(){
        $city = Ciudad::find($this->cod_ciudad);
        return $city->cod_estado;
    }
/*    
    public function get_cod_pais(){
        $city = Ciudad::find($this->cod_ciudad);
        $estate = Estado::find($city->cod_estado);
        return $estate->cod_pais;
    }

    */
    /*     
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\FotosDestino
     */
    public function getFotosDestino(){       
        return $this->hasMany(FotosDestino::class,'cod_destino');
    }

}