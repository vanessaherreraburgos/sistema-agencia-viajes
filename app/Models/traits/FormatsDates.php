<?php

namespace App\Models\traits;
use Carbon\Carbon;

trait FormatsDates
{

    protected $getDateFormat = 'd/m/Y H:i:s';
    protected $setDateFormat = 'Y-m-d\TH:i:s';

    /**
     * Accesor que obtiene el campo update_at en formato dd/mm/yyyy.
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value) 
    {
       return $value ? Carbon::parse($value)->format($this->getDateFormat) : null;
    }

    /**
     * Accesor que obtiene el campo created_at en formato dd/mm/yyyy.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value) 
    {
        return $value ? Carbon::parse($value)->format($this->getDateFormat) : null;
    }

    /**
     * Mutator que da formato al campo created_at en formato Y-m-d\TH:i:s.
     *
     * @param  string  $value
     * @return string
     */
    public function setCreatedAtAttribute($value)
    {
      return $this->attributes['created_at'] = $value->format($this->setDateFormat);
    }

    /**
     * Mutator que da formato al campo updated_at en formato Y-m-d\TH:i:s.
     *
     * @param  string  $value
     * @return string
     */
    public function setUpdatedAtAttribute($value)
    {
      return $this->attributes['updated_at'] = $value->format($this->setDateFormat);
    }
}