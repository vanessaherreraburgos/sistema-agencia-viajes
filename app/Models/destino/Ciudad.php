<?php

namespace App\Models\destino;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Estado;
use App\Models\destino\Destino;
use App\Models\destino\Ciudad;

class Ciudad extends Model
{
    protected $table='ciudad';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
                'codigo',
                'nombre',
                'cod_estado',       //llave foranea tabla estado
                'codigo_postal',    //código postal de la ciudad, importante para los clientes
                'indicativo'        //indicativo de la ciudad formato: (6)
    		];

    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Estado
     */
    public function getEstado(){
        return $this->belongsTo(Estado::class,'cod_estado');
    }


    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Destino
     */
    public function getDestinos(){
        return $this->hasMany(Destino::class,'cod_ciudad');
    }


    /*
     * ******************************************************************************************************
     * Metodos adicionales
     * ******************************************************************************************************
     */
        /*
         * @author  Angela Perez
         * @data    14/02/2018
         * @param   Ninguno
         * @return  String concatenando pais, estado y el nombre de la ciudad
         */
        public function getUbicacion(){
            return $this->getEstado->getPais->nombre.", ".$this->getEstado->nombre.", ".$this->nombre;
        }


}
