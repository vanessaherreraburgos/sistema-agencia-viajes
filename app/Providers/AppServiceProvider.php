<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Configuración de idioma para Carbon.
         *
         * @param  $value, cadena a validar
         * @return Boolean
         */
        \Carbon\Carbon::setlocale(config('app.locale'));

        /**
         * Valida que una cadena ingresadasa solo contenga caracteres alfabeticos, números,
         * signos de puntuación, guiones, guiones bajos o espacios en blanco.
         *
         * @param  $value, cadena a validar
         * @return Boolean
         */
        Validator::extend('texto', function($attribute, $value, $parameters, $validator){

            if(preg_match("/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9\.,;:¡!¿?#_\-\s]*$/", $value))
                return true;
            else
                return false;
        });

        /**
         * Valida que una cadena ingresadasa solo contenga caracteres alfabeticos, guiones, 
         * guiones bajos o espacios en blanco.
         *
         * @param  $value, cadena a validar
         * @return Boolean
         */
        Validator::extend('alfa_espacio', function($attribute, $value, $parameters, $validator){

            if(preg_match("/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\-\s]*$/", $value))
                return true;
            else
                return false;
        });

        /**
         * Valida que una cadena ingresadasa solo contenga caracteres alfabeticos, números, guiones, 
         * guiones bajos o espacios en blanco.
         *
         * @param  $value, cadena a validar
         * @return Boolean
         */
        Validator::extend('alfa_num_espacio', function($attribute, $value, $parameters, $validator){

            if(preg_match("/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9_\-\s]*$/", $value))
                return true;
            else
                return false;
        });

        /**
         * Valida que se ingrese un valor númerico y si es decimal, que solo contenga dos decimales maximo.
         *
         * @param  $value, cadena a validar
         * @return Boolean
         */
        Validator::extend('numero_o_decimal', function($attribute, $value, $parameters, $validator){
            if(preg_match("/^([1-9]){1}[0-9]+(\.(\d){1,2})?$/", $value)){
            return true;
            }
            return false;
        });

        /**
         * Valida que una cadena ingresadasa cumpla con las condiciones para que sea considerada
         * un texto descriptivo.
         *
         * @param  $value, cadena a validar
         * @return Boolean
         */
        Validator::extend('alfa_num_caracteres', function($attribute, $value, $parameters, $validator){

            if(preg_match("/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9\.,;:¡!¿?#_\-\s]*$/", $value))
                return true;
            else
                return false;
        });

        /**
         * Valida que una tarifa ingresada no este registrada en el sistema.
         *
         * @param  $attribute, nombre del campo a validar. En este caso siempre es tarifa_validar.
         * @param  $value, valor del campo a validar. En este caso siempre es NULL.
         * @param  $parameters, cadena de valores que ayudan a generar el query 
         *         para validar los valores de la nueva tarifa.
         * @return Boolean
         */
        Validator::extend('tarifa', function($attribute, $value, $parameters, $validator){

            $cantidadParametros = count($parameters);

            if($cantidadParametros > 0){

                $nombreTabla = $parameters[0];
                $colfechaIni = $parameters[1];
                $fechaIni    = $parameters[2];
                $colfechaFin = $parameters[3];
                $fechaFin    = $parameters[4];

                /* se valida si el rango de fechas ingresado ya existe en la tabla de tarifas por la cual
                se realiza la busqueda.*/
                $cantRegistros = DB::table($nombreTabla)
                                    ->where(function ($q) use ($fechaIni, $fechaFin, $colfechaIni, $colfechaFin) {

                                        $q->where(function ($query) use ($fechaIni, $colfechaIni, $colfechaFin) {
                                            $query->where($colfechaIni, '<=', $fechaIni)
                                                    ->where($colfechaFin, '>=', $fechaIni);
                                        })
                                        ->orWhere(function ($query) use ($fechaFin, $colfechaIni, $colfechaFin) {
                                            $query->where($colfechaIni, '<=', $fechaFin)
                                                    ->where($colfechaFin, '>=', $fechaFin);
                                        })
                                        ->orWhere(function ($query) use ($fechaIni, $fechaFin, $colfechaIni, $colfechaFin) {
                                            $query->where($colfechaIni, '>=', $fechaIni)
                                                    ->where($colfechaFin, '<=', $fechaFin);
                                        });
                                    });
            }

            // se incluyen en query elemento que se desea excluir de la busqueda.
            if($cantidadParametros > 5){

                $columnaIgnorar  = $parameters[5];
                $valorIgnorar    = $parameters[6];
                
                if($columnaIgnorar != 'null' && $valorIgnorar != 'null')
                    $cantRegistros = $cantRegistros->where($columnaIgnorar,'!=',$valorIgnorar); 
            }
            
            // se incluyen en query otros elementos que se deseen comparar ademas del rango de fechas.
            if($cantidadParametros > 7){

                $i = 7;
                while($i <= $cantidadParametros - 1){
                    $cantRegistros = $cantRegistros->where($parameters[$i], $parameters[$i+1]); 
                    $i += 2;
                } 
            }

            $cantRegistros = $cantRegistros->count();
                                
            return $cantRegistros == 0 ? true : false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
