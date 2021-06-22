<?php

namespace App\Models\choferes;

use Illuminate\Database\Eloquent\Model;

class num_licencias extends Model
{
    protected $table='grado_licencia';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
                'nombre',
                'cod_pais',
    		];

}
