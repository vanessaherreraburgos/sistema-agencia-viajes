<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
    protected $primaryKey = 'codigo';
    protected $table='servicios_destino';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'num_personas', 'cod_destino'
    ];


}
