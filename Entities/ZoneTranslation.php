<?php

namespace Modules\Iprice\Entities;

use Illuminate\Database\Eloquent\Model;

class ZoneTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','description'];
    protected $table = 'iprice__zone_translations';
}
