<?php

namespace App\Models\clientes;

use Illuminate\Database\Eloquent\Model;

class FotosCliente extends Model{
    protected $table='fotos_cliente';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
                'codigo',
                'archivo',
                'codigo_cliente'
    		];
}
