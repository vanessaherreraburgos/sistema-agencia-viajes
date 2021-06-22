<?php

namespace App\Models\parametrizacion;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Pais;

class GradoLicencia extends Model{
    protected $table='grado_licencia';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable = 
    		[
                'codigo', 
                'nombre', 
                'cod_pais' //llave foranea del pais
    		];

    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\Pais
     */
    public function getPais(){
        return $this->belongsTo(Pais::class,'cod_pais');
    }
    

}