<?php

namespace App\Models\parametrizacion;

use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model{
    protected $table='tipo_cliente';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
                'codigo',
                'descripcion',
                'porcentaje_dscto'
    		];
}
