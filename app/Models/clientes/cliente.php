<?php

namespace App\Models\clientes;

use Illuminate\Database\Eloquent\Model;
use App\Models\traits\FormatsDates;
use App\Models\configuracion\Pais;
use App\Models\parametrizacion\TipoCliente;
use App\Models\destino\DestinoCliente;
use App\Models\destino\Destino;

class cliente extends Model
{
    use FormatsDates;

    protected $table='cliente';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
                'codigo',
                'cod_tipo_cliente',
                'cod_tipo_documento',
                'documento',
                'porcentaje_dscto',
                'nombre_comercial',
                'nro_fiscal',
                'direccion',                
                'telefono1',
                'telefono2',
                'correo1',
                'correo2',
                'pagina_web',
                'razon_social',
                'codigo_postal', 
                'motivo_inicio_relacion_ciente', 
                'cod_pais', 
                'cod_estado', 
                'cod_ciudad', 
                'fecha_inicio_relacion_laboral', 
                'ref_tour_lider', 
    		];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getDestinos(){
        return $this->belongsToMany(Destino::class, 'destino_vende_cliente', 'cod_cliente', 'cod_destino');
    }

    public function getPais(){
        return $this->belongsTo(Pais::class, 'cod_pais');
    }

    public function getTipoCliente(){
        return $this->belongsTo(TipoCliente::class, 'cod_tipo_cliente');
    }
        
    /*     
     * @data    13/02/2018
     * @param   Ninguno
     * @return  App\Models\clientes\FotosCliente
     */
    public function getFotosCliente(){       
        return $this->hasMany(FotosCliente::class,'cod_cliente');
    }
}
