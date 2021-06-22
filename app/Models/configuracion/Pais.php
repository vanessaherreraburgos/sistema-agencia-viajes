<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Model;
//use App\Models\parametrizacion\Estado; 

class Pais extends Model
{
     protected $table='pais';
     public $timestamps=false;
     protected $primaryKey='codigo';
    

     /*public function getEstados(){     	
     	return $this->hasMany(Estado::class,'pais_fk');
     }
     */

     
}