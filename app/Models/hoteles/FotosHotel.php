<?php

namespace App\Models\hoteles;

use Illuminate\Database\Eloquent\Model;

class FotosHotel extends Model{
    protected $table='fotos_hotel';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
                'codigo',
                'archivo',
                'codigo_hotel'
    		];
}
