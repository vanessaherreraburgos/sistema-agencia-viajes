<?php

namespace App\Models\serviciosPropios;

use Illuminate\Database\Eloquent\Model;

class serviciosPropios extends Model
{
    protected $primaryKey = 'codigo';
    protected $table='servicios_propios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion'
    ];


}
