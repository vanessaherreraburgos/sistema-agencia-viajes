<?php

namespace App\Models\destino;

use Illuminate\Database\Eloquent\Model;
use App\Models\destino\Estado; 
use App\Models\parametrizacion\GradoLicencia;
use App\Models\parametrizacion\TipoDocumento;

class Pais extends Model{
    protected $table='pais';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable = 
    		[	
    			'codigo', 
    			'nombre', 
    			'indicativo', 	//indicativo telefonico del pais fromato: (+57)
    			'mask_fijo', 	//forma mas comun como representan el # telefono ej: 999-9999
    			'mask_celular', 
    			'moneda_show',  //nombre de la moneda a mostrar a los usuarios
    			'nacionalidad' 		
    		];

    /*
     * @author 	Angela Perez
     * @data 	13/02/2018
     * @param 	Ninguno
     * @return 	App\Models\destino\Estado
     */
    public function getEstados(){
    	return $this->hasMany(Estado::class,'cod_pais');
    }
    

    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\GradoLicencia
     */
    public function getGradoLicencia(){       
        return $this->hasMany(GradoLicencia::class,'cod_pais');
    }
 
    /*
     * @author  Angela Perez
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\destino\TipoDocumento
     */
    public function getTipoDocumento(){       
        return $this->hasMany(TipoDocumento::class,'cod_pais');
    }
}