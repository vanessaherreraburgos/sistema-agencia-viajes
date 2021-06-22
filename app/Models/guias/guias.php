<?php

namespace App\Models\guias;

use Illuminate\Database\Eloquent\Model;
use App\Models\parametrizacion\TipoDocumento;
use App\Models\destino\Pais;
use App\Models\destino\Estado;
use App\Models\destino\Ciudad;

class guias extends Model
{
    protected $table='guia';
    public $timestamps=false;
    protected $primaryKey='codigo';
    protected $fillable =
    		[
          'cod_tipo_documento',
          'documento',
          'nombres',
          'apellido1',
          'apellido2',
          'cod_pais_res',
          'cod_estado_res',
          'cod_ciudad_res',
          'direccion_res',
          'telefono_celular',
          'telefono_local',
          'email',
          'fecha_vigencia_cert_medico',
          'adjunto_certificado_medico',
          'cod_pais_nacionalidad',
          'foto_guia',
          'credencial_turismo_num',
          'adjunto_credencial',

    		];


        /*
         * Ádrianv  31/03/2018
         */
        public function getTipoDocumento(){
            return $this->belongsTo(TipoDocumento::class, 'cod_tipo_documento');
        }

        /*
         * Adriàn
         * 31/03/2018
         *
         * Identificar el pais de residencia del chofer
         */
        public function getPaisRes(){
            return $this->belongsTo(Pais::class, 'cod_pais_res');
        }

        /*
         * Adriàn
         * 31/03/2018
         *
         * Identificar el estado de residencia del chofer
         */
        public function getEstadoRes(){
            return $this->belongsTo(Estado::class, 'cod_estado_res');
        }

        /*
         * Adriàn
         * 31/03/2018
         *
         * Identificar la ciudad de residencia del chofer
         */
        public function getCiudadRes(){
            return $this->belongsTo(Ciudad::class, 'cod_ciudad_res');
        }


}
