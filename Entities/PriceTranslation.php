<?php

namespace Modules\Iprice\Entities;

use Illuminate\Database\Eloquent\Model;

class PriceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'iprice__price_translations';
}
