<?php

namespace Modules\Iprice\Entities;

use Illuminate\Database\Eloquent\Model;

class TariffableTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'iprice__tariffable_translations';
}
